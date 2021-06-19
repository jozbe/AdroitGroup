<?php
/** This view renders the order form. Variables:
 * @var ProductForm $FORM
 */

// There is also a helper function for printing the errors:
/**
 * @param string|null $err the error string
 */
function is_invalid($err)
{
    if (!$err == null)
        echo $err . ' is-invalid';
}

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <h1> <?php
                    /** @var TYPE_NAME $action */
                    if($action=='edit') echo 'Termék szerkesztése'; else echo'Új termék hozzáadása'
                    ?></h1>
                <form method="POST">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Név</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" <?php is_invalid($FORM->getNameError()); ?> id="name" name="name" value="<?php echo $FORM->getName()?>">
                        </div>
                        <div class="col-sm-4">
                            <small class="text-danger">
                                <?php echo $FORM->getNameError(); ?>
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mail" class="col-sm-2 col-form-label">Ár</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" <?php is_invalid($FORM->getPriceError()); ?> id="price" name="price" value="<?php echo $FORM->getPrice()?>">
                        </div>
                        <div class="col-sm-4">
                            <small class="text-danger">
                                <?php echo $FORM->getPriceError(); ?>

                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comment" class="col-sm-2 col-form-label">Leírás</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="description" <?php is_invalid($FORM->getDescriptionError()); ?> name="description" value="" text=""><?php echo $FORM->getDescription()?></textarea>
                        </div>
                        <div class="col-sm-4">
                            <small class="text-danger">
                                <?php echo $FORM->getDescriptionError(); ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="stock" class="col-sm-2 col-form-label">Készlet</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" <?php is_invalid($FORM->getStockError()); ?> id="stock" name="stock" value="<?php echo $FORM->getInStock()?>">
                        </div>
                        <div class="col-sm-4">
                            <small class="text-danger">
                                <?php echo $FORM->getStockError(); ?>

                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 offset-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms"<?php is_invalid($FORM->getInPromoError()); ?> name="in_promo" value="true" <?php if( $FORM->getInPromoValue())echo'checked'?>>
                                <label class="form-check-label" for="in_promo">
                                    Akciós
                                </label>
                            </div>
                            <small class="text-danger">
                                <?php echo $FORM->getInPromoError(); ?>

                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 offset-sm-2">
                            <input type="hidden" name="id" id="hiddenField" value="<?php echo $FORM->getId() ?>" />
                            <button type="submit" name="submit" class="btn btn-success">Mentés</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
