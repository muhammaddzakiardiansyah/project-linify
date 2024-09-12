<?php
if(!session_id()) session_start();

if(!isset($_SESSION["csrf_token"])) $_SESSION["csrf_token"] = base64_encode(openssl_random_pseudo_bytes(32));

 require_once "../app/init.php";

 $app = new App();