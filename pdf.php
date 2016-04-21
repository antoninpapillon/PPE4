<?php
    
require('connexion.php');
    
if (isset($_SERVER['REQUEST_URI'])) {
    $generate = isset($_GET['make_pdf']);
    $nom = isset($_GET['nom']) ? $_GET['nom'] : '';
    $prenom = isset($_GET['prenom']) ? $_GET['prenom'] : '';
    $dateDebut = isset($_GET['dateDebut']) ? $_GET['dateDebut'] : '';
    $dateFin = isset($_GET['dateFin']) ? $_GET['dateFin'] : '';
    $motif = isset($_GET['motif']) ? $_GET['motif'] : '';
} else {
    $generate = true;
    $nom = '';
}
    
//Préparation de la requête SQL
$req = $bdd->prepare('INSERT INTO autorisation(nomSal, prenomSal, dateDebut, dateFin, motif) '
        . 'VALUES(:nomSal, :prenomSal, :dateDebut, :dateFin, :motif)') 
        or exit(print_r($bdd->errorInfo()));
            
            
            
//Ce qui va être affiché dans le PDF
$pdf = 
'<style>
    h1 {
        text-align: center;
    }
        
    .align1 {
        float: left;
    }
        
    .align2 {
        margin-left: 50px;
    }
        
    .signatureRes {
        margin-left: 400px;
    }
        
    .image {
        display: block;
        margin-left: 100px;
        margin-right: auto;
        width: 500px;
	height: 200px;
    }
        
</style>
    
<img src="assets/img/Fyctive.jpg" class="image"/>
<br><br>
<h1>Autorisation d\'absence</h1>
<br><br>
<h2>Salarié</h2>
<br>
<p><span class="align1">Nom : '.$nom.'</span><span class="align2">Prénom : '.$prenom.'</span></p>
<br><br>
<h2>Dates</h2>
<br>
<p><span class="align1">Date de début : '.$dateDebut.'</span><span class="align2">Date de Fin : '.$dateFin.'</span></p>
<br><br>
<h2>Motif</h2>
<br>
<p>'.$motif.'</p>
<br><br>
<h2>Signatures</h2>
<br>
<p><span class="align1">Signature salarié : </span><span class="signatureRes">Signature resonsable : </span></p>
    
';
    
if ($generate) {
    
    //Exécution de la requête SQL
$req->execute(array(
    'nomSal' => $nom,
    'prenomSal' => $prenom,
    'dateDebut' => $dateDebut,
    'dateFin' => $dateFin,
    'motif' => $motif
));
    
    ob_start();
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
                    
                    <form method="get" action="">
                        <input type="hidden" name="make_pdf" value="">
                        <h2 class="section-heading">Formulaire</h2>
                        <hr class="light">
 
                        <div class="col-lg-6 col-md-6 text-center">
                            <p>Nom</p>
                            <input type="text" class="form-control" id="nom" name="nom" /><p></br>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 text-center">
                            <p>Prénom</p>
                            <input type="text" class="form-control" id="prenom" name="prenom" /><p></br>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 text-center">
                            <p class="text-faded">Date de début</p>
                            <input type="text" class="form-control" id="dateDebut" name="dateDebut" /><p></br>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 text-center">
                            <p class="text-faded">Date de fin</p>
                            <input type="text" class="form-control" id="dateFin" name="dateFin"/><p></br>
                        </div>
                        
                        <div class="col-lg-6 col-lg-offset-3 text-center">
                            <p>Motif</p>
                            <input type="text" class="form-control" id="motif" name="motif"/><p></br>
                        </div>
                        
                        <div class="col-lg-6 col-lg-offset-3 text-center">
                            <input type="submit" value="Generer le PDF" class="btn btn-primary btn-xl page-scroll">
                        </div>
                        
<!--                        <input type="hidden" name="make_pdf" value="">
                        Ton nom : <input type="text" name="nom" value="">
                        Prénom : <input type="text" name="prenom" value="">
                        <br><br>
                        Date de début : <input type="text" name="dateDebut" value="">
                        Date de fin : <input type="text" name="dateFin" value="">
                        <br><br>
                        Motif : <input type="text" name="motif" value="">
                        <br><br>
                        <input type="submit" value="Generer le PDF" >-->
                    </form>
                    
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
    
<?php
    if ($generate) {
        $content = ob_get_clean();
        require_once(dirname(__FILE__).'/assets/vendor/autoload.php');
        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->writeHTML($pdf);
            $html2pdf->Output('absence.pdf');
            exit;
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }
?>