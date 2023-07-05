<?php 

class recipyController {
    public function getRecipies($page, $limit, $offset) {
        $recipyDAO = new RecipyDAO();

        $results = $recipyDAO->getRecipies($limit, $offset);
        $count = $recipyDAO->getCount();
        $userDAO = new UserDAO();
        require_once("view/html/home.php");
    }
}

?>