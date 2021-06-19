<?php


class Admin_Orders
{

    /** @var PDO */
    private $connection;


    /**
     * Admin_Orders constructor.
     */
    public function __construct()
    {
        $db = DB::getInstance();
        $this->connection = $db->getConnection();
    }

    public function listOrders()
    {
        $orders = [];
        $stmt = $this->connection->prepare('SELECT * FROM orders');
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stmt2 = $this->connection->prepare('SELECT product_id, quantity FROM orders_products WHERE order_id= :order_id ');
            $stmt2->bindParam(':order_id', $row['id']);
            $stmt2->execute();
           // $prod = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            $prod_ord=[];
            while ($prod = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $prod_ord[$prod['product_id']]=$prod['quantity'];
            }
            array_push($orders,array("order" => $row,"order_product" =>  $prod_ord));

        }

            return $orders;
    }

}