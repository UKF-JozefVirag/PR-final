<?php
include_once "classes/DB.php";

use classes\DB;
$db = new DB("localhost", "root", "root", "todophp", "3307");
$listid = $_POST['ulist_id'];
$taskid = $_POST['utask_id'];
$description = $_POST['utask_description'];
$date = $_POST['utask_date'];
$time = $_POST['utask_time'];

$due_date = $date." ".$time;

$update = $db->updateTask($taskid, $description, $due_date);


//TODO: 1. Chyba - pri kliknutí na update btn vždy redirectne na list s id1
//TODO: 2. Chyba - pri kliknutí na submit v update modal vyhodí chybu
header("Location: index.php?id=".$listid);

