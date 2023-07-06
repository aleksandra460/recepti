<?php 

require('flight/Flight.php');
require('conf/db.php');
require('conf/server.php');
require('model/recipyDAO.php');
require('model/userDAO.php');
require('model/voteDAO.php');
require('model/surveyDAO.php');
require('model/commentDAO.php');
require('controller/userController.php');
require('controller/recipyController.php');

session_start();

Flight::route("GET /", function() {
    $_SESSION["current_page"] = "home";

    $page = isset($_GET["page"]) ? $_GET["page"] : 0;
    $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
    $offset = $page * $limit;
    
    $recipyController = new RecipyController();
    $recipyController->getRecipies($page, $limit, $offset);
});

Flight::route("GET /profile", function() {
    $_SESSION["current_page"] = "profile";
    unset($_SESSION["loginerror"]);
    unset($_SESSION["registererror"]);

    if (isset($_GET["loginerror"])) {
        $_SESSION["loginerror"] = $_GET["loginerror"];
    }

    $userController = new UserController();
    $userController->getProfile();
});

Flight::route("POST /login", function() {
    $userController = new UserController();
    if ($_POST["username"] == "" || $_POST["password"] == "") {
        header("Location: " . getFullServerPath() . "/profile?loginerror=All+%20+fields+%20+are+%20+required");
        exit();
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    $userController->login($username, $password);
});

Flight::route("GET /logout", function() {
    session_unset();
    header("Location: " . getFullServerPath());
    exit();
});

Flight::route("GET /recipes", function() {
    unset($_SESSION["commenterror"]);
    unset($_SESSION["voteerror"]);
    
    if (!isset($_GET["id"])) {
        header("Location: " . getFullServerPath());
        exit();
    }

    $id = $_GET["id"];
    $recipyController = new RecipyController();
    $recipyController->getRecipe($id);
});

Flight::route("POST /comments", function() {
    if (!isset($_SESSION["user"])) {
        header("Location: " . getFullServerPath() . "/profile");
        exit();
    }
    $user_id = $_SESSION["user"]["id"];
    $recipy_id = $_POST["post_id"];
    $body = trim($_POST["body"]);
    $recipyController = new RecipyController();

    if ($body == "") {
        $_SESSION["commenterror"] = "Comment field cannot be empty";
        $recipyController->getRecipe($recipy_id);
        exit();
    }

    $recipyController->createComment($user_id, $recipy_id, $body);
});

Flight::route("POST /vote", function() {
    if (!isset($_SESSION["user"])) {
        header("Location: " . getFullServerPath() . "/profile");
        exit();
    }
    
    $vote = $_POST["vote"];
    $recipyController = new RecipyController();
    if ($vote > 5 || $vote < 1) {
        $_SESSION["voteerror"] = "Vote must be between 1 and 5";
        $recipyController->getRecipe($_POST["recipy_id"]);
        exit();
    }

    $recipy_id = $_POST["recipy_id"];
    $user_id = $_SESSION["user"]["id"];
    $recipyController->createVote($user_id, $recipy_id, $vote);
});

Flight::route("GET /write", function() {
    if (!isset($_SESSION["user"])) {
        header("Location: " . getFullServerPath() . "/profile");
        exit();
    }

    unset($_SESSION["writeerror"]);

    $_SESSION["current_page"] = "write";
    require_once("view/html/write-recipe.php");
});

Flight::route("POST /write", function() {
    if (!isset($_SESSION["user"])) {
        header("Location: " . getFullServerPath() . "/profile");
        exit();
    }

    $title = $_POST["title"];
    $img = $_POST["img"];
    $body = $_POST["body"];

    if ($title == "" || $img == "" || $body == "") {
        $_SESSION["writeerror"] = "All fields are required";
        require_once("view/html/write-recipe.php");
        exit();
    }

    $recipyController = new RecipyController();
    $recipyController->createRecipy($_SESSION["user"]["id"], $title, $img, $body);
});

Flight::route("GET /survey", function() {
    if (!isset($_SESSION["user"]) || !isset($_GET["answer"])) {
        header("Location: " . getFullServerPath() . "/profile");
        exit();
    }

    $user_id = $_SESSION["user"]["id"];
    $answer = $_GET["answer"];
    $userController = new UserController();
    $userController->answerSurvey($user_id, $answer);
});

Flight::route("GET /admin", function() {
    if (!isset($_SESSION["user"]) || $_SESSION["user"]["is_admin"] != 1) {
        header("Location: " . getFullServerPath() . "/profile");
        exit();
    }

    $_SESSION["current_page"] = "admin";

    $userController = new UserController();
    $userController->getAdminPanel();
});

Flight::route("GET /ban", function() {
    if (!isset($_SESSION["user"]) || $_SESSION["user"]["is_admin"] != 1 || !isset($_GET["id"]) || !isset($_GET["ban"])) {
        header("Location: " . getFullServerPath() . "/admin");
        exit();
    }

    $user_id = $_GET["id"];
    $ban = $_GET["ban"];

    $userController = new UserController();
    $userController->banUser($user_id, $ban);
});

Flight::route("GET /make-admin", function() {
    if (!isset($_SESSION["user"]) || $_SESSION["user"]["is_admin"] != 1 || !isset($_GET["id"])) {
        header("Location: " . getFullServerPath() . "/admin");
        exit();
    }

    $user_id = $_GET["id"];

    $userController = new UserController();
    $userController->makeAdmin($user_id);
});

Flight::route("POST /register", function() {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $userController = new UserController();
    $userController->createUser($username, $email, $password, $confirm_password);
});

Flight::route("GET /about-us", function() {
    require_once("view/html/about-us.php");

});

Flight::start();

?>