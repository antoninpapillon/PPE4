<?php
    
require('connexion.php');
    
if (isset($_SERVER['REQUEST_URI'])) {
    $idAuto = isset($_GET['idAuto']) ? $_GET['idAuto'] : '';
} else {
}
    
//Préparation de la requête SQL
$req = $bdd->prepare('UPDATE autorisation SET verif = 1 WHERE id='.$idAuto.'') 
        or exit(print_r($bdd->errorInfo()));

if ($idAuto) {
    
    //Exécution de la requête SQL
$req->execute();
} 

else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <title>Génération PDF</title>
            
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="assets/bootsrap/css/bootstrap.min.css" type="text/css">
            
        <!-- Custom Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
            
        <!-- Plugin CSS -->
        <link rel="stylesheet" href="assets/bootsrap/css/animate.min.css" type="text/css">
            
        <!-- Custom CSS -->
        <link rel="stylesheet" href="assets/bootsrap/css/creative.css" type="text/css">
    </head>
    <body>
<?php
}
?>
    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="index.php" class="btn btn-primary btn-xl page-scroll">RETOUR ACCEUIL</a><br><br><br>
        
        <TABLE BORDER="1" class="table">
            <h2>Liste des autorisations</h2>
            <tr>
                <th> Id </th>
                <th> Nom </th>
                <th> Prénom </th>
                <th> Date de début </th>
                <th> Date de fin </th>
                <th> Motif </th>
                <th> Validation </th>
            </tr>
            
<?php
require 'connexion.php';

$liste = $bdd->query('SELECT * FROM autorisation');
$idbdd = $bdd->query('SELECT id FROM autorisation');

while ($donnees = $liste->fetch())
{
    //On affiche les données dans le tableau
    echo "</tr>";
    echo "<td> $donnees[id] </td>";
    echo "<td> $donnees[nomSal] </td>";
    echo "<td> $donnees[prenomSal] </td>";
    echo "<td> $donnees[dateDebut] </td>";
    echo "<td> $donnees[dateFin] </td>";
    echo "<td> $donnees[motif] </td>";
    echo "<td> $donnees[verif] </td>";
    echo "</tr>";
}
$liste->closeCursor();
?>
        </table> 
                    <form method="get" action="message.php">
                        
                    <select name="idAuto" class="form-control">
                    <?php while ($data = $idbdd->fetch()) { ?>
                    <option value="<?php echo $data['id'] ?>"><?php echo $data['id'] ?></option> <?php } ?>
                    </select>
                        <br><br>
                        <h4> Si la colonne "validation" est à 0 c'est que la demande n'est pas acceptée. </h4>
                        <h4> Pour valider une autorisation, sélectionnez son ID dans la liste déroulante ci-dessus.</h4>
                        <h4> Puis appuyez sur le bouton "Valider".</h4>
                        <br><br>
                    <div class="col-lg-6 col-lg-offset-3 text-center">
                        <input type="submit" value="Valider" class="btn btn-primary btn-xl page-scroll">
                    </div>                       
                    </form>
                    
                    <?php
                    echo $idAuto;
                    ?>
                </div>
            </div> 
        </div>
        </section>
        
    <script src="assets/bootsrap/js/jquery.js"></script>
        
    <!-- Bootstrap Core JavaScript -->
    <script src="assets/bootsrap/js/bootstrap.min.js"></script>
        
    <!-- Plugin JavaScript -->
    <script src="assets/bootsrap/js/jquery.easing.min.js"></script>
    <script src="assets/bootsrap/js/jquery.fittext.js"></script>
    <script src="assets/bootsrap/js/wow.min.js"></script>
        
    <!-- Custom Theme JavaScript -->
    <script src="assets/bootsrap/js/creative.js"></script>
        
</body>
</html>
    