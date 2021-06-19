<?php
require_once '../autoloader.php';


class ProductForm extends Product
{

    /** @var string|null */
    protected $error_name = null;
    /** @var string|null */
    protected $error_price = null;
    /** @var string|null */
    protected $error_description = null;
    /** @var string|null */
    protected $error_in_promo = null;
    protected $error_in_stock = null;

    /** @var bool */
    private $is_submitted = false;
    /** @var bool */
    private $is_valid = false;

    /**
     * Product constructor.
     * @param int $id
     * @param string $name
     * @param int $price
     * @param string $description
     */
    private $connection;

    public function __construct($POST_DATA)
    {

        $db = DB::getInstance();
        $this->connection = $db->getConnection();
        parent::__construct(null, null, null, null, null,null);
        if (!is_null($POST_DATA)) {
            $this->id = $POST_DATA['id'] ?? null;
            $this->name = $POST_DATA['name'] ?? '';
            $this->price = $POST_DATA['price'] ?? '';
            $this->description = $POST_DATA['description'] ?? '';
            if (isset($POST_DATA['in_promo'])) {
                $this->in_promo = true;
            } else {
                $this->in_promo = false;
            }
            $this->description = $POST_DATA['description'] ?? '';
            $this->is_submitted = isset($POST_DATA['submit']);
            $this->stock=$POST_DATA['stock'] ?? '';
        }
    }

    public function validate()
    {
        // Validate name
        $this->valid = true;

        $this->error_name = $this->validateName() ? null : 'A név megadása kötelező!';
        $this->error_price = $this->validatePrice() ? null : 'Az ár megadása kötelező!';
        $this->error_description = $this->validateDescription() ? null : 'A leírás mező kitöltése hibás!';
        $this->error_in_promo = $this->validateInPromo() ? null : 'IN promo választás hiba!';
        $this->error_in_stock = $this->validateStock() ? null : 'Stock hiba!';

        $this->is_valid = is_null($this->error_name) && is_null($this->error_price) && is_null($this->error_description) &&
            is_null($this->error_in_promo)  && is_null($this->error_in_stock) ;
    }


    /**
     * @return bool
     */
    private function validateName()
    {
        return strlen($this->name) > 0;
    }

    /**
     * @return bool
     */
    private function validatePrice()
    {
        return ($this->price > 0);
    }

    /**
     * @return bool
     */
    private function validateDescription()
    {
        return isset($this->description);
    }

    public function findById($product_id)
    {
        $product = parent::find($product_id);
        $this->id = $product->getId();
        $this->name = $product->getName();
        $this->price = $product->getPrice();
        $this->description = $product->getDescription();
        $this->in_promo = $product->getInPromo();
    }


    /**
     * @return bool
     */
    private function validateInPromo()
    {
        return $this->in_promo == true or $this->in_promo==false;
    }

    private function validateStock()
    {
        return is_numeric($this->stock)  && intval($this->stock)>=0 ;
    }


    public function getNameError()
    {
        return $this->error_name;
    }


    public function getPriceError()
    {
        return $this->error_price;
    }


    public function getDescriptionError()
    {
        return $this->error_description;
    }


    public function isSubmitted()
    {
        return $this->is_submitted;
    }

    public function getInPromoValue()
    {
        return $this->in_promo == 'yes' ? 'checked' : '';
    }


    public function getInPromoError()
    {
        return $this->error_in_promo;
    }
    public function getStockError()
    {
        return $this->error_in_stock;
    }


    public function save()
    {
        $akcios = $this->in_promo == 'yes' ? true : false;
        if ($this->id != null) {
            $stmt = $this->connection->prepare('UPDATE products
                                                        SET name = :name,
                                                            price= :price,
                                                            description= :description,                                                            
                                                            in_promo= :in_promo,
                                                            stock=:stock
                                                        WHERE id = :id');
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':in_promo', $akcios);
            $temp_stock=intval($this->stock);
            $stmt->bindParam(':stock', $temp_stock);
        } else {
            //itt insert van
            $stmt = $this->connection->prepare('INSERT INTO products (name,price,description,stock,in_promo)
                                                       VALUES (:name,:price,:description,:stock,:in_promo)');
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':in_promo', $akcios);
            $temp_stock=intval($this->stock);
            $stmt->bindParam(':stock', $temp_stock);


        }

        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            return 1;
        } else return 0;

    }

    public function productInUse($id){
        $stmt2 = $this->connection->prepare('SELECT * FROM orders_products WHERE product_id = :id');
        $stmt2->bindParam(':id', $id);
        $stmt2->execute();

        if ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }
         else {
             return false;
        }
    }
    public function delete($id)
    {


            $stmt = $this->connection->prepare('DELETE FROM products WHERE id=:id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                return 1;
            } else return 0;

    }

    public static function new()
    {
        return new Product(null, null, null, null, null,null);
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->is_valid;
    }


}