<?php


class Subscribers
{
    public function unsubscribe($token) {
        $db = DB::getInstance();
        $conn = $db->getConnection();

        // Select all products from DB
        $stmt = $conn->prepare('DELETE  FROM newsletter WHERE token = :token');
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        if( ! $stmt->rowCount() ) return "Ajaj, ez a token nem megfelelő";
        else return"Sikeresen leiratkoztál";
    }

}