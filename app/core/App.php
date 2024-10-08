<?php

class App
{
  protected $controller = "home", 
            $method = "index", 
            $params = [];

  public function __construct()
  {
    $url = $this->parseUrl() ?? [$this->controller, $this->method];

    // controller
    if(file_exists('../App/controllers/' . $url[0] . '.php')) {
      $this->controller = $url[0];
      unset($url[0]);
    }

    require_once "../App/controllers/" . $this->controller . ".php";
    $this->controller = new $this->controller;

    // method
    if(isset($url[1])) {
      if(method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    if(!empty($url)) {
      $this->params = array_values($url);
    }

    // jalankan controller dan method serta kirimkan params
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseUrl()
  {
    if(isset($_GET["url"])) {
      $url = rtrim($_GET["url"], "/");
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode("/", $url);
      
      $db = new Connection();
      $db->query("SELECT * FROM urls WHERE short_url = :short_url");
      $db->bind("short_url", $url[0]);
      $result = $db->single();
      if($result) {
        redirect($result["original_url"]);
      } else {
        return $url;
      }
    }
  }
}