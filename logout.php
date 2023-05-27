<?php
session_start();
require_once "LoginKoneksi.php";
unset($_SESSION['username']);
session_destroy();
header("location: login.php");