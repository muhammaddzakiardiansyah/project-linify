<?php

class Auth extends Controller
{
  public function signin(): void
  {
    $data["page"] = "Sign In";

    if(isset($_SESSION["userLogin"])) {
      redirect(base_url());
    }

    if (!empty($_POST)) {
      if($_POST["csrf_token"] != $_SESSION["csrf_token"]) {
        setCsrfToken();
        Flasher::setFlash("Failed!", "CSRF token Incorrect!", "error");
      } else {
        setCsrfToken();
        $signin = $this->model("Auth_model")->signin($_POST);
        if ($signin === 200) {
          Flasher::setFlash("Success!", "Authenticate successfully!", "success", true, "myurls");
        } else if ($signin === 400) {
          Flasher::setFlash("Failed!", "Password Incorrect!", "error");
        } else if ($signin === 404) {
          Flasher::setFlash("Failed!", "User Not Found!", "error");
        }
      }
    }

    $this->view("components/view_header", $data);
    $this->view("auth/view_signin");
    $this->view("components/view_footer");
  }

  public function signup(): void
  {
    $data["page"] = "Sign Up";

    if(!empty($_POST)) {
      if($_POST["csrf_token"] != $_SESSION["csrf_token"]) {
        setCsrfToken();
        Flasher::setFlash("Failed!", "CSRF token Incorrect!", "error");
      } else {
        setCsrfToken();
        $password = $_POST["password"];
        $passwordConfirm = $_POST["passwordConfirm"];
        if($password != $passwordConfirm) {
          Flasher::setFlash("Failed!", "Confirm password incorret!", "error");
        } else {
          $signup = $this->model("Auth_model")->signup($_POST);
          if ($signup === 1) {
            Flasher::setFlash("Success!", "Create account successfully!", "success", true, "auth/signin");
          } else if ($signup === 403) {
            Flasher::setFlash("Failed!", "User alredy exists", "error");
          } else if ($signup === 0) {
            Flasher::setFlash("Failed!", "Create account failed!", "error");
          }
        }
      }
    }

    $this->view("components/view_header", $data);
    $this->view("auth/view_signup", $data);
    $this->view("components/view_footer");
  }

  public function logout()
  {
    unset($_SESSION["userLogin"]);
    setcookie("key1", "", time() - 3600, "/");
    setcookie("key2", "", time() - 3600, "/");
    redirect(base_url());
  }
}
