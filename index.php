<?php
include("init.php");
?>
<html>
	<head>
		<link rel="icon" type="image/png" sizes="192x192"  href="images/icon.png">	
		<title>Library</title>
		<meta name="viewport" content="width=device-width, initial-scale=0.7 user-scalable=0">
		<script src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="styles/style.css" type="text/css" />
		<link rel="stylesheet" href="fontawesome/css/all.css"> <!-- Font awesome css -->	
		<script type="text/javascript" >
			$(document).ready(function()
			{
				$('#LoginForm').on('submit', function(e) {
					e.preventDefault();
					$("#animation").show();
					$("#feedback").hide();
					$.ajax({
						url : $(this).attr('action') || window.location.pathname,
						type: "POST",
						data: $(this).serialize(),
						success: function (data) {
							$("#animation").hide();
							var obj = $.parseJSON(data);
							var feedback = obj['feedback'];
							var response = obj['response'];
							if(feedback==1){
								$("#feedback").html("<div class='success'><p>"+response+"<a onClick='hide_feedback()' class='cursor'><i class='fas fa-times'></i></a></p></div>");
								$("#feedback").show();
								var timer = setTimeout(function() {
									window.location.href="<?php echo $fns->portal();?>";/**<<when person logs in */
								}, 3000);
							}else{
								$("#feedback").html("<div class='error'><p>"+response+"<a onClick='hide_feedback()' class='cursor'><i class='fas fa-times'></i></a></p></div>");
								$("#feedback").show();
							}
						},
						error: function (jXHR, textStatus, errorThrown) {
							alert(errorThrown);
						}
					});
				});
			});
		</script>
		<script>
			function toggle(div){
				var status = document.getElementById(div).style.display;
				if(status=="none"){
					document.getElementById(div).style.display="block";
				}else{
					document.getElementById(div).style.display="none";
				}
			}
			function hide_feedback(){
				$("#feedback").hide();
			}
			function hide_dialog(){
				$("#dialog").hide();
			}
		</script>
	</head>
	<body>
		<p class="center" style="margin-bottom: 20px;"><img src="styles/assests/logo.png" width="200" /></p>
		<div class="sign-in-form">
			<form id="LoginForm" action="login.php" method="POST" target="_top">
				<h3 style=" margin-bottom:40px;" >AUCB Library</h3>
                <div class="input-group">
					<input class="form-control form-control-lg" name="username" value="" placeholder="Username" type="text"  tabindex="1"></p>
					<span class="input-group-icon"><i class="fa-solid fa-circle-user"></i></span>
				</div>
				<div class="input-group">
					<input  class="form-control form-control-lg"  name="password" placeholder="Password" type="password" tabindex="2"></p>
					<span class="input-group-icon"><i class="fa-solid fa-lock"></i></span>
				</div>
                <p class="center"><input type="submit" value="Login" style="margin-top:30px;"/></p>
			</form>
		</div>
		<div class="feedback-box" style="margin:10px 0px 10px 0px;">
			<div id="animation">
				<div class="spinner"></div>
			</div>
		</div>
		<div id="feedback"></div>
	</body>
</html>