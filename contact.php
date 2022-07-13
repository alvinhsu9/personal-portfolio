<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'includes/PHPMailer.php';
require 'includes/Exception.php';

if (array_key_exists('email', $_POST)) {
    $err = false;
    $msg = "";
    $email = '';

    //Basic Validation to query
    if (array_key_exists('message', $_POST)) {
        //get subject and message
        $subj = substr(strip_tags($_POST['subject']), 0, 1000);
        $query = substr(strip_tags($_POST['message']), 0, 1000);
    } else {
        $query = '';
        $msg = 'No message provided';
        $err = true;
    }

    //Basic validation to name
    if (array_key_exists('name', $_POST)) {
        $name =  substr(strip_tags($_POST['name']), 0, 255);
    } else {
        $name = '';
    }

    //Validate email address
    if (array_key_exists('name', $_POST) && PHPMailer::validateAddress($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $msg .= 'Error: invalid email address provided';
        $err = true;
    }

    $to = 'alvinhsudesigns@gmail.com';
    $email_body = "";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "E-mail: " . $email . "\n";
    $email_body .= "Message: " . $query . "\n";

    $mail = new PHPMailer();
    $mail->Port = 25;
    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    $mail->setFrom('contactform@alvinhsu.ca', 'Portfolio Contact Form');
    $mail->addAddress($to);
    $mail->addReplyTo($email, $name);
    $mail->Subject = 'Portfolio Contact Form Submission:' . " " . $subj;
    $mail->Body = $email_body;

    $siteKey = "6Ld4a4MgAAAAABpLpuuDsG-X2A9FhZ98_ODiR54y";
    $secretKey = "6Ld4a4MgAAAAADQNpwZQbX5c_gfcKXhvKO-9yqGn";
    $responseKey = $_POST['g-recaptcha-response'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $responseKey;
    $res = file_get_contents($url);
    $results = json_decode($res);

    if ($results->success) {
        if (!$err) {
            if (!$mail->send()) {
                $msg .= 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                $msg .= 'Message sent!';
            }
        }
    } else {
        echo $results->success;
        $msg .= 'Please complete verification';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="icon" href="images/my_logo/icon.svg">
    <link rel="stylesheet" href="styles/contact.css">
    <link rel="stylesheet" href="styles/main.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     <!-- Global site tag (gtag.js) - Google Analytics -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=G-RWJTGBFETJ"></script>
     <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());
     gtag('config', 'UA-203271684-2');
     gtag('config', 'G-RWJTGBFETJ');
     </script>
</head>
<body class="contact-body">
<header class="header">
        <div class="img-wrap">
            <a class="img-link" href="index.html" title="Home Page">
                <img class="img" src="images/my_logo/logo-white.svg" alt="Personal Logo">
            </a>
        </div>
        <button class="gn-trigger">
            <div class="burger"></div> 
        </button>
        <nav class="gn">
            <ul class="gn-items">
                <li>
                    <a href="work.html" title="My Work">Work</a>
                </li>
                <li>
                    <a href="about.html" title="About Me">About</a>
                </li>
                <li>
                    <a href="contact.php" title="Contact">Contact</a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="contact-main">
        <div class="container">
            <div class="profile-pic">
                <img src="images/home-page/contact.jpg" alt="Headshot">
            </div>
            <div class="form">
                <?php if (empty($msg)) { ?>
                    <h1>Let's Chat!</h1>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                        <input type="text" name="name" placeholder="Full Name" id="name" required>
                        <input type="email" name="email" placeholder="Email" id="email" required>
                        <input type="subject" name="subject" placeholder="Subject" id="subject">
                        <textarea id="message" class="textarea" placeholder="Your Message" name="message" rows="8"></textarea>
                        <div class="g-recaptcha" data-callback="captchaVerified" data-sitekey="6Ld4a4MgAAAAABpLpuuDsG-X2A9FhZ98_ODiR54y"></div>
                        <input class="send" type="submit" value="Send" id="submit" disabled>
                    </form>
                <?php } else {
                    echo "<h2 class='msg'>" . $msg . "</h2>";
                    echo "<div class='send'>
                            <a href='https://alvinhsu.ca/contact.php'> Back to form </a>
                        </div>";
                } ?>
            </div>
        </div>
    </main>
    <footer class="contact-footer">
        <div class="copyright">
            <p class="copyright-p">&copy; Alvin Hsu 2022</p>
        </div>
        <div class="socials">
            <a href="https://www.linkedin.com/in/alvinhsu99/" title="LinkedIn Link" target="_blank">
                <div class="socials-holder linkedin"></div>
            </a>
            <a href="https://dribbble.com/alvinhsu" title="Dribbble Link" target="_blank">
                <div class="socials-holder dribbble"></div>
            </a>
            <a href="https://www.behance.net/alvinhsu" title="Behance Link" target="_blank">
                <div class="socials-holder behance"></div>
            </a>
            <a href="https://www.instagram.com/alvinhdesigns/" title="Instagram Link" target="_blank">
                <div class="socials-holder instagram"></div>
            </a>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="scripts/scroll-lock.js"></script>
    <script src="scripts/main.js"> </script>
    <script>
        function captchaVerified() {
            var submitBtn = document.getElementById("submit");
            submitBtn.removeAttribute("disabled");
        }
    </script>
</body>
</html>