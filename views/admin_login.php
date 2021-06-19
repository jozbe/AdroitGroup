<?php
/** This view is for displaying the login
 * Used variables:
 *
 * @var $SUCCESS
 */
    echo "
<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-lg-12\">
            <div class=\"jumbotron\">";
if (!$SUCCESS) {

echo "
    <form action=\"" . $__CLIENT_ROOT . "/admin/authentication\" method=\"post\">
       
    <div class=\"form-group row\">
        <label for=\"user\" class=\"col-sm-2 col-form-label\">User:</label>
         <div class=\"col-sm-6\">
        <input name=\"user\" type=\"text\"   id=\"user\" value=\"\">
        </div> 
    </div>
    <div class=\"form-group row\">
        <label for=\"pw\" class=\"col-sm-2 col-form-label\">Pass:</label>
        <div class=\"col-sm-6\">
        <input name=\"pw\" placeholder=\"\" type=\"password\"   id=\"pw\" value=\"\">
        </div>
    </div>
    <div class=\"form-group row\">
        <div class=\"col-sm-10\">
            <button type=\"submit\" class=\"btn btn-primary\">LOGIN</button>
        </div>
    </div>
   
    ";
} else {
  header('Location: '.$__CLIENT_ROOT.'/admin/orders');
}
echo " </div>
    </div>
    </div>
    </div>";
?>


