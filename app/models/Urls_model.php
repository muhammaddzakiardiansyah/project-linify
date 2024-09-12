<?php


class Urls_model {
  private string $table = "urls";
  private object $db;

  public function __construct()
  {
    $this->db = new Connection();
  }

  public function getAllUrls()
  {
    $user_id = $_SESSION["userLogin"]["user_id"] ?? 0;

    $this->db->query("SELECT * FROM urls WHERE user_id = :id");
    $this->db->bind("id", $user_id);

    return $this->db->resultAll();
  }

  public function detail($id)
  {
    $this->db->query("SELECT * FROM $this->table WHERE id = :id");
    $this->db->bind("id", $id);

    return $this->db->single();
  }

  public function add($dataUrl): int
  {
    $user_id = $_SESSION["userLogin"]["user_id"] ?? 0;

    $this->db->query("INSERT INTO $this->table (id, original_url, short_url, user_id) VALUES (:id, :original_url, :short_url, :user_id)");
    $this->db->bind("id", rand(1000000, 10000000));
    $this->db->bind("original_url", $dataUrl["original_url"]);
    $this->db->bind("short_url", $dataUrl["short_url"]);
    $this->db->bind("user_id", $user_id);

    if($this->db->rowCount()) {
      return 201;
    } else {
      return 400;
    }
  }

  public function remove($id)
  {
    $this->db->query("SELECT * FROM $this->table WHERE id = :id");
    $this->db->bind("id", $id);

    if($this->db->single()) {
      $this->db->query("DELETE FROM $this->table WHERE id = :id");
      $this->db->bind("id", $id);

      return $this->db->rowCount();
    } else {
      return 0;
    }
  }
}