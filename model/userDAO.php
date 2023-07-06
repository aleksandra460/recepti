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

        $result = [];
        $result["rowCount"] = $stmt->rowCount();
        $result["lastInsertId"] = $conn->lastInsertId();
        return $result;
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

    public function getAllUsers() {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT id, username, is_banned, is_admin FROM users";

        $stmt = $conn->prepare($select_query);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

    public function banUser($id, $ban) {
        $db = new DB();
        $conn = $db->createInstance();

        $update_query = "UPDATE users SET is_banned = :ban WHERE id = :id";

        $stmt = $conn->prepare($update_query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":ban", $ban);
        $stmt->execute();

        $results = $stmt->rowCount();

        return $results;
    }

    public function makeAdmin($id) {
        $db = new DB();
        $conn = $db->createInstance();

        $update_query = "UPDATE users SET is_admin = 1 WHERE id = :id";

        $stmt = $conn->prepare($update_query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $results = $stmt->rowCount();

        return $results;
    }
}

?>