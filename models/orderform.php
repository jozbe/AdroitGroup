<?php

require_once '../autoloader.php';

class OrderForm
{
    /** @var string */
    protected $field_name;
    /** @var string */
    protected $field_mail;
    /** @var string */
    protected $field_comment;
    /** @var string */
    protected $field_newsletter;
    /** @var string */
    protected $field_terms;

    /** @var string|null */
    protected $error_name = null;
    /** @var string|null */
    protected $error_mail = null;
    /** @var string|null */
    protected $error_comment = null;
    /** @var string|null */
    protected $error_newsletter = null;
    /** @var string|null */
    protected $error_terms = null;

    /** @var bool */
    private $is_submitted = false;
    /** @var bool */
    private $is_valid = false;
    /** @var string */
    protected $token;

    /**
     * @return null
     */
    public function getToken()
    {
        return $this->token;
    }

    private $conn;

    public function __construct($POST_DATA = null)
    {
        // Initialize DB connection
        $db = DB::getInstance();
        $this->conn = $db->getConnection();

        if (!is_null($POST_DATA)) {
            $this->field_name = $POST_DATA['name'] ?? "";
            $this->field_mail = $POST_DATA['mail'] ?? "";
            $this->field_comment = $POST_DATA['comment'] ?? "";
            $this->field_newsletter = $POST_DATA['newsletter'] ?? null;
            $this->field_terms = $POST_DATA['terms'] ?? "no";

            $this->is_submitted = isset($POST_DATA['submit']);
        }
    }

    public function validate()
    {
        // Validate name
        $this->valid = true;

        $this->error_name = $this->validateName() ? null : 'A név megadása kötelező!';
        $this->error_mail = $this->validateMail() ? null : 'Az email cím megadása kötelező!';
        $this->error_comment = $this->validateComment() ? null : 'A megjegyzés mező kitöltése hibás!';
        $this->error_newsletter = $this->validateNewsletter() ? null : 'A hírlevél mező kitöltése hibás!';
        $this->error_terms = $this->validateTerms() ? null : 'Az ÁSZF elfogadása kötelező!';

        $this->is_valid = is_null($this->error_name) && is_null($this->error_mail) && is_null($this->error_comment) &&
            is_null($this->error_newsletter) && is_null($this->error_terms);
    }



    /**
     * @return bool
     */
    private function validateName()
    {
        return strlen($this->field_name) > 0;
    }

    /**
     * @return bool
     */
    private function validateMail()
    {
        return filter_var($this->field_mail, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @return bool
     */
    private function validateComment()
    {
        return isset($this->field_comment);
    }

    /**
     * @return bool
     */
    private function validateNewsletter()
    {
        return ($this->field_newsletter == 'on' xor $this->field_newsletter == 'off');
    }

    /**
     * @return bool
     */
    private function validateTerms()
    {
        return $this->field_terms == 'yes';
    }

    /**
     * @param Basket $basket
     * @return bool Success
     */
    public function save($basket)
    {
        
        $this->validate();
        if (!$this->is_valid) {
            return false;
        } else {
            try {
                $statement = $this->conn->prepare('INSERT INTO orders (name, email,comment) VALUES (:name, :email, :comment)');
                $statement->bindParam(':name', $this->field_name);
                $statement->bindParam(':email', $this->field_mail);
                $statement->bindParam(':comment', $this->field_comment);
                $statement->execute();
                $order_id = $this->conn->lastInsertId();

                //newsletter

                if ($this->field_newsletter == 'on') {
                    $stmt = $this->conn->prepare('SELECT * FROM newsletter WHERE email = :email');
                    $stmt->bindParam(':email', $this->field_mail);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$row['email'] == $this->field_mail) {
                        $statement = $this->conn->prepare('INSERT INTO newsletter (email, name,token) VALUES (:email, :name, :token)');
                        $statement->bindParam(':email', $this->field_mail);
                        $statement->bindParam(':name', $this->field_name);

                        $this->token = openssl_random_pseudo_bytes(10);
                        $this->token = bin2hex($this->token);
                        $statement->bindParam(':token', $this->token);
                        $statement->execute();
                    }
                    else{
                        $this->token=$row['token'];
                    }
                }
                foreach ($basket->getContent() as $product) {
                    $statement = $this->conn->prepare('INSERT INTO orders_products (order_id, product_id,quantity) VALUES (:order_id, :product_id, :quantity)');
                    $statement->bindParam(':order_id', $order_id);
                    $statement->bindParam(':product_id', $product['id']);
                    $statement->bindParam(':quantity', $product['value']);
                    $statement->execute();
                }
            } catch (PDOException $exception) {
                return false;
            }
            return true;

        }
    }

    /**
     * GETTERS
     */

    public function isSubmitted()
    {
        return $this->is_submitted;
    }

    public function isValid()
    {
        return $this->is_valid;
    }

    public function getNameValue()
    {
        return $this->field_name;
    }

    public function getNameError()
    {
        return $this->error_name;
    }

    public function getMailValue()
    {
        return $this->field_mail;
    }

    public function getMailError()
    {
        return $this->error_mail;
    }

    public function getCommentValue()
    {
        return $this->field_comment;
    }

    public function getCommentError()
    {
        return $this->error_comment;
    }

    public function getNewsletterValue()
    {
        return $this->field_newsletter == 'on' ? 'on' : 'off';
    }

    public function getNewsletterError()
    {
        return $this->error_newsletter;
    }

    public function getTermsValue()
    {
        return $this->field_terms == 'yes' ? 'checked' : '';
    }

    public function getTermsError()
    {
        return $this->error_terms;
    }


}