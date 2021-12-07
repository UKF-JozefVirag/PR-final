<?php
include_once "classes/DB.php";

use classes\DB;
$db = new DB("localhost", "root", "root", "todophp", "3307");

if (isset($_GET['idtask']))
{
    $id = $_GET['idtask'];
}
else echo "task not set";

$task = $db->getTask($id);

//TODO : Dostať sem miesto 1 - listID
header("Location: index.php?id=1&upidtask=".$_GET['idtask']);


