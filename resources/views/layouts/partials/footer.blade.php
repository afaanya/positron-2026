<footer class="site-footer" style="background: #0a0e0d; border-top: 1px solid rgba(248, 215, 148, 0.2); padding: 40px 0;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 30px;">
        
        <!-- Left Side: Copyright & Departemen -->
        <div class="footer-left" style="flex: 1; min-width: 250px;">
            <p style="margin: 0; color: #f8d794; font-family: 'Libre Baskerville', serif; font-size: 14px; line-height: 1.6;">
                <strong>&copy; {{ date('Y') }} POSITRON 2026</strong><br>
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
               style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(248, 215, 148, 0.1); border: 1px solid rgba(248, 215, 148, 0.3); border-radius: 8px; transition: all 0.3s ease; text-decoration: none; color: #f8d794;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <circle cx="17.5" cy="6.5" r="1.5"></circle>
                </svg>
            </a>

            <!-- TikTok -->
            <a href="https://www.tiktok.com/@hmdteiftum" 
               target="_blank" 
               rel="noopener noreferrer"
               title="TikTok"
               style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(248, 215, 148, 0.1); border: 1px solid rgba(248, 215, 148, 0.3); border-radius: 8px; transition: all 0.3s ease; text-decoration: none; color: #f8d794;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25A4.85 4.85 0 0 1 12 0c-2.6 0-4.88 1.95-4.88 4.85 0 .36.04.72.12 1.07A13.9 13.9 0 0 1 1 4.07a4.85 4.85 0 0 1 1.5-6.46 4.83 4.83 0 0 1 3.77 4.25 4.85 4.85 0 0 1 4.84 4.84c0 .36-.04.72-.12 1.07a13.9 13.9 0 0 0 10.24-1.62c2.6 0 4.88-1.95 4.88-4.85 0-.36-.04-.72-.12-1.07z"></path>
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

/* test */