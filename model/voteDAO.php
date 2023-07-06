<?php 

class VoteDAO {
    public function countVotes($id) {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT IFNULL(AVG(vote), 0) as vote FROM votes WHERE recipy_id = :id";

        $stmt = $conn->prepare($select_query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $results = $stmt->fetch();

        return $results["vote"];
    }

    public function createVote($user_id, $recipy_id, $vote) {
        $db = new DB();
        $conn = $db->createInstance();

        $insert_query = "INSERT INTO votes (user_id, recipy_id, vote) VALUES (:user_id, :recipy_id, :vote)";

        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(":recipy_id", $recipy_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":vote", $vote);
        $stmt->execute();

        $results = $stmt->rowCount();

        return $results;
    }

    public function getVote($user_id, $recipy_id) {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT vote FROM votes WHERE recipy_id = :recipy_id AND user_id = :user_id";

        $stmt = $conn->prepare($select_query);
        $stmt->bindParam(":recipy_id", $recipy_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        $results = $stmt->fetch();

        return $results;
    }
}

?>