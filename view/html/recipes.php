<div>
    <p>Results per page:
    <select name="resultsperpage" onchange="location = this.value;">
        <option <?= (isset($_GET["limit"]) && $_GET["limit"] == "10") ? "selected='selected'" : ""; ?> value="<?= getFullServerPath() . "/?page=0&limit=" . 10 ?>">10</option>
        <option <?= (isset($_GET["limit"]) && $_GET["limit"] == "5") ? "selected='selected'" : ""; ?> value="<?= getFullServerPath() . "/?page=0&limit=" . 5 ?>">5</option>
        <option <?= (isset($_GET["limit"]) && $_GET["limit"] == "2") ? "selected='selected'" : ""; ?> value="<?= getFullServerPath() . "/?page=0&limit=" . 2 ?>">2</option>
    </select>
    </p>
</div>

<?php 

foreach($results as $result) {
    ?>
    <div class="recipe-card">
        <a href="<?= getFullServerPath() . "/recipes?id=" . $result["id"] ?>">
        <h3>
            <?= $result["title"] ?>
        </h3>
        <p>Score: <?= number_format($voteDAO->countVotes($result["id"]), 2); ?>/5</p>
        <p>
            <?= substr($result["body"], 0, 50) . '... (read more)'; ?>
        </p>
        <img src="<?= $result["img"]; ?>" height="250px" />
        <p>
            Posted on <?= $result["create_time"] ?> 
            by <?php 
                $u = $userDAO->getUser($result["user_id"]);
                echo($u["username"]);  
            ?>
        </p>
        <p>
            <?php 
            $comm_count = $commentDAO->countComments($result["id"]);
            echo("Comments: " . $comm_count);
            ?>
        </p>
        </a>
        <hr>
    </div>
    <?php
}
?> 
<div>
    Page:&nbsp;
<?php
$num = 0;
if (((int)$count["count"] % (int)$limit) != 0) {
    $num = (int)$count["count"] / (int)$limit + 1;
} else {
    $num = (int)$count["count"] / (int)$limit;
}
for ($i = 1; $i <= $num; $i++) {
    ?>
    <span class="page-span"> <a href="<?= getFullServerPath() . "/?page=" . ($i - 1) . "&limit=" . $limit ?>"><?= $i; ?></a></span>&nbsp;
    <?php
}
?>
</div>