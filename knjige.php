<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prodaja_knjiga";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$ime_knjige = $_POST['ime_knjige'];
$sifra = $_POST['sifra'];
$izdavac = $_POST['izdavac'];
$sadrzaj = $_POST['sadrzaj'];
$godina_izdavanja = $_POST['godina_izdavanja'];
$jezik = $_POST['jezik'];
$zemlja_porijekla = $_POST['zemlja_porijekla'];
$vlasnik_id = $_POST['vlasnik_id'];

$sql = "INSERT INTO knjige (ime_knjige, sifra, izdavac, sadrzaj, godina_izdavanja, jezik, zemlja_porijekla, vlasnik_id)
VALUES ('" . $ime_knjige . "', '" . $sifra . "', '" . $izdavac . "',  '" . $sadrzaj . "',  '" . $godina_izdavanja . "',  '" . $jezik . "',  '" . $zemlja_porijekla . "',  '" . $vlasnik_id . "')";

if (mysqli_query($conn, $sql)) { // ako prodje uspjesno unos knjige
	header("Location: http://localhost:3000"); // uradi redirekciju na pocetnu stranicu
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);