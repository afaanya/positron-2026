<?php

namespace App\Support;

use Illuminate\Support\Facades\Hash;

/**
 * Transitional password checking for the custom admin/mentor/mahasiswa auth.
 *
 * Historically these tables stored passwords in plaintext. This helper lets
 * login accept BOTH a legacy plaintext value and a modern bcrypt/argon hash,
 * so existing accounts keep working while we migrate. Callers should rehash
 * (Hash::make) whenever needsRehash() is true so plaintext is phased out.
 */
class PasswordHelper
{
    /** True if $input matches $stored, handling legacy plaintext + hashed values. */
    public static function matches(string $input, ?string $stored): bool
    {
        if ($stored === null || $stored === '') {
            return false;
        }

        if (self::isHashed($stored)) {
            return Hash::check($input, $stored);
        }

        // Legacy plaintext — timing-safe compare.
        return hash_equals($stored, $input);
    }

    /** True if the stored value should be upgraded to a fresh hash. */
    public static function needsRehash(?string $stored): bool
    {
        return $stored === null
            || $stored === ''
            || ! self::isHashed($stored)
            || Hash::needsRehash($stored);
    }

    private static function isHashed(string $value): bool
    {
        return (bool) preg_match('/^\$(2[aby]|argon2i|argon2id)\$/', $value);
    }
}
