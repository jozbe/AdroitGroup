<?php
require_once '../autoloader.php';
class Admin
{
    private static $instance;


    /** @var PDO  */
    private $connection;

    /**
     * Admin constructor.
     * @param $user
     */
    private $user;




    public function __construct($user)
    {
        $this->user = $user;
        $db = DB::getInstance();
        $this->connection = $db->getConnection();
    }
    /**
     * Admin auth check.
     * @param $pass
     */

    public function auth($pass){
        $stmt = $this->connection->prepare('SELECT pass FROM users WHERE user = :user');
        $stmt->bindParam(':user', $this->user);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $valid = password_verify($pass, $row['pass']);
            return $valid;
        }
        return false;
    }
    public function passchange($pass){
        $hash = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->connection->prepare('UPDATE users
                                                        SET pass = :pass
                                                        WHERE user = :user');
        $stmt->bindParam(':pass', $hash);
        $stmt->bindParam(':user', $this->user);
        $stmt->execute();
        if($stmt->rowCount()==1){
            return 1;
        }else return 0;
    }
    private  $valid;

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }
    public function isValid($POST_DATA){
        $old=$POST_DATA['old'];
        $new1=$POST_DATA['new1'];
        $new2=$POST_DATA['new2'];
            if($this->auth($old)){

                if($new1==$new2){
                    $password=$new1;
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number    = preg_match('@[0-9]@', $password);
                   // $specialChars = preg_match('@[^\w]@', $password); //bónusz spec karakterek

                    if(!$uppercase || !$lowercase || !$number  || strlen($password) < 6) {
                        $this->valid= "Weak pw";
                    }else{
                       $this->valid= 'tru';
                       return true;
                    }

                }else{
                    $this->valid= "Different pw";
                }

            }
            else{
                $this->valid= "Wrong old pw";
            }
            return false;
        }


}
