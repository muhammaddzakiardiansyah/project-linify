<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Linifiy • <?= $data["page"]; ?></title>
  <link rel="shortcut icon" href="<?= base_url("images/link-45deg.svg") ?>" type="image/x-icon">
  <link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?= base_url("css/custom.css") ?>">
  <script src="<?= base_url("js/sweetalert2.all.min.js") ?>"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="<?= base_url("js/jquery.min.js") ?>"></script>
  <script src="<?= base_url("js/jquery.validate.min.js") ?>"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-blue">
    <div class="container">
      <a class="navbar-brand text-white semibold" href="<?= base_url() ?>">
        Linify
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-white regular" href="<?= base_url("myurls") ?>">My Urls</a>
          </li>
          <li class="nav-item">
            <?php if(isset($_SESSION["userLogin"])) : ?>
              <a class="btn btn-dark text-white regular" onclick="logout()" href="#">
                Log Out
              </a>
            <?php else : ?>
              <a class="btn btn-dark text-white regular" href="<?= base_url("auth/signin") ?>">
                Sign in
              </a>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>