<?php
require_once '../autoloader.php';
// Set the name of the current page
$PAGE = 'order';

// Start session
session_start();
if(!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}

// Get the basket
$BASKET = new Basket($_SESSION['basket']);
$FORM   = new OrderForm($_POST);

// Check if the form is submitted
if($FORM->isSubmitted()) {

    // Try to validate
    $FORM->validate();

    // If the form is valid, save it!
    if($FORM->isValid()) {
        $SUCCESS = $FORM->save($BASKET);
        if($SUCCESS){
            include('../views/mail_html.php'); /** @param string $MAIL_HTML */
            // Load PHPMailer
            require '../PHPMailer/PHPMailerAutoload.php';

            try {
                $mail = new PHPMailer();
                $mail->Debugoutput = 'html';
                $mail->IsSMTP();
                $mail->Host = 'mail.jbence.hu';
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';

                $mail->Username = 'info@jbence.hu';
                $mail->Password = '';

                $mail->setFrom('info@jbence.hu', 'Józsa Bence Attila');

                $mail->addAddress($FORM->getMailValue());
                $mail->Subject = 'Rendelés';
                $mail->CharSet = 'UTF-8';
                $mail->isHTML(true); // Set email format to HTML
                $mail->Body = $MAIL_HTML;
                $mail->AltBody = strip_tags($MAIL_HTML);
                $mail->send();
                //echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            $BASKET->remove();
        }
    }
}


// Do the rendering of the page
include '../views/header.php';      // This requres the $PAGE variable
include '../views/order.php';       // This requires $PROMO_PRODUCTS and $OTHER_PRODUCTS
include '../views/footer.php';      // This has no variable requirements
