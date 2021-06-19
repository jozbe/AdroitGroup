<?php
/** This view is for displaying the basket
 * Used variables:
 * @var  Admin $admin
 */
/** This view contains the layout of the order form. It depends on other views.
 * @var bool $SUCCESS
 */
if( !$SUCCESS ) echo"


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
                <form action=\"passchange\" method=\"post\">

                    <div class=\"form-group row\">
                        <label for=\"old\" class=\"col-sm-2 col-form-label\">Old password:</label>
                        <div class=\"col-sm-6\">
                            <input name=\"old\"  class=\"form-control\"  type=\"password\"   id=\"old\" value=\"\">
                        </div>
                    </div>

                    <div class=\"form-group row\">
                        <label for=\"new1\" class=\"col-sm-2 col-form-label\">New password:</label>
                        <div class=\"col-sm-6\">
                            <input name=\"new1\"  class=\"form-control\" type=\"password\"   id=\"new1\" value=\"\">
                        </div>
                    </div>


                    <div class=\"form-group row\">
                        <label for=\"new2\" class=\"col-sm-2 col-form-label\">New password again:</label>
                        <div class=\"col-sm-6\">
                            <input name=\"new2\"  class=\"form-control\"  type=\"password\"   id=\"new2\" value=\"\">
                        </div>
                    </div> ";
                    if($admin->getValid()!='tru' ) print $admin->getValid();
                    echo "
                    <div class=\"form-group row\">
                        <div class=\"col-sm-10\">
                            <button type=\"submit\" class=\"btn btn-primary\">UPDATE</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
";
?>