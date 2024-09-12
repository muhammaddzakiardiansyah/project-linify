<?php

class Mahasiswa_model
{

  private string $table = "mahasiswa";
  private $db;

  public function __construct()
  {
    $this->db = new Connection;
  }

  public function getMahasiswa(): array
  {
    $this->db->query("SELECT * FROM $this->table");
    return $this->db->resultSet();
  }

  public function getDetailMahasiswaById($id): array
  {
    $this->db->query("SELECT * FROM $this->table WHERE id = :id");
    $this->db->bind("id", $id);

    return $this->db->single();
  }

  public function tambahData($data): int
  {
    $name = $data["name"];
    $age = $data["age"];
    $nim = $data["nim"];

    $query = "INSERT INTO $this->table (name, age, nim) VALUES (:name, :age, :nim)";

    $this->db->query($query);
    $this->db->bind("name", $name);
    $this->db->bind("age", $age);
    $this->db->bind("nim", $nim);

    return $this->db->rowCount();
  }

  public function ubahData($data): int
  {
    $name = $data["name"];
    $age = $data["age"];
    $nim = $data["nim"];

    $query = "UPDATE $this->table SET name = :name, age = :age, nim = :nim WHERE id = :id";

    $this->db->query($query);
    $this->db->bind("name", $name);
    $this->db->bind("age", $age);
    $this->db->bind("nim", $nim);
    $this->db->bind("id", $data["id"]);

    return $this->db->rowCount();
  }
}