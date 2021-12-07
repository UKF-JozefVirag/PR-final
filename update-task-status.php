<?php
include_once "classes/DB.php";

use classes\DB;
    $db = new DB("localhost", "root", "root", "todophp", "3307");
    $id = $_POST['id'];
    $status = $_POST['status'];

    $update = $db->updateStatus($id, $status);

