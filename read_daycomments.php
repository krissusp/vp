<?php
	require_once "../config.php";
	
	//loome andmebaasiühenduse
	$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
	//määrame suhtlemisel kasutatava kooditabeli
	$conn->set_charset("utf8");
	//valmistame ette SQL keeles päringu
	$stmt = $conn->prepare("SELECT comment, grade, added FROM vp_daycomment_1");
	echo $conn->error;
	//seome loetavad andmed muutujatega
	$stmt->bind_result($comment_from_db, $grade_from_db, $added_from_db);
	//täidame käsu
	$stmt->execute();
	echo $stmt->error;
	//võtan andmeid
	//kui on oodata vaid 1 võimalik kirje
	//if($stmt->fetch(){
		//kõik mida teha
	//}
	$comments_html = null;
	//kui on oodata mitut, aga teadmata arv
	while($stmt->fetch()){
		// <p>Kommentaar, hinne päevale: x, lisatud yyyyyy. </p>
		$comments_html .= "<p>" ."Kommentaar: " .$comment_from_db ." | Hinne päevale: " .$grade_from_db ." | lisatud: " .$added_from_db .".</p> \n";
		
	}
	//sulgeme käsu/päringu
		$stmt->close();
		//sulgeme andmebaasiühenduse
		$conn->close();
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
	<?php echo $comments_html ?>
</body>
</html>