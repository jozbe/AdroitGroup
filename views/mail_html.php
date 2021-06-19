<?php
ob_start(); // Ez azért kell, hogy a HTML ne a HTTP-be íródjon, hanem egy bufferbe




?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <h1>Kedves <?php echo $FORM->getNameValue(); ?>!</h1>
    <p>Köszönjük, hogy nálunk rendeltél. Az alábbi termékeket fogjuk szállítani:</p>
<?php
include '../views/basket.php';
?>
<?php
   if($FORM->getToken()!=null) echo "Leiratkozni az alábbi linken tudsz: https://beta.dev.itk.ppke.hu/webprog/~jozbe/unsubscribe/".  $FORM->getToken();
    ?>
    <p>Üdvözlettel:<br>A Webshop tulaja</p>
<?php
$MAIL_HTML = ob_get_clean(); // Ezzel a buffer tartalmát a változóba tesszük, és töröljük a buffert
?>