<?php
Flasher::flash();
?>
<div class="container mt-5">
  <div class="row mx-auto">
    <div class="col-lg-8 mx-auto">
      <h3 class="mb-4 text-black semibold"><?= isset($_SESSION["userLogin"]) ? '<span class="text-blue">' . $_SESSION["userLogin"]["username"] . '</span>' : '<span class="text-blue">Your</span>' ?> urls</h3>
      <?php if (isset($data["urls"])) : ?>
        <?php foreach ($data["urls"] as $url) : ?>
          <div class="card mb-3">
            <div class="card-body d-flex justify-content-between">
              <a href="<?= $url["short_url"] ?>" class="text-decoration-none text-blue semibold"><?= $url["short_url"] ?></a>
              <div class="button">
                <div class="badge text-blue cursor-pointer" data-short-url="<?= base_url($url["short_url"]) ?>" onclick="copyUrl(this)"><i class="bi bi-link-45deg fs-5"></i></div>
                <div class="badge text-warning cursor-pointer modalEdit" data-bs-toggle="modal" data-bs-target="#Modal" data-id="<?= $url["id"] ?>"><i class="bi bi-pencil fs-5"></i></div>
                <div class="badge text-danger cursor-pointer" data-remove-id="<?= $url["id"] ?>" onclick="remove(this)"><i class="bi bi-trash fs-5"></i></div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <div class="card mb-3">
        <div class="card-body text-center">
          <a href="#" data-bs-toggle="modal" data-bs-target="#Modal" class="text-blue semibold text-decoration-none modalCreate">
            Add new url <i class="bi bi-plus-lg"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-black semibold" id="exampleModalLabel">Add new url</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url("myurls/add") ?>" id="create_url" method="post">
          <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
          <input type="hidden" name="id" id="id">
          <div class="mb-3">
            <label for="original_url" class="regular mb-2 text-black">Original Url</label>
            <input type="text" name="original_url" id="original_url" class="form-control">
          </div>
          <div class="mb-3">
            <label for="short_url" class="regular mb-2 text-black">Short Url</label>
            <input type="text" class="form-control" name="short_url" id="short_url">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-dark">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
  $().ready(() => {

    jQuery.validator.addMethod("noSpace", function(value, element) {
      return value.indexOf(" ") < 0 && value != "";
    }, "No space please and don't leave it empty");

    $("#create_url").validate({
      rules: {
        original_url: {
          required: true,
        },
        short_url: {
          required: true,
          noSpace: true,
        },
      },
    })
  })

  // copy url
  function copyUrl(element) {
    const textToCopy = element.getAttribute("data-short-url");
    let tmpTextarea = document.createElement("textarea");
    tmpTextarea.value = textToCopy;
    document.body.appendChild(tmpTextarea);

    tmpTextarea.select();
    tmpTextarea.setSelectionRange(0, 99999);

    document.execCommand("copy");

    document.body.removeChild(tmpTextarea);

    Swal.fire({
      title: "Copied!",
      text: textToCopy,
      icon: "success",
      showConfirmButton: false,
      timer: 2500,
    });
  }

  function remove(element) {
    const id = element.getAttribute("data-remove-id");

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "http://localhost/linify/public/myurls/remove",
          data: {
            id: id
          },
          method: "post",
          dataType: "json",
          success: (data) => {
            Swal.fire({
              title: "Deleted!",
              text: "Your file has been deleted.",
              icon: "success",
              showConfirmButton: false,
              timer: 2500,
            });
            setTimeout(() => {
              document.location.href = "<?= $_SERVER["REQUEST_URI"] ?>"
            }, 2500);
          }
        });
      }
    });
  }
</script>