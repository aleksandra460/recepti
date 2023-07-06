<?php 

if (isset($_COOKIE['post'])) {
    $recipy_id = $_COOKIE['post'];
    $recipy = $recipyDAO->getRecipy($recipy_id);
    ?>
    <div style="text-align:center;">
        <p>Last seen post:</p>
        <?php 
    
    if ($recipy != NULL) {
        ?>
        <a href="<?= getFullServerPath() . "/recipes?id=" . $recipy["id"]; ?>">
        <h3> <?= $recipy["title"] ?> </h3>
        <img src="<?= $recipy["img"] ?>" height="75px" />

        <?php
    }
    ?>
    </a>
    </div>
    <?php
}

?>