<?php

session_start();
require('connexion.php');

function Messager($titre, $description) {
    $_SESSION['titre_message'] = $titre;
    $_SESSION['description_message'] = $description;
    header("Location: message.php");
}

if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idAuto'])) {
        $idAuto = $_POST['idAuto'];
        $verif = $bdd->query('SELECT verif FROM autorisation WHERE id=' . $idAuto . '')->fetch()[0];

        if ($idAuto > 0 && $verif == 0) {
            $req = $bdd->prepare('UPDATE autorisation SET verif = 1 WHERE id=' . $idAuto . '');
            $req->execute();

            // gestion des sorties
            Messager("AUTORISATION VALIDÉE !", "Un email à été envoyé, la version papier va arriver.");
        } else {
            Messager("AUTORISATION DÉJÀ VALIDÉE", "On ne peut valider une autorisation qu'une seule fois");
        }
    } else {
        Messager("ERREUR", "Le formulaire n'a pas envoyé la variable idAuto");
    }
} else {
    Messager("ERREUR", "Le traitement ne peut se faire qu'en POST");
}
?>
