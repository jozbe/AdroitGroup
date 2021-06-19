<?php
/** This view is for displaying a product (object)
 * Used variables:
 * @var  $result
 * @var  $token
 */
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php if(isset($token)) echo $result;
                        else echo 'Ezen az oldalon tudsz leiratkozni'?></h1>
        </div>
    </div>
</div>
