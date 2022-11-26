<?php
include("wsp_rad/wsp_rad.inc.php");
session_start();

session_destroy();

$cookie->destroy("csrf");

header("Location: login.php");

?>