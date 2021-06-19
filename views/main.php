<?php
/** This view contains the general skeleton of the site; a greeting section and two areas for the product listings
 * Used variables:
 * @var ProductList $PROMO_PRODUCTS object of the list of promo products
 * @var ProductList $OTHER_PRODUCTS object containing the non-promo products
 */
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <h1 class="display-4">Üdvözöljük áruházunkban!</h1>
                <p>Az oldal referenciaként szolgál.</p>
            </div>
            <!-- /.jumbotron -->
            <section>
                <h1 class="text-primary">Akciós termék</h1>
                <div class="row">
                    <?php
                    foreach ($PROMO_PRODUCTS->getProducts() as $product) {
                        include('../views/product.php');
                    }
                    ?>
                </div>
                <!-- /.row -->
            </section>

            <section>
                <h1 class="text-primary">További termékeink</h1>
                <div class="row">
                    <?php
                    foreach ($OTHER_PRODUCTS->getProducts() as $product) {
                        include('../views/product.php');
                    }
                    ?>
                </div>
                <!-- /.row -->
            </section>
        </div>
        <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

<script>
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            // Response arrived
            if (request.status == 200) {
                var str = request.responseText;
                var res = str.split(';');
                // HTTP response is "200 OK" - we have result
               // var container = document.getElementById('demo');
                //container.innerHTML = request.responseText; // response as raw text
                window.alert(res[3]+res[4]);
            } else {
                console.log("Error in request");
            }
        }
    }; // Ez a pontosvessző azért van itt, mert ez zárja le az értékadást (a fv. a mező értéke).

    function updateBasket(id) {
        // Legyen lekérdezés
        request.open('GET', '/basket/add/' + id, true);
        request.send();
    }

</script>
