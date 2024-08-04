<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="res/css/bootstrap.min.css">
	<script src="res/js/jquery.min.js"></script>
	<title>RYMA Library Online</title>
</head>
<body>
	<div class="container" style="max-width: 100%;">
		<div class="text-center mt-5 mb-4">
			<h1>RYMA Online Library</h1>
			
			<h2>LEHKHABU ZAWNNA</h2>
		</div>

		<div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="input-group">
                    <input type="text" class="form-control col-4" id="live-search" autocomplete="off" placeholder="Lehkhabu Hming emaw a ziaktu chhulut rawh.." autofocus="true">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4"></div>
        </div><!-- /.row -->
		
	</div>

	<div id="searchresult" style="padding: 10px;"></div>
	<br>
	<div style="text-align: center; padding : 10px;">He page hi RYMA Library a lehkhabu awm te online a en theihna a ni a, hriatchian duh i nei a nih chuan a hnuai a contact no tarlanah hian a zawhfiah theih e.<br>Contact : 9856736646/9876456373</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#live-search').keyup(function(){
				var input = $(this).val();

				if(input != ""){
					$.ajax({
						url:"livesearch.php",
						method:"POST",
						data:{input:input},

						success:function(data){
							$("#searchresult").html(data);
							$("#searchresult").css("display", "block");
						}
					});
				}else{
					$("#searchresult").css("display", "none");
				}
			});
		});
	</script>

</body>
</html>