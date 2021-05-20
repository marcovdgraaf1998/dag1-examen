<?php
	# Login check notificatie
	if (isset($_GET['login'])) {
		$loginCheck = $_GET['login'];

		if ($loginCheck == 'empty') {
			echo '<div class="alert alert-danger text-center" role="alert">Niet alle velden zijn ingevuld!</div>';
		} else if ($loginCheck == 'failed') {
            echo '<div class="alert alert-danger text-center" role="alert">Onjuiste inloggegevens!</div>';
        }
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/header.php'; ?>
	<title>Login admin</title>
</head>
<body>
	<div class="container">
		<div class="card mt-4 p-3">
			<h1 class="text-center">Login admin</h1>
			<form method="POST" action="./login.php">
				<div class="row mb-4">
					<div class="col-12">
						<label for="gebruikersnaam">Gebruikersnaam</label>
						<input type="text" class="form-control" id="gebruikersnaam" name="gebruikersnaam">
						<div class="form-group mt-3">
							<label for="wachtwoord">Wachtwoord</label>
							<input type="password" class="form-control" id="wachtwoord" name="wachtwoord">
						</div>
					</div>
				</div>
				<input type="submit" class="btn btn-primary float-right"id="submit" name="submit" value="Inloggen">
			</form>
		</div>
	</div>
</body>
</html>