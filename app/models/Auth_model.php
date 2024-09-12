<?php

class Auth_model
{
  private string $table = "users";
  private object $db;

  public function __construct()
  {
    $this->db = new Connection();
  }

  public function signin($dataSignin)
  {
    $this->db->query("SELECT * FROM $this->table WHERE username = :username");
    $this->db->bind("username", $dataSignin["username"]);
    $result = $this->db->single();

    if($result) {
      $verifyPassword = password_verify($dataSignin["password"], $result["password"]);
      if($verifyPassword) {
        $_SESSION["userLogin"] = [
          "username" => $result["username"],
          "user_id" => $result["id"],
        ];
        setcookie("key1", base64_encode($result["id"]), time() + 604800, "/");
        setcookie("key2", base64_encode($result["username"]), time() + 604800, "/");
        return 200;
      } else {
        return 400;
      }
    } else {
      return 404;
    }
  }

  public function signup($dataSignup)
  {
    $this->db->query("SELECT * FROM $this->table WHERE username = :username");
    $this->db->bind("username", $dataSignup["username"]);
    $resultGet = $this->db->single();

    if($resultGet) {
      return 403;
    } else {
      $this->db->query("INSERT INTO $this->table (id, username, password) VALUES (:id, :username, :password)");
      $this->db->bind("id", rand(1000000, 10000000));
      $this->db->bind("username", htmlspecialchars($dataSignup["username"]));
      $this->db->bind("password", password_hash($dataSignup["password"], PASSWORD_ARGON2I));

      return $this->db->rowCount();
    }
  }


}