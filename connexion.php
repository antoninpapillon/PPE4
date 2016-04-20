<?php
require('identifiants.php');

try {
        $bdd = new PDO($dbname, $user, $mdp );
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$test = $bdd->query('SELECT * FROM salarie');

while ($donnees = $test->fetch())
{
   echo $donnees['id'];
   echo $donnees['nom'];
   echo $donnees['prenom'];
}
$test->closeCursor();
?>
