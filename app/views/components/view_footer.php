<script>
  function logout() {
    Swal.fire({
      title: "Are you sure?",
      text: "Logout and remove all cookies",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Log Out!"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "http://localhost/linify/public/auth/logout",
          method: "post",
          success: (data) => {
            document.location.reload()
          }
        });
      }
    });
  }
</script>
<script src="<?= base_url("js/bootstrap.bundle.min.js") ?>"></script>
<script src="<?= base_url("js/script.js") ?>"></script>
</body>

</html>