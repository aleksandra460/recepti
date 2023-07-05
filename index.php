<?php 

require('flight/Flight.php');
require('conf/db.php');

session_start();

Flight::route("GET /", function() {
    $_SESSION["current_page"] = "home";
    require_once("view/html/home.php");
});

Flight::start();

?>