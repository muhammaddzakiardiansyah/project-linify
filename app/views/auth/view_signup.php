<?php
Flasher::flash();
?>

<div class="container mt-4 w-screen mt-3 mb-3 d-flex align-items-center">
  <div class="row w-screen mx-auto">
    <div class="col-lg-4 mx-auto card">
      <h3 class="mb-3 semibold text-black">Sign Up</h3>
      <form class="mt-3" id="signup" action="<?= base_url("auth/signup") ?>" method="post">
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
        <div class="mb-3">
          <label for="passwordConfirm" class="regular mb-2 text-black">Password Confirm</label>
          <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control">
          <div class="show-pass mt-3">
            <input class="form-check-input" type="checkbox" id="check-confrim-pass">
            <label for="check-confrim-pass" class="text-black regular">See Password</label>
          </div>
        </div>
        <div class="mt-5 mb-4">
          <button type="submit" class="btn btn-dark w-screen">Sign Up</button>
        </div>
        <p class="text-black regular text-center">Have account? <a href="<?= base_url("auth/signin") ?>" class="text-blue text-decoration-none">Sign In</a></p>
      </form>
    </div>
  </div>
</div>

<script>

  // see password
  const toggle1 = document.getElementById("check-pass");
  const inputPass = document.getElementById("password");
  toggle1.addEventListener("change", () => {
    const type = inputPass.getAttribute("type") === "password" ? "text" : "password"
    inputPass.setAttribute("type", type);
  })

  const toggle2 = document.getElementById("check-confrim-pass");
  const inputConfirmPass = document.getElementById("passwordConfirm");
  toggle2.addEventListener("change", () => {
    const type = inputConfirmPass.getAttribute("type") === "password" ? "text" : "password"
    inputConfirmPass.setAttribute("type", type);
  })


  
  // validate signin
  $().ready(() => {
    $("#signup").validate({
      rules: {
        username: {
          required: true,
        },
        password: {
          required: true,
          minlength: 8,
        },
        passwordConfirm: {
          required: true,
          minlength: 8,
        }
      }
    })
  })
</script>