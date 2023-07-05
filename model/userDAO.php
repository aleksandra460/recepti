<?php 

class UserDAO {
    public function createUser($user) {
        $db = new DB();
        $conn = $db->createInstance();

        $insert_query = "INSERT INTO users (email, username, password, create_time) VALUES (:email, :username, :password, NOW())";

        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(":email", $user["email"]);
        $stmt->bindParam(":username", $user["username"]);
        $stmt->bindParam(":password", $user["password"]);
        $stmt->execute();

        $results = $stmt->rowCount();

        return $results;
    }

    public function getUser($id) {
        $db = new DB();
        $conn = $db->createInstance();

        $insert_query = "SELECT * FROM users WHERE id = :id";

        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $results = $stmt->fetch();

        return $results;
    }

    public function getUserByUsernamePassword($username, $password) {
        $hash = hash("sha256", $password);
        
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT * FROM users WHERE username = :username AND password = :password";

        $stmt = $conn->prepare($select_query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hash);
        $stmt->execute();

        $results = $stmt->fetch();

        return $results;
    }
}

?>