<?php
session_start();
include("db.php");
include("fn.php");
$fns = new FNS();
$db = new DB($fns);
?>