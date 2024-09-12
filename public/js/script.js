$(function () {
  $(".modalCreate").on("click", function () {
    $(".modal-title").html("Add new url");
    $(".modal-footer button[type=submit]").html("Add");
    $(".modal-body form").attr(
      "action",
      "http://localhost/linify/public/myurls/add"
    );
    $("#original_url").val("");
    $("#short_url").val("");
    $("label").remove(".error");
  });

  $(".modalEdit").on("click", function () {
    $(".modal-title").html("Edit Url");
    $(".modal-footer button[type=submit]").html("Save change");
    $("label").remove(".error");
    $("#original_url").css("color", "#232527");
        $("#short_url").css("color", "#232527");
    $(".modal-body form").attr(
      "action",
      "http://localhost/linify/public/myurls/edit"
    );

    const id = $(this).data("id");

    $.ajax({
      url: "http://localhost/linify/public/myurls/detail",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#original_url").val(data.original_url);
        $("#short_url").val(data.short_url);
      },
    });
  });
});
