<?php

class Controller
{
  public function view(string $view, array $data = []): void
  {
    require_once "../App/views/" . $view . ".php";
  }

  public function model(string $model_name): object
  {
    require_once "../App/models/" . $model_name . ".php";
    return new $model_name;
  }
}