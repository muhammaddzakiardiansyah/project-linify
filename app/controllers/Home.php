<?php

class Home extends Controller
{
  public function index(): void
  {
    $data["page"] = "Home";

    $this->view("components/view_header", $data);
    $this->view("home/view_index");
    $this->view("components/view_footer");
  }
}