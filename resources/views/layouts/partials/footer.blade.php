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

            <!-- Instagram (outline) -->
            <a href="https://www.instagram.com/hmdteiftum"
            target="_blank"
            rel="noopener noreferrer"
            title="Instagram"
            style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(248, 215, 148, 0.1); border: 1px solid rgba(248, 215, 148, 0.3); border-radius: 8px; transition: all 0.3s ease; text-decoration: none; color: #f8d794; font-size: 20px;">
                <i class="bi bi-instagram"></i>
            </a>

            <!-- TikTok (outline) -->
            <a href="https://www.tiktok.com/@hmdteiftum"
            target="_blank"
            rel="noopener noreferrer"
            title="TikTok"
            style="display:inline-flex;
                    align-items:center;
                    justify-content:center;
                    width:40px;
                    height:40px;
                    background:rgba(248,215,148,.1);
                    border:1px solid rgba(248,215,148,.3);
                    border-radius:8px;">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="22"
                    height="22"
                    fill="#f8d794"
                    viewBox="0 0 24 24">
                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.68h-3.29v13.19a2.8 2.8 0 1 1-2.8-2.8c.31 0 .61.05.89.14V9.18a6.1 6.1 0 0 0-.89-.07A6.09 6.09 0 1 0 15.82 15V8.3a8.08 8.08 0 0 0 4.71 1.5V6.69h-.94z"/>
                </svg>

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