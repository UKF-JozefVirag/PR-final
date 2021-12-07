<?php

include_once "classes/DB.php";

use classes\DB;

//TODO vytvorí zaznam v DB napriek tomu že už existuje list s tymto menom

if (isset($_POST['submit'])) {
    $db = new DB("localhost", "root", "root", "todophp", "3307");
    $list_name = $_POST['listname'];
    $insert = $db->newlist($list_name);
}
else echo "Error here";