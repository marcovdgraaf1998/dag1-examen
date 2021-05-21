<?php
	include './includes/config.php';

	$query = mysqli_query($mysqli, "SELECT * FROM blokken WHERE zichtbaar = 1");

	if (isset($_GET['signup'])) {
		$signupCheck = $_GET['signup'];
		
		if ($signupCheck == 'verwijderd') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">Uw inschrijving is verwijderd! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		} else if ($signupCheck == 'success') {
			echo '<div class="alert alert-success text-center mb-0 border-0 rounded-0" role="alert">U bent ingeschreven! U heeft een bevestiging via de mail gekregen. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<?php 
		include './includes/head.php';
	?>
	<title>Inschrijven</title>
<body>
	<?php include './includes/header.php'; ?>
	<div class="container">
		<div class="card mt-4 p-4">
			<div class="pb-2 pl-2">
				<h2>Inschrijven</h2>
				<p>Schrijf u hier nu in voor een blok om te schaatsen!</p>
			</div>
			<div class="table-responsive">
				<table class="table" cellspacing="0">
					<tr>
						<th>Blok</th>
						<th>Datum</th>
						<th>Van</th>
						<th>Tot</th>
						<th>Plekken over</th>
						<th></th>
					</tr>
						<?php while ($row = mysqli_fetch_array($query)) : ?>
						<tr>
							<td><?= $row['blok_id'] ?></td>
							<td><?= $row['datum'] ?></td>
							<td><?= $row['start_tijd'] ?></td>
							<td><?= $row['eind_tijd'] ?></td>
							<td><?php if($row['plekken'] < 1) { echo '<p class="text-danger">Vol</p>';} else {echo $row['plekken'];} ?></td>
							<td>
								<form method="POST" action="./inschrijven/index.php">
									<input type="hidden" name="blok_id" id="blok_id" value="<?= $row['blok_id'] ?>">
									<input type="hidden" name="datum" id="datum" value="<?= $row['datum'] ?>">
									<input type="hidden" name="start_tijd" id="start_tijd" value="<?= $row['start_tijd'] ?>">
									<input type="hidden" name="eind_tijd" id="eind_tijd" value="<?= $row['eind_tijd'] ?>">
									<input type="hidden" name="plekken" id="plekken" value="<?= $row['plekken'] ?>">
									<input type="submit" class="btn btn-primary" <?php if($row['plekken'] < 1) echo 'disabled' ?> id="submit" name="submit" value="Inschrijven">
								</form>
							</td>
						</tr>
					<?php endwhile ?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>