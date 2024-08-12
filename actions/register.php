<?php

require "../classes/User.php";

$user = new User;

$user->createUser($_POST);
?>