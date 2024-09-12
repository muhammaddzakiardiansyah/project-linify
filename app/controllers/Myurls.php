<?php

class Myurls extends Controller {
  public function index(): void
  {
    $authenticate = new Authenticate();
    $authenticate->checkCookies();
    $authenticate->checkLogin();

    $data["page"] = "My Urls";
    $data["urls"] = $this->model("Urls_model")->getAllUrls();

    $this->view("components/view_header", $data);
    $this->view("myurls/view_index", $data);
    $this->view("components/view_footer");
  }

  public function detail()
  {
    $id = $_POST["id"];
    $result = $this->model("Urls_model")->detail($id);
    if($result) {
      echo json_encode($result);
    } else {
      echo [
        "original_url" => "not found",
        "short_url" => "not found",
      ];
    }
  }

  public function add()
  {
    if(!empty($_POST)) {
      if($_POST["csrf_token"] != $_SESSION["csrf_token"]) {
        setCsrfToken();
        Flasher::setFlash("Failed", "CSRF token incorret!", "error");
        redirect(base_url("myurls"));
      } else {
        setCsrfToken();
        $originalUrl = $_POST["original_url"];
        $shortUrl = $_POST["short_url"];
        $userId = $_SESSION["user_id"] ?? 0;
  
        $dataUrl = [
          "original_url" => $originalUrl,
          "short_url" => $shortUrl,
          "user_id" => $userId,
        ];
  
        if($this->model("Urls_model")->add($dataUrl) === 201) {
          echo "benar";
          Flasher::setFlash("Success", "Success create new url!", "success");
          redirect(base_url("myurls"));
        } else {
          echo "salah";
          Flasher::setFlash("Failed", "Failed create new url!", "error");
          redirect(base_url("myurls"));
        }
      }
    }
  }

  public function remove()
  {
    $id = $_POST["id"];
    $result = $this->model("Urls_model")->remove($id);
    if($result) {
      echo json_encode($result);
    } else {
      echo 0;
    }
  }
}