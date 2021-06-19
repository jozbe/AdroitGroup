<?php
/** This view contains the layout of the order form. It depends on other views.
 * @var bool $SUCCESS
 */
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="display-4">Kosár tartalma</h1>
            <?php include('../views/basket.php'); ?>

            <h1 class="text-primary">Megrendelés</h1>
            <?php
            if(!isset($SUCCESS)){
                include('../views/order_form.php');
            }
            else{
              echo "<p class=\"text-primary\">Sikeres rendelés! A megrendelésről e-mailben is értesítést küldtünk.</p>";
            }

            ?>
        </div>
        <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
</div >