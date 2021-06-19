<?php
/** This view is for displaying the basket
 * Used variables:
 * @var  Admin $admin
 */
/** This view contains the layout of the order form. It depends on other views.
 * @var bool $SUCCESS
 */
if (!$SUCCESS) /** @var TYPE_NAME $product_id */
    echo "


<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Passchange</title>
</head>
<body>

<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-lg-12\">
            <div class=\"jumbotron\">
                <form  method=\"post\"> 
                <h1>Biztosan törli az id:". $product_id." terméket?</h1>              

                            <a class=\"navbar-brand\" href=\"". $__CLIENT_ROOT."/admin/products\">Mégse</a>

                      <input type=\"hidden\" name=\"delete\" id=\"hiddenField\" value=\"true\" />

                    <div class=\"form-group row\">
                        <div class=\"col-sm-10\">
                            <button type=\"submit\" class=\"btn btn-primary\">TÖRLÉS</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
";
?>