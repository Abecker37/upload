<?php 


if(isset($_POST['submit'])) {
	$upload_dir = "images/"; // dossier de destination
	$allowed_ext = array("jpg", "jpeg", "png", "gif","webp"); // extensions autorisées
	$max_size = 1048576; // poids maximum (en octets)

	$file_name = $_FILES['fileUpload']['name'];
	$file_size = $_FILES['fileUpload']['size'];
	$file_tmp = $_FILES['fileUpload']['tmp_name'];
	$file_type = $_FILES['fileUpload']['type'];
	$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

	// Vérification de l'extension
	if(!in_array($file_ext, $allowed_ext)) {
		die("Erreur : Seules les extensions JPG, JPEG, PNG, GIF et Webp sont autorisées.");
	}

	// Vérification du poids
	if($file_size > $max_size) {
		die("Erreur : La taille de l'image ne doit pas dépasser 1 Mo.");
	}

	// Génération d'un nom unique pour l'image
	$new_file_name = uniqid().'.'.$file_ext;

	// Déplacement du fichier
	if(move_uploaded_file($file_tmp, $upload_dir.$new_file_name)) {
		echo "Image téléchargée avec succès.<br>";
		// Affichage de l'image
		
		// Affichage du nom, prénom et âge
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$age = $_POST['age'];
        echo '<div class="card">';
        echo '<article>';
        echo '<img src="'.$upload_dir.$new_file_name.'" alt="Image uploadée"><br>';
		echo "<p>Nom : ".$nom."</p> <br>";
		echo "<p>Prénom : ".$prenom."</p> <br>";
		echo "<p>Âge : ".$age."</p> <br>";
        echo "</article>";
	} else {
		die("Une erreur est survenue lors du téléchargement de l'image.");
	}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form action="" method="post" enctype="multipart/form-data">
		<label for="fileUpload">Choisir une image :</label>
		<input type="file" name="fileUpload" id="fileUpload" accept=".jpg,.jpeg,.png,.gif">
		<br><br>
		<label for="nom">Nom :</label>
		<input type="text" name="nom" id="nom">
		<br><br>
		<label for="prenom">Prénom :</label>
		<input type="text" name="prenom" id="prenom">
		<br><br>
		<label for="age">Âge :</label>
		<input type="number" name="age" id="age" min="0">
		<br><br>
		<input type="submit" name="submit" value="Envoyer">
	</form>
    
</body>
</html>