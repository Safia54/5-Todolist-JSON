<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);



//santization
$str = $_POST["tache1"];
$newstr = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

// créer tableau 
$new_array = ["faire" => $newstr, 
				"etat" => "faire"];

//validation
if (!empty($new_array)) {
  
  
//recupérer le contenu du json
$alltask = file_get_contents('todo.json');


//Récupère la chaîne encodée JSON et la convertit en une variable PHP.
$array_json = json_decode($alltask, true);

// ajouter des contenu du $new_array à l'array 
array_push($array_json, $new_array);

// Retourne une chaîne contenant la représentation JSON de la valeur value./ retransforme de php à json
$json_envoyer =json_encode($array_json, JSON_PRETTY_PRINT);

//  les élement php sont remis dans le json 
file_put_contents('todo.json',$json_envoyer);

}
?>


<!DOCTYPE html>
 <html>
 <head>
 	<title> formulaire </title>
 	<meta charset="utf-8">
 </head>
 <body>
 	<h1> TO DO LIST</h1>

 	<form method="POST" action="contenu.php">

 	<fieldset> 
 		<p>A faire</p>
 		<!-- Il faudrait ici des checkbox de mes tâches -->
 		<?php 
 		
 		foreach ($array_json as $key => $i) {

 			 echo '<input type="checkbox" name="' . $key . '" value="' . $i["faire"] . '"> <label>' . $i["faire"] . '</label>' . '</br>';
 		};

 		?>
 		
 		
 		<!-- Il faudrait un bouton submit enregistrer-->
 		<input type="submit" name="enregistrer" value="enregistrer">
 	</fieldset>

 	<fieldset>
 		<p>Archives</p>
 		<!-- Il faudrait ici des checkbox de mes tâches archivées barrées en css-->
 		<input class="barré" type="checkbox" value="" >
 	</fieldset>
 	</form>



 	<form method="POST" action="formulaire.php">
	<fieldset>
	 	<p> Ajouter une tâche </p>
	 	<input type="texte" name ="tache1" placeholder="introduire tâche">
	 	<input type="submit" name="ajouter" value="ajouter" >
 	</fieldset>
 	</form>


 </body>
 </html>