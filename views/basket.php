<?php
/** This view is for displaying the basket
 * Used variables:
 * @var Basket $BASKET
 */
?>
<table id="table" class="table table-striped">
    <thead>
    <tr>
        <th class="name">Termék</th>
        <th class="quantity">Mennyiség</th>
        <th class="price">Ár</th>
        <th class="price">Törlés</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($BASKET->getContent() as $item) {
        include('../views/basket_row.php');
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <th class="name table-info" colspan="3">Összesen:</th>
        <th class="price table-info"><span
                    id="total"><?php echo number_format($BASKET->getTotal(), 0, ',', ' ') ?></span> Ft
        </th>
    </tr>
    </tfoot>
</table>


<script>
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            // Response arrived
            if (request.status == 200) {
                // HTTP response is "200 OK" - we have result
                // var container = document.getElementById('demo');
                //container.innerHTML = request.responseText; // response as raw text
                //window.alert(request.responseText);
                var str = request.responseText;

                var res = str.split(';');
                // 0=dummy 1=add 2=id 3=dbszám 4=string hozzáadásról  5=total

                if (res[1] == "add") {
                    var container = document.getElementById(res[2] + 'val');
                    container.innerText = res[3];
                    var total = document.getElementById('total');
                    total.innerText = res[5];
                    var subprice = document.getElementById(res[2] + 'price');
                    subprice.innerText = res[6] + "Ft";


                } else if (res[1] == "delete") {

                    var container = document.getElementById(res[2]);

                    container.remove();

                    var total = document.getElementById('total');
                    total.innerHTML = res[4];
                    window.alert(res[3]);
                } else if (res[1] == "minus") {
                    var container = document.getElementById(res[2] + 'val');
                    container.innerText = res[3];
                    var total = document.getElementById('total');
                    total.innerText = res[5];
                    var subprice = document.getElementById(res[2] + 'price');
                    subprice.innerText = res[6] + "Ft";


                }

            } else {
                console.log("Error in request");
            }
        }
    }; // Ez a pontosvessző azért van itt, mert ez zárja le az értékadást (a fv. a mező értéke).

    function deleteFromBasket(id) {
        // Legyen lekérdezés
        request.open('GET', '/basket/delete/' + id, true);
        request.send();
    }

    function minusBasket(id) {
        request.open('GET', '/basket/minus/' + id, true);
        request.send();
    }

    function updateBasket(id) {
        request.open('GET', '/basket/add/' + id, true);
        request.send();
    }
</script>
