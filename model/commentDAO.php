<?php 

class CommentDAO {
    public function countComments($recipy_id) {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT IFNULL(COUNT(*), 0) as count FROM comments WHERE recipy_id = :id";

        $stmt = $conn->prepare($select_query);
        $stmt->bindParam(":id", $recipy_id);
        $stmt->execute();

        $results = $stmt->fetch();

        return $results["count"];
    }

    public function createComment($user_id, $recipy_id, $body) {
        $db = new DB();
        $conn = $db->createInstance();

        $insert_query = "INSERT INTO comments (user_id, recipy_id, body, create_time) VALUES (:user_id, :recipy_id, :body, NOW())";

        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":recipy_id", $recipy_id);
        $stmt->bindParam(":body", $body);
        
        $stmt->execute();

        $results = $stmt->rowCount();

        return $results;
    }

    public function getComments($recipy_id) {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT c.body, c.create_time, u.username  FROM comments c JOIN users u ON (c.user_id = u.id) WHERE c.recipy_id = :id ORDER BY c.create_time";

        $stmt = $conn->prepare($select_query);
        $stmt->bindParam(":id", $recipy_id);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }
}

?>