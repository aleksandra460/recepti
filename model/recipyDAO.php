<?php 

class recipyDAO {

    public function getRecipies($limit, $offset) {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT * FROM recipies WHERE is_deleted = 0 LIMIT :limit OFFSET :offset";

        $stmt = $conn->prepare($select_query);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

    public function getRecipy($id) {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT * FROM recipies WHERE id = :id AND is_deleted = 0";

        $stmt = $conn->prepare($select_query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $results = $stmt->fetch();

        return $results;
    }

    public function getRecipesByUserId($user_id) {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT * FROM recipies WHERE user_id = :user_id AND is_deleted = 0";

        $stmt = $conn->prepare($select_query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

    public function createRecipy($user_id, $title, $body) {
        $db = new DB();
        $conn = $db->createInstance();

        $insert_query = "INSERT INTO recipies (title, body, user_id, create_time) VALUES (:title, :body, :user_id, NOW())";

        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        $result = $stmt->rowCount();

        return $result;
    }

    public function deleteRecipy($id) {
        $db = new DB();
        $conn = $db->createInstance();

        # Soft delete
        $update_query = "UPDATE recipies SET is_deleted = 1 WHERE id = :id";

        $stmt = $conn->prepare($update_query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $result = $stmt->rowCount();

        return $result;
    }

    public function updateRecipy($id, $body) {
        $db = new DB();
        $conn = $db->createInstance();

        $update_query = "UPDATE recipies SET body = :body WHERE id = :id";

        $stmt = $conn->prepare($update_query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":body", $body);
        $stmt->execute();

        $result = $stmt->rowCount();

        return $result;
    }

    public function getCount() {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT COUNT(*) as count FROM recipies";

        $stmt = $conn->prepare($select_query);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }
}

?>