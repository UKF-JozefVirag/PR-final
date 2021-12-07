<?php
include_once "classes/DB.php";

use classes\DB;

if (isset($_POST['newtask']))
{
    $db = new DB("localhost", "root", "root", "todophp", "3307");

    $description = $_POST['task_description'];
    $date = $_POST['task_date'];
    $time = $_POST['task_time'];
    $list = $_POST['list_id'];
//    $list = $_POST['task_list_id'];
    $status = 0;

    $insert = $db->insertTask($description, $date.' '.$time, $list, $status);

    if($insert) {
        header("Location: index.php?id=".$list);
    } else {
        echo "Task not inserted";
    }

} else {
    echo "Err";
}