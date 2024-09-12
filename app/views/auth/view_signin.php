<?php
Flasher::flash();
?>

<div class="container w-screen h-screen d-flex align-items-center">
  <div class="row w-screen mx-auto">
    <div class="col-lg-4 mx-auto card">
      <h3 class="mb-3 semibold text-black">Sign In</h3>
      <form class="mt-3" id="signin" action="<?= base_url("auth/signin") ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
        <div class="mb-3">
          <label for="username" class="regular mb-2 text-black">Username</label>
          <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="mb-3">
          <label for="password" class="regular mb-2 text-black">Password</label>
          <input type="password" name="password" id="password" class="form-control">
          <div class="show-pass mt-3">
            <input class="form-check-input" type="checkbox" id="check-pass">
            <label for="check-pass" class="text-black regular">See Password</label>
          </div>
        </div>
        <div class="mt-5 mb-4">
          <button type="submit" class="btn btn-dark w-screen">Sign In</button>
        </div>
        <p class="text-black regular text-center">Don't have account? <a href="<?= base_url("auth/signup") ?>" class="text-blue text-decoration-none">Sign Up</a></p>
      </form>
    </div>
  </div>
</div>

<script>
  // see password
  const toggle = document.getElementById("check-pass");
  const inputPass = document.getElementById("password");
  toggle.addEventListener("change", () => {
    const type = inputPass.getAttribute("type") === "password" ? "text" : "password"
    inputPass.setAttribute("type", type);
  })

  // validate signin
  $().ready(() => {
    $("#signin").validate({
      rules: {
        username: {
          required: true,
        },
        password: {
          required: true,
          minlength: 8,
        }
      }
    })
  })
</script>