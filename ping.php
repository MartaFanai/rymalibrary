<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>
<body>
<input type="text" id="check" value="0">
<?php
  $page = file_get_contents('https://www.google.com');
  if($page)
  {
    echo "internet";

  }
  else
  {
    echo "no internet";
  }
?>
  <!-- <img id="image" src="https://images.pexels.com/photos/60597/dahlia-red-blossom-bloom-60597.jpeg?cs=srgb&dl=pexels-pixabay-60597.jpg&fm=jpg" style="display: block;"> -->
</body>

  <script type="text/javascript">
  const img = document.getElementById("image");
  const txt = document.getElementById("check");

  img.addEventListener("load", function() {
    txt.value = 1;
  });
  </script>
</html>

