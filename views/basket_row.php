<?php
/** This view is for displaying the basket
 * Used variables:
 *
 * @var $item
 */
require_once $__SERVER_ROOT.'/autoloader.php';
    echo "
                           
                            <tr  id='".$item['id']."'>
                                <td >" . $item['name'] . "</td>
                                <td>
                                    <button onclick='minusBasket(".$item['id'].")' >-</button>
                                    <span id='".$item['id']."val'>" . $item['value'] . " </span>
                                    <button onclick='updateBasket(".$item['id'].")'  >+</button>

                                 </td>
                                <td ><span id='".$item['id']."price'>" . $item['price'] . "Ft</span> </td> 
                                <td > <button onclick='deleteFromBasket(".$item['id'].")'  >Törlés</button></td>   
    
                             </tr>
                            ";

    ?>
</tr>