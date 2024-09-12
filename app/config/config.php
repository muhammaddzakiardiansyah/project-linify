<?php

function base_url(string $url = ""): string
{
  return "http://localhost/linify/public/" . $url;
}

function redirect(string $path): void 
{
  header("Location: $path");
}

function setCsrfToken(): void
{
  unset($_SESSION["csrf_token"]);
  $_SESSION["csrf_token"] = base64_encode(openssl_random_pseudo_bytes(32));
}

const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_NAME = "linify";