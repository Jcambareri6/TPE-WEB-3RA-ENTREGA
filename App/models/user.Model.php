<?php
    require_once 'model.php';

class UserModel extends DB {
    public function getByEmail($email) {
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = ?');
        $query->execute([$email]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}
