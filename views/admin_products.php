<?php
/** This view contains the general skeleton of the site; a greeting section and two areas for the product listings
 * Used variables:
 * @var ProductList $PROMO_PRODUCTS object of the list of promo products
 * @var ProductList $OTHER_PRODUCTS object containing the non-promo products
 */
echo '<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
<h1>Termékek</h1>'
;
echo "        <a class=\"navbar-brand\" href=\"". $__CLIENT_ROOT."/admin/product/new\">Új termék hozzáadása</a>
";

echo '        <table class="table table-striped">

  <tr>     
    <th>Név</th>
    <th>Ár</th>
    <th>Leírás</th>
    <th>Akciós</th>
    <th>Készlet</th>
    <th>Szerkesztés</th>
    <th>Törlés</th>
  </tr>';

foreach ($PROMO_PRODUCTS->getProducts() as $product) {
    echo " <tr>
    <td>" . $product->getName() . "</td>
    <td>" . $product->getPrice() . "</td>
    <td>" . $product->getDescription() . "</td>
    <td>Igen</td>
    <td>" . $product->getInStock() . "</td>
    <td>
            <a type=\"button\" class=\"btn \" href=\"" . $__CLIENT_ROOT . "/admin/product/edit/" . $product->getId() . "\">Szerkesztés</a>
       </td>
    <td>     
           <a type=\"button\" class=\"btn\" style='background: darkred; border-color: darkred' href=\"" . $__CLIENT_ROOT . "/admin/product/delete/" . $product->getId() . "\">Törlés</a>
    </td>
    </tr>";
}
foreach ($OTHER_PRODUCTS->getProducts() as $product) {
    echo " <tr>
      <td>" . $product->getName() . "</td>
    <td>" . $product->getPrice() . "</td>
    <td>" . $product->getDescription() . "</td>
    <td>Nem</td>
    <td>" . $product->getInStock() . "</td>

     <td>
            <a type=\"button\" class=\"btn \"  href=\"" . $__CLIENT_ROOT . "/admin/product/edit/" . $product->getId() . "\">Szerkesztés</a>
    </td>
    <td>   
             <a type=\"button\" class=\"btn \" style='background: darkred; border-color: darkred' href=\"" . $__CLIENT_ROOT . "/admin/product/delete/" . $product->getId() . "\">Törlés</a>
    </td>
    </tr>";
}


echo('</tr>
</table>
</div>
</div>
</div>
</div> ');
?>




