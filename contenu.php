<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["todo"])){
	$file = "todo.json";
	$taches_du_formulaire = $_POST["todo"];
	$taches_du_formulaire = filter_var($taches_du_formulaire,FILTER_SANITIZE_STRING);//sanitisation

	if (!empty($taches_du_formulaire)){ 
		$taches_array_todo = array(
		"tâche" => $taches_du_formulaire,
		"état" => "todo"
		); //transformer en array
		// print_r($taches_array_todo);
		// echo "</br>";
		$contenu_du_json = file_get_contents($file); //appeler le contenu du json
		$contenu_du_json_en_PHP = json_decode($contenu_du_json, true); // json_decode pour transformer le json en php ET true pour qu'il retourne un array
		// print_r($contenu_du_json_en_PHP);
		array_push($contenu_du_json_en_PHP, $taches_array_todo); //ajouter dans l'array les nouvelles arrays
		print_r($contenu_du_json_en_PHP);
		echo '</br>'; //voir ce qui a dans le contenu json en php
		$transformer_en_json= json_encode($contenu_du_json_en_PHP, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE); // la fonction json_enconde transforme le php en json et le flag JSON_PRETTY_PRINT permet d'afficher dans le json une disposition qui va à ligne afin que ce soit plus lisible et le flag JSON_UNESCAPED_UNICODE sert à faire respecter utf8
		file_put_contents($file,$transformer_en_json); //mettre dans le json

	}else {
	echo "Vous n'avez rien envoyé";
	}
}

// if (isset($_POST["todo2"])){
// print_r($_POST['todo2']);
// }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1> TO DO LIST</h1>
		<h4> by Safia </h4>
		<h2> Liste de choses à faire avant de mourir: </h2>
		<form method="post" action="formulaire.php">
			<?php 

			foreach ($contenu_du_json_en_PHP as $key => $todo) {
				
			 		echo '<input type="checkbox" name="done[]">'. $todo["tâche"] . '</br>';
			 }

			?>

			<input type="submit" name="envoyerDone" value="cocher et valider choses faites">
		</form>
		<form method="post" action="contenu.php">
			<p> écrit ci-dessous une tâche/mission que tu aimerais bien faire avant de crever. La vie est courte, veux-tu apprendre la guitare? Devenir peintre cubiste? sortir un album de rap? Apprendre la programmation informatique ? Ecris tout ce que tu veux ici </p>	
			<input type="text" name="todo" placeholder="Ecrire tâche ici"> 
			</textarea> 
			<input type="submit" name="envoyerTodo" value="Créer nouvelle tâche">
			<h2> Trucs déjà faits de la liste :</h2>
			<?php 
			$done = $_POST['done'];
			print_r($done);
			// foreach ($done as $key => $value) {
			// 	echo $key;
			// }
			// echo '<input class="barré type="checkbox" checked ="yes" disabled ="disabled">' . $_POST['todo2'];
			 ?>
		</form>
	</body>
</html>

