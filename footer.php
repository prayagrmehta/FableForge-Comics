<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .footer {
            background-color: #000;
            color: #fff;
            padding: 20px 0;
            font-family: Arial, sans-serif;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-links {
            flex: 1;
            margin: 0 20px;
        }

        .footer-links h4 {
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 5px;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: #ccc;
        }

        .footer-legal {
            width: 100%;
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }

        .footer-legal a {
            color: #777; 
            text-decoration: none; 
            transition: color 0.3s; 
        }

        .footer-legal a:hover {
            color: #fff; 
        }

        .footer-section {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .footer-section img {
            margin-right: 8px;
            height: 30px;
            border-radius: 8px;
        }

        .footer-section div h4 {
            font-size: 16px;
            margin: 0;
            font-weight: bold;
        }

        .footer-section div span {
            font-size: 14px;
            color: #ccc;
        }

        .social-media-section {
            text-align: left;
        }

        .social-media-section h4 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .social-media a {
            color: #fff;
            margin: 0 10px 10px; 
            transition: color 0.3s;
            display: inline-block; 
        }

        .social-media a:hover {
            color: #ccc;
        }

        .social-media i {
            font-size: 24px;
        }
    </style>
</head>
<body>

<div class="footer">
    <div class="footer-inner">
        <div class="footer-links">
            <h4>ABOUT FABLEFORGE</h4>
            <ul>
                <li><a href="about.php">ABOUT US</a></li>
                <li><a href="help.php">HELP/FAQS</a></li>
                <li><a href="#">CAREERS</a></li>
                <li><a href="#">INTERNSHIPS</a></li>
            </ul>
        </div>
        
        <div class="footer-links">
            <h4>ADVERTISING</h4>
            <ul>
                <li><a href="#">FF+</a></li>
                <li><a href="#">FABLEFORGEHQ.COM</a></li>
                <li><a href="#">REDEEM DIGITAL COMICS</a></li>
            </ul>
        </div>

        <div class="footer-links">
            <div class="footer-section">
                <img src="assests/images/logo.webp" alt="FABLEFORGE Insider Logo">
                <div>
                    <h4>FABLEFORGE INSIDER</h4>
                    <span>Get Rewarded for Being a FABLEFORGE Fan</span>
                </div>
            </div>

            <div class="footer-section">
                <img src="assests/images/logo.webp" alt="FABLEFORGE Unlimited Logo">
                <div>
                    <h4>FABLEFORGE UNLIMITED</h4>
                    <span>Access Over 30,000+ Digital Comics</span>
                </div>
            </div>
        </div>

        <div class="footer-links social-media-section">
            <h4>FOLLOW FABLEFORGE</h4>
            <div class="social-media">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
                <a href="#"><i class="fab fa-twitch"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-reddit-alien"></i></a>
                <a href="#"><i class="fab fa-snapchat-ghost"></i></a>
            </div>
        </div>
    </div>
    
    <div class="footer-legal">
        <p>
            <a href="#" class="legal-link">Terms of Use</a> | 
            <a href="#" class="legal-link">Privacy Policy</a> | 
            <a href="#" class="legal-link">Addendum to the Global Privacy Policy</a> | 
            <a href="#" class="legal-link">Interest-Based Ads</a> | 
            <a href="#" class="legal-link">License Agreement</a>
        </p>
        <p>&copy; <script>document.write(new Date().getFullYear());</script> FABLEFORGE. All rights reserved.</p>
    </div>
</div>

</body>
</html>
