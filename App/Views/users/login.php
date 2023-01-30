
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestion-planning</title>
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>

	<div class="LoginForm">

		<div class="LoginForm-Wrapper">

			<div class="LoginForm-RightSide">

				<div class="LoginForm-Header">

					<div class="LoginForm-IconWrap">
						<img src="/images/LoginFormIcon.PNG" alt="Login Form Icon" width="128" height="128">
						<h2>Authentification</h2>
					</div>
				</div>

				<div class="LoginForm-Content">
					
					<form class="form" action="/login-controller/login" method="POST">

						<div class="FormLogin-FormGroup">
							<input type="email" placeholder="Email" id="user_email" name="user_email">
							<?php
							if (isset($_GET["empty_email"])) {
								echo "Veuillez entrer votre email";
							}
							?>
						</div>
						<div class="FormLogin-FormGroup">
							<input type="password" placeholder="Password"  id="password" name="password">
							<?php
							if (isset($_GET["empty_password"])) {
								echo "Veuillez entrer votre password";
							}
							?>
						</div>
						<button type="submit" class="Btn-Submit" name="valider">Login</button>
					</form>
				</div>
				
			</div>

			<div class="LoginForm-LiftSide">
				<div class="LoginForm-Cover">
					<img src="/images/LoginFormImg.PNG" alt="Login Form Img">
				</div>
			</div>

		</div>

	</div>
</body>
</html>


			
