<?php 

class surveyDAO {
    public function getSurvey($user_id) {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT * FROM user_survey WHERE user_id = :user_id";

        $stmt = $conn->prepare($select_query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        $results = $stmt->fetch();

        return $results;
    }

    public function createSurvey($user_id, $vote) {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "INSERT INTO user_survey VALUES (:user_id, :vote)";

        $stmt = $conn->prepare($select_query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":vote", $vote);
        $stmt->execute();

        $results = $stmt->rowCount();

        return $results;
    }

    public function getVoteCount() {
        $db = new DB();
        $conn = $db->createInstance();

        $select_query = "SELECT COUNT(CASE WHEN vote = 1 THEN 1 END) AS yes, COUNT(CASE WHEN vote = 0 THEN 1 END) AS no FROM user_survey";

        $stmt = $conn->prepare($select_query);
        $stmt->execute();

        $results = $stmt->fetch();

        return $results;
        
    }
}

?>