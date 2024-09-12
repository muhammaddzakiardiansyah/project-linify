<?php

class Mahasiswa extends Controller
{
  public function index(): void
  {
    $data["page"] = "Mahasiswa";
    $data["mahasiswa"] = $this->model("Mahasiswa_model")->getMahasiswa();

    $this->view("components/view_header", $data);
    $this->view("mahasiswa/view_index", $data);
    $this->view("components/view_footer");
  }

  public function detail(string $id): void
  {
    $data["page"] = "Detail mahasiswa";
    $data["mahasiswa"] = $this->model("Mahasiswa_model")->getDetailMahasiswaById($id);

    $this->view("components/view_header", $data);
    $this->view("mahasiswa/view_detail", $data);
    $this->view("components/view_footer");
  }

  public function tambah()
  {
    if($this->model("Mahasiswa_model")->tambahData($_POST) > 0) {
      Flasher::setFlash("Berhasil", "ditambahkan");
      header("Location: " . base_url("mahasiswa"));
      exit;
    } else {
      Flasher::setFlash("Gagal", "ditambahkan", "danger");
      header("Location: " . base_url("mahasiswa"));
      exit;
    }
  }

  public function getUbah(): void
  {
    echo json_encode($this->model("Mahasiswa_model")->getDetailMahasiswaById($_POST["id"]));
  }

  public function ubah(): void
  {
    if($this->model("Mahasiswa_model")->ubahData($_POST) > 0) {
      Flasher::setFlash("Berhasil", "diubah");
      header("Location: " . base_url("mahasiswa"));
      exit;
    } else {
      Flasher::setFlash("Gagal", "diubah", "danger");
      header("Location: " . base_url("mahasiswa"));
      exit;
    }
  }
}