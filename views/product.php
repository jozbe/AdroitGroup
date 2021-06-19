<?php
/** This view is for displaying a product (object)
 * Used variables:
 * @var Product $product
 */
?>
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="#"><?php echo $product->getName(); ?></a>
            </h4>
            <h5><?php echo number_format($product->getPrice(), 0,',',' ') ?> Ft</h5>
            <h6>Raktáron <?php echo $product->getInStock(); ?></h6>
            <p class="card-text"><?php echo $product->getDescription(); ?></p>
        </div>
        <div class="card-footer text-center">
            <button type="button" onclick="updateBasket(<?php echo $product->getId(); ?>)" id="<?php echo $product->getId(); ?>" class="btn btn-primary" href="basket/add/<?php echo $product->getId(); ?>">Kosárba!</button>
        </div>
    </div>
</div>

