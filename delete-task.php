<?php
include_once "classes/DB.php";

use classes\DB;

if(isset($_GET['idtask']))
{
    $db = new DB("localhost", "root", "root", "todophp", "3307");
    $delete = $db->deleteTask($_GET['idtask']);

    if ($delete)
    {
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
//          header("Location: index.php");
    }
    else
    {
        echo "Delete failed";
    }

}
else
{
    header("Location: index.php");
}