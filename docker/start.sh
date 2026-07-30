#!/usr/bin/env sh
# Render boot: env vars are injected at runtime, so caches are built here (not at image build).
set -e

# Best-effort caches — never let a cache miss crash the container (e.g. closure-based routes).
php artisan config:cache || true
php artisan route:cache  || true
php artisan view:cache   || true
php artisan storage:link || true

# Apply pending migrations against Supabase (idempotent; safe if nothing is pending).
php artisan migrate --force || echo "[start] migrate skipped/failed — verify DB_* env vars in Render"

# Serve on the port Render provides (free tier, single PHP process — fine for low traffic).
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
