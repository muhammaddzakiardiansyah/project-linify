<?php

class Authenticate {
  private string $table = "users";
  private object $db;

  public function __construct()
  {
    $this->db = new Connection();  
  }

  public function checkCookies(): void
  {
    if(!isset($_COOKIE["key1"]) || !isset($_COOKIE["key2"])) {
      redirect(base_url("auth/signin"));
    } else {
      $key1 = base64_decode($_COOKIE["key1"] ?? "");
      $key2 = base64_decode($_COOKIE["key2"] ?? "");
      $this->db->query("SELECT * FROM $this->table WHERE id = :id");
      $this->db->bind("id", $key1);
      $result = $this->db->single();
      if($result) {
        if($result["username"] == $key2) {
          $_SESSION["userLogin"] = [
            "username" => $result["username"],
            "user_id" => $result["id"],
          ];
        } else {
          redirect(base_url("auth/signin"));
        }
      }
    }
  }

  public function checkLogin(): void
  {
    if(!isset($_SESSION["userLogin"])) {
      redirect(base_url("auth/signin"));
    }
  }
}