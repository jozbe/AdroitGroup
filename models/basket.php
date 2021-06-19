<?php

require_once '../autoloader.php';

class Basket
{

    /** @var array<int,int> */
    protected $counter;

    /** @var PDO */
    private $conn;

    /**
     * Basket constructor.
     * @param $session
     */
    public function __construct(&$session)
    {
        $db = DB::getInstance();
        $this->conn = $db->getConnection();

        $this->counter = &$session;
    }

    /**
     * Add a Product to the basket
     * @param Product $product
     */
    public function add($product)
    {

        if (!isset($this->counter[$product->getId()]))
            $this->counter[$product->getId()] = 1;
        else
            $this->counter[$product->getId()]++;
    }

    /**
     * Clear the basket
     */
    public function remove()
    {
        $this->counter = [];
    }

    /**
     * GETTERS
     */

    public function getTotal()
    {
        $total = 0;
        foreach ($this->counter as $key => $value) {
            $total += Product::find($key)->getPrice() * $value;
        }
        return $total;
    }

    public function getContent()
    {

        $products = [];
        foreach ($this->counter as $key => $value) {
            $product = Product::find($key);
            $name = $product->getName();
            $price = $product->getPrice() * $value;
            array_push($products, array("id" => $key, "name" => $name, "value" => $value, "price" => $price));
        }
        return $products;
    }

    public function removeProduct($id)
    {
        unset($this->counter[$id]);
    }

    public function minus($product)
    {
       
        $this->counter[$product->getId()]--;
    }


}