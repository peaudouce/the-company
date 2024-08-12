<?php

require "../classes/User.php";

$u = new User;
$u->deleteUser($_POST['id']);