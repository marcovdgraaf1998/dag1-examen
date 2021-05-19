<?php
	include './includes/config.php';

	$query = mysqli_query($mysqli, "SELECT * FROM blokken");
?>

<!DOCTYPE html>
<html lang="en">
	<?php 
		include './includes/header.php';
	?>
	<title>Inschrijven</title>
<body>
	<div class="container">
	<div class="text-center my-5">
		<h1>Inschrijven</h1>
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
					<th>Actie</th>
				</tr>
					<?php while ($row = mysqli_fetch_array($query)) : ?>
					<tr>
						<td><?= $row['blok_id'] ?></td>
						<td><?= $row['datum'] ?></td>
						<td><?= $row['start_tijd'] ?></td>
						<td><?= $row['eind_tijd'] ?></td>
						<td><?php if($row['plekken'] < 1) { echo 'vol';} else {echo $row['plekken'];} ?></td>
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
</body>
</html>