<?php
	require'connexion.php';
	if (!empty($_FILES)) {
  $file_name = $_FILES['fichier']['name'];
  $file_extension = strrchr($file_name, ".");
  $file_tmp_name = $_FILES['fichier']['tmp_name'];
  $file_dest = 'files/'.$file_name;
  $extension_autorisees = array('.png', '.PNG',); //Seul ces formats sont autorisés
  if (in_array($file_extension, $extension_autorisees)) {
    if(move_uploaded_file($file_tmp_name, $file_dest)) {
      $requete = $bdd->prepare('INSERT INTO file(name, file_url) VALUES(?,?)');
      $requete->execute(array($file_name, $file_dest));
      echo "Fichier envoyer avec succés";
    }
  }else {
    echo "seul les fichiers PDF sont autorisés";
  }

}  
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<input type="file" name="fichier"/><br>
		<input type="submit" name="Envoyer le fichier"/>
	</form>
</body>
</html>