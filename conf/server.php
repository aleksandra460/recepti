<?php

$server_config = [
    "host" => $_SERVER["HTTP_HOST"],
    "schema" => "https://",
    "path" => "",
];

function getFullServerPath() {
    global $server_config;
    return $server_config["schema"] . $server_config["host"] . $server_config["path"];
}

?>