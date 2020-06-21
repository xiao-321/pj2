<?php
require_once('src/php/config.php');
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "SELECT travelimagefavor.ImageID, Count(travelimagefavor.UID) AS NumFavor, travelimage.PATH, travelimage.Description, travelimage.Title, travelimage.ImageID
    FROM travelimage JOIN travelimagefavor ON travelimagefavor.ImageID=travelimage.ImageID
    GROUP BY travelimagefavor.ImageID
    ORDER BY NumFavor DESC";
   $result = $pdo->query($sql);
   $pictures = array();
   $titles = array();
   $descriptions = array();
   $imageID = array();
   for ($i = 0; $i < 8 && $row = $result->fetch(); $i++ ){
       array_push($pictures, $row['PATH']);
       array_push($titles, $row['Title']);
       array_push($descriptions, $row['Description']);
       array_push($imageID, $row['ImageID']);
   }
} catch (Exception $e) {
    echo "Error:" . $e->getMessage();
    exit;
}

function outputImages($pictures, $titles, $descriptions,$imageID){
    for ($i = 0; $i < 8 ;$i++){
        if($descriptions[$i]==""){$descriptions[$i]="No description";}
        if($titles[$i]==""){$titles[$i]="A beautiful picture";}
        echo '
        <div class="item">
            <a href="details.php?id='.$imageID[$i].'">
                <img src="images/normal/medium/'.$pictures[$i].'" alt="I\'m a beautiful picture">
            </a>
            <div class="name">
                '.$titles[$i].'
            </div>
            <div class="description">
                '.$descriptions[$i].'
            </div>
        </div>
    ';
    }
}
outputImages($pictures, $titles, $descriptions,$imageID);
$pdo = NULL;