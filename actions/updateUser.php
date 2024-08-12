<?php

require "../classes/User.php";

$u = new User;
$u->updateUser($_POST);
?>