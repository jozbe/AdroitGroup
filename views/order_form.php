<?php
/** This view renders the order form. Variables:
 * @var OrderForm $FORM
 */

// There is also a helper function for printing the errors:
/**
 * @param string|null $err the error string
 */
function is_invalid($err)
{
    // TODO: megírni. Csak akkor printelje ki a hiba-class-t ha tényleg hibás a mező
    if (!$err == null)
        echo $err . ' is-invalid';
}

// TODO: Bővítsd az űrlap mezőit; elküldött űrlap esetében jelenjen meg a korábban kitöltött adat és a hibaüzenet!
?>
<form method="POST">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Név</label>
        <div class="col-sm-6">
            <input type="text" class="form-control"<?php is_invalid($FORM->getNameError()); ?> id="name" name="name"
                   value="<?php echo $FORM->getNameValue(); ?>">
        </div>
        <div class="col-sm-4">
            <small class="text-danger">
                <?php echo $FORM->getNameError(); ?>
            </small>
        </div>
    </div>
    <div class="form-group row">
        <label for="mail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-6">
            <input type="email" class="form-control"<?php is_invalid($FORM->getMailError()); ?> id="mail" name="mail"
                   value="<?php echo $FORM->getMailValue(); ?>">
        </div>
        <div class="col-sm-4">
            <small class="text-danger">
                <?php echo $FORM->getMailError(); ?>
            </small>
        </div>
    </div>
    <div class="form-group row">
        <label for="comment" class="col-sm-2 col-form-label">Megjegyzés</label>
        <div class="col-sm-6">
            <textarea class="form-control"<?php is_invalid($FORM->getCommentError()); ?> id="comment" name="comment"
                      value="<?php echo $FORM->getCommentValue(); ?>"></textarea>
        </div>
        <div class="col-sm-4">
            <small class="text-danger">
                <?php echo $FORM->getCommentError(); ?>
            </small>
        </div>
    </div>
        <div class="form-group row">

            <div class="col-sm-6 offset-sm-2">
                <div class="form-check">
                    <input class="form-check-input" <?php is_invalid($FORM->getNewsletterError()); ?> type="radio"
                           name="newsletter" id="newsletter_off" value="off" checked>
                    <label class="form-check-label" for="newsletter_off">
                        Nem kérek hírlevelet
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="newsletter" id="newsletter_on" value="on">
                    <label class="form-check-label" for="newsletter_on">
                        Szeretnék hírlevelet kapni
                    </label>
                </div>
                <small class="text-danger">
                    <?php echo $FORM->getNewsletterError(); ?>
                </small>
            </div>
        </div>

    <div class="form-group row">
        <div class="col-sm-6 offset-sm-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms" name="terms"
                       value="yes"<?php echo $FORM->getTermsValue(); ?>>
                <label class="form-check-label" for="terms">
                    Az <a href="terms.php">Álatlános Szerződési Feltételeket</a> elolvastam és elfogadom
                </label>
            </div>
            <small class="text-danger">
                <?php echo $FORM->getTermsError(); ?>
            </small>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 offset-sm-2">
            <button type="submit" name="submit" class="btn btn-success">Megrendelem!</button>
        </div>
    </div>
</form>