<?php

require "../classes/User.php";

$u = new User;
$u->uploadPhoto($_POST, $_FILES);