<footer class="site-footer" style="background: #0a0e0d; border-top: 1px solid rgba(248, 215, 148, 0.2); padding: 40px 0;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 30px;">

        <!-- Left Side: Copyright & Departemen -->
        <div class="footer-left" style="flex: 1; min-width: 250px;">
            <p style="margin: 0; color: #f8d794; font-family: 'Libre Baskerville', serif; font-size: 14px; line-height: 1.6;">
                <strong>&copy; {{ date('Y') }} POSITRON</strong><br>
                <span style="color: #c8a96e; font-size: 13px;">Departemen Teknik Elektro dan Informatika</span>
            </p>
        </div>

        <!-- Right Side: Social Media Icons -->
        <div class="footer-right" style="display: flex; gap: 20px; align-items: center;">

            <!-- Instagram -->
            <a href="https://www.instagram.com/hmdteiftum"
            target="_blank"
            rel="noopener noreferrer"
            title="Instagram"
            style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(248, 215, 148, 0.1); border: 1px solid rgba(248, 215, 148, 0.3); border-radius: 8px; transition: all 0.3s ease; text-decoration: none;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
                    alt="Instagram"
                    style="width: 20px; height: 20px;">
            </a>

            <!-- TikTok -->
            <a href="https://www.tiktok.com/@hmdteiftum"
            target="_blank"
            rel="noopener noreferrer"
            title="TikTok"
            style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(248, 215, 148, 0.1); border: 1px solid rgba(248, 215, 148, 0.3); border-radius: 8px; transition: all 0.3s ease; text-decoration: none;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/TikTok_logo.svg"
                    alt="TikTok"
                    style="width: 20px; height: 20px;">
            </a>

        </div>
    </div>

    <style>
        .footer-right a:hover {
            background: rgba(248, 215, 148, 0.2) !important;
            border-color: rgba(248, 215, 148, 0.6) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(248, 215, 148, 0.2);
        }

        @media (max-width: 768px) {
            .site-footer .container {
                flex-direction: column;
                text-align: center;
            }

            .footer-left {
                order: 2;
            }

            .footer-right {
                order: 1;
                margin-bottom: 20px;
            }
        }
    </style>
</footer>