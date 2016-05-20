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
    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="index.php" class="btn btn-primary btn-xl page-scroll">RETOUR ACCEUIL</a><br><br><br>
       
 <?php
 require 'connexion.php';
 $search = $bdd->query('SELECT * FROM autorisation WHERE verif = 0'); 
 if($search->fetch()) {
 ?>
                    
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
$liste = $bdd->query('SELECT * FROM autorisation');
$idbdd = $bdd->query('SELECT id FROM autorisation WHERE verif = 0');
    
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
    echo "<td> " . ($donnees['verif'] == 0 ? "en attente":"validée"). "</td>";
    echo "</tr>";
}
$liste->closeCursor();
?>
        </table> 
                    <form method="post" action="traitement_validation_autorisation.php">
                        
                    <select name="idAuto" class="form-control">
                    <?php while ($data = $idbdd->fetch()) { ?>
                    <option value="<?php echo $data['id'] ?>"><?php echo $data['id'] ?></option> <?php } ?>
                    </select>
                        <br><br>
                        <h4> Pour valider une autorisation, sélectionnez son ID dans la liste déroulante ci-dessus.</h4>
                        <h4> Puis appuyez sur le bouton "Valider".</h4>
                        <br><br>
                    <div class="col-lg-6 col-lg-offset-3 text-center">
                        <input type="submit" value="Valider" class="btn btn-primary btn-xl page-scroll">
                    </div>                       
                    </form>
                </div>
            </div> 
        </div>
        </section>
    <?php } 
    
    else {
        ?>
    <h4>Il n'y a pas de nouvelles demandes.</h4><?php
    }
?>
        
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
 