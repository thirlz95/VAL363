$("#first-choice").change(function() {
  $("#second-choice").load("getArtist.php?choice=" + $("#first-choice").val());
});