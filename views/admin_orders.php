<?php
/** This view is for displaying the basket
 * Used variables:
 *
 * @var $list_of_orders
 */

echo '<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
<h1>Rendelések</h1>';

foreach ($list_of_orders as $order) {
    echo '        <table class="table table-striped">
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Comment</th>
                  </tr>';
    echo "
                  <tr>
                    <td>" . $order['order']['id'] . "</td>
                    <td>" . $order['order']['name'] . "</td>
                    <td>" . $order['order']['email'] . "</td>
                    <td>" . $order['order']['comment'] . "</td>
                    </tr>
                </table>";
    echo '
                <table class="table table-striped">
                <tr>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    </tr>';

    foreach ($order['order_product'] as $k => $v) {
        echo "<tr>
    <td>" . $k . "</td>
    <td>" . $v . "</td>
    
    </tr>";
    }
    echo ' </table> <p>&nbsp;</p> 
                    <p></p> ';

}

echo('</tr>
</table>
</div>
</div>
</div>
</div> ');