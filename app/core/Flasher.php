<?php

/**
 * This class used for send message while something action
 */

class Flasher
{
  public static function setFlash(string $title, string $text, string $icon, bool $redirect = false, string $url = "", int $timerTimeout = 2500): void
  {
    $_SESSION["flasher"] = [
      "title" => $title,
      "text" => $text,
      "icon" => $icon,
      "redirect" => $redirect,
      "url" => $url,
      "timerTimeout" => $timerTimeout,
    ];
  }

  public static function flash(): void
  {
    if (isset($_SESSION["flasher"])) {
      echo '<script>Swal.fire({
              title: "' . $_SESSION["flasher"]["title"] . '",
              text: "' . $_SESSION["flasher"]["text"] . '",
              icon: "' . $_SESSION["flasher"]["icon"] . '",
              showConfirmButton: false,
              timer: 2500,
            })</script>';
      if($_SESSION["flasher"]["redirect"]) {
        echo '<script>setTimeout(() => {
              document.location.href = "' . base_url($_SESSION["flasher"]["url"]) . '"
            }, ' . $_SESSION["flasher"]["timerTimeout"] . ')</script>';
      }
      unset($_SESSION["flasher"]);
    }
  }
}
