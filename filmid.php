<?php
	require_once "../config.php";
	//tegeleme filmi formiga
	if(isset($_POST["film_submit"])){
		if(isset($_POST["title_input"]) and !empty($_POST["title_input"])){
			$title = $_POST["title_input"];
		} else {
			$title_error = "Pealkiri jäi lisamata!";
		}
		$year = $_POST["year_input"];
		$duration = $_POST["duration_input"];
		if(isset($_POST["genre_input"]) and !empty($_POST["genre_input"])){
			$genre = $_POST["genre_input"];
		} else {
			$genre_error = "Žanr jäi lisamata!";
		}
		if(isset($_POST["studio_input"]) and !empty($_POST["studio_input"])){
			$studio = $_POST["studio_input"];
		} else {
			$studio_error = "Tootja jäi lisamata!";
		}
		if(isset($_POST["director_input"]) and !empty($_POST["direcotr_input"])){
			$director = $_POST["director_input"];
		} else {
			$director_error = "Režissöör jäi lisamata!";
		}
		
		
		if(empty($title_error)){
			//loome andmebaasiühenduse
			$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
			//määrame suhtlemisel kasutatava kooditabeli
			$conn->set_charset("utf8");
			//valmistame ette SQL keeles päringu
			$stmt = $conn->prepare("INSERT INTO veebilehe_filmid (title, year, duration, genre, studio, director) VALUES(?,?,?,?,?,?)");
			echo $conn->error;
			//seome SQL päringu päris andmetega
			//määrata andmetüübid: i - integer (täisarv), d - decimal(murdarv), s- string(tekst)
			$stmt->bind_param("siisss", $title, $year, $duration, $genre, $studio, $director);
			if($stmt->execute()){
				$year = 2000;
				$duration = 130;
			}
			echo $stmt->error;
			//sulgeme käsu/päringu
			$stmt->close();
			//sulgeme andmebaasiühenduse
			$conn->close();
		}
	}







?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Krissu veebiproge</title>
</head>
<body>
	<img src="https://greeny.cs.tlu.ee/~rinde/vp_2022/vp_banner_gs.png" alt="Veebiprogrammeerimine 2022 bänner">
	<h1>Kristjani veebileht</h1>
	<p>Leht loodud õppetöö raames :)</p>
	<p>Õppetöö toimus <a href="https://www.tlu.ee/">Tallinna Ülikoolis</a>.</p>
	<p>Minu nimi on Kristjan Peedisson ja olen Tallinna Ülikooli <a HREF="https://www.tlu.ee/dt/informaatika">Informaatika</a> digidisaini suuna 1. õppeaasta õpilane.</p>
<form method="POST">
        <label for="title_input">Filmi pealkiri</label>
        <input type="text" name="title_input" id="title_input" placeholder="filmi pealkiri">
        <br>
        <label for="year_input">Valmimisaasta</label>
        <input type="number" name="year_input" id="year_input" min="1912">
        <br>
        <label for="duration_input">Kestus</label>
        <input type="number" name="duration_input" id="duration_input" min="1" value="60" max="600">
        <br>
        <label for="genre_input">Filmi žanr</label>
        <input type="text" name="genre_input" id="genre_input" placeholder="žanr">
        <br>
        <label for="studio_input">Filmi tootja</label>
        <input type="text" name="studio_input" id="studio_input" placeholder="filmi tootja">
        <br>
        <label for="director_input">Filmi režissöör</label>
        <input type="text" name="director_input" id="director_input" placeholder="filmi režissöör">
        <br>
        <input type="submit" name="film_submit" value="Salvesta">
    </form>


</body>
</html>