<html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Prodaja koristenih knjiga</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="#">Naslovna</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Unos knjige</h1>
				<form action="knjige.php" method="post">
					<div class="form-group">
						<label for="ime-knjige">Ime knjige:</label>
						<input type="text" id="ime-knjige" class="form-control" name="ime_knjige">
					</div>

					<div class="form-group">
						<label for="sifra">Sifra:</label>
						<input type="text" id="sifra" class="form-control" name="sifra">
					</div>

					<div class="form-group">
						<label for="izdavac">Izdavac:</label>
						<input type="text" id="izdavac" class="form-control" name="izdavac">
					</div>

					<div class="form-group">
						<label for="izdavac">Sadrzaj:</label>
						<textarea id="izdavac" class="form-control" rows="6" name="sadrzaj"></textarea>
					</div>

					<div class="form-group">
						<label for="godina-izdavanja">Godina izdavanja:</label>
						<input type="text" id="godina-izdavanja" class="form-control" name="godina_izdavanja">
					</div>

					<div class="form-group">
						<label for="jezik">Jezik:</label>
						<input type="text" id="jezik" class="form-control" name="jezik">
					</div>

					<div class="form-group">
						<label for="zemlja-porijekla">Zemlja porijekla:</label>
						<input type="text" id="zemlja-porijekla" class="form-control" name="zemlja_porijekla">
					</div>
					<?php
						// da bi dobili podatke iz baze, potrebno je konektovati se na bazu podataka
						// za konekciju na bazu podataka, potrebni su nam pristupni podaci

						$hostname = "localhost";
						$username = "root";
						$password = "";
						$dbname = "prodaja_knjiga";

						// napravi konekciju s bazom podataka
						$conn = mysqli_connect($hostname, $username, $password, $dbname);

						// provjeri da li je uspjesna konekcija s bazom podataka
						if (!$conn) {
							die("Konekcija s bazom podataka nije uspjela: " . mysqli_connect_error());
						}
					?>
					<div class="form-group">
						<label for="vlasnik_id">Vlasnik:</label>
						<select name="vlasnik_id" class="form-control" id="vlasnik">
							<?php
							$sql = "SELECT * FROM vlasnici"; // izvadi iz tabele vlasnici sve podatke i prikazi ih
							$result = mysqli_query($conn, $sql);

							if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) : ?>
							<option value="<?= $row["id"] ?>"><?= $row["ime"] . " " . $row["prezime"] ?></option>
							<?php endwhile; } ?>
						</select>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Unesi</button>
					</div>
				</form>

				<table class="table">
					<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Ime</th>
						<th scope="col">Sifra</th>
						<th scope="col">Izdavac</th>
						<th scope="col">Godina izdavanja</th>
						<th scope="col">Jezik</th>
						<th scope="col">Zemlja porijekla</th>
						<th scope="col">Vlasnik</th>
					</tr>
					</thead>
					<tbody>
				<?php
					// spajanje tabela knjige i vlasnici po id-u
					$sql = "SELECT * FROM knjige LEFT JOIN vlasnici ON vlasnici.id = knjige.vlasnik_id";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)) : ?>

						<tr>
							<th scope="row"><?= $row['id'] ?></th>
							<td><?= $row['ime_knjige'] ?></td>
							<td><?= $row['sifra'] ?></td>
							<td><?= $row['izdavac'] ?></td>
							<td><?= $row['godina_izdavanja'] ?></td>
							<td><?= $row['jezik'] ?></td>
							<td><?= $row['zemlja_porijekla'] ?></td>
							<td><?= $row['ime'] . " " . $row['prezime'] ?></td>
						</tr>
				<?php

				 endwhile;
					} else {
						echo "0 results";
					}

					mysqli_close($conn);

				?>


					</tbody>
				</table>
			</div>
		</div>
	</div>




	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>