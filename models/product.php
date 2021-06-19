<?php

require_once '../autoloader.php';
class Product {
    /** @var int  */
    protected $id;

    /** @var string  */
    protected $name;

    /** @var int  */
    protected $price;

    /** @var string  */
    protected $description;
    /**
     * @var bool
     */
    protected $in_promo;

    /** @var int  */
    protected $stock;



    /**
     * Product constructor.
     * @param int $id
     * @param string $name
     * @param int $price
     * @param string $description
     * @param bool $in_promo
     * @param int $stock
     */
    public function __construct($id, $name, $price, $description,$in_promo,$stock) {
        $this->id    = $id;
        $this->price = $price;
        $this->name  = $name;
        // TODO: További mezők hozzáadása
        $this->description=$description;
        $this->in_promo=$in_promo;
        $this->stock=$stock;

    }

    /**
     * Find a product in the DB by ID. The function returns the Product (as object) or null if ID not found
     * @param int $id
     * @return Product|null
     */
    public static function find($id) {
        // Initialize DB connection
        $db = DB::getInstance();
        $conn = $db->getConnection();


        // Select all products from DB
        $stmt = $conn->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Product($row['id'], $row['name'], $row['price'], $row['description'],$row['in_promo'],$row['stock']);
        } else {
            return null;
        }
    }

    /**
     * GETTERS
     */

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function getInPromo(): bool
    {
        return $this->in_promo;
    }

    public function getInStock()
    {
        return $this->stock;
    }



}