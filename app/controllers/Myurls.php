<?php

class Myurls extends Controller
{
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
    if ($result) {
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
    if (!empty($_POST)) {
      if ($_POST["csrf_token"] != $_SESSION["csrf_token"]) {
        setCsrfToken();
        Flasher::setFlash("Failed", "CSRF token incorret!", "error");
        redirect(base_url("myurls"));
      } else {
        setCsrfToken();
        $originalUrl = $_POST["original_url"] ?? "empty";
        $shortUrl = $_POST["short_url"] ?? "empty";
        $userId = $_SESSION["user_id"] ?? 0;

        $dataUrl = [
          "original_url" => htmlspecialchars($originalUrl),
          "short_url" => htmlspecialchars($shortUrl),
          "user_id" => $userId,
        ];
        $result = $this->model("Urls_model")->add($dataUrl);
        if ($result === 201) {
          Flasher::setFlash("Success", "Success create new url!", "success");
          redirect(base_url("myurls"));
        } elseif ($result === 200) {
          Flasher::setFlash("Failed", "Short Url alredy!", "error");
          redirect(base_url("myurls"));
        } else {
          Flasher::setFlash("Failed", "Failed create new url!", "error");
          redirect(base_url("myurls"));
        }
      }
    }
  }

  public function edit()
  {
    if (!empty($_POST)) {
      if ($_POST["csrf_token"] != $_SESSION["csrf_token"]) {
        setCsrfToken();
        Flasher::setFlash("Failed", "CSRF token incorret!", "error");
        redirect(base_url("myurls"));
      } else {
        setCsrfToken();
        $dataUrl = [
          "id" => $_POST["id"] ?? 0,
          "original_url" => htmlspecialchars($_POST["original_url"]) ?? "empty",
          "short_url" => htmlspecialchars($_POST["short_url"]) ?? "empty",
        ];
        $result = $this->model("Urls_model")->edit($dataUrl);
        if ($result === 200) {
          Flasher::setFlash("Success", "Success edit url!", "success");
          echo "1";
          redirect(base_url("myurls"));
        } elseif ($result === 401) {
          Flasher::setFlash("Failed", "Short url is alredy", "error");
          echo "11";
          redirect(base_url("myurls"));
        } elseif ($result === 400) {
          Flasher::setFlash("Failed", "Failed edit url!", "error");
          echo "111";
          redirect(base_url("myurls"));
        }
      }
    }
  }

  public function remove()
  {
    $id = $_POST["id"];
    $result = $this->model("Urls_model")->remove($id);
    if ($result) {
      echo json_encode($result);
    } else {
      echo 0;
    }
  }
}
