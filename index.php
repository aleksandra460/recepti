<?php 

require('flight/Flight.php');
require('conf/db.php');
require('conf/server.php');
require('model/recipyDAO.php');
require('model/userDAO.php');
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

Flight::start();

?>