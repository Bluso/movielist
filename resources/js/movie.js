if ($('#page-movie').length > 0) {
  $("button#edit-btn").click(function() {
      alert($(this).data("id"));
  });
  $("button#delete-btn").click(function() {
      alert($(this).data("id"));
  });
}
