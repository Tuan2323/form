<?php
include("tete.inc.php"); 
include_once("corps.inc.php"); 
require("corps.html"); 

$idcom = new mysqli(MYHOST, MYUSER, MYPASS, "form");
if(!$idcom){
    echo "Connexion impossible";
    exit(); //On arrete tout, on sort du script
}
if(!empty($_POST['nom']) && (!empty($_POST['prenom'])) && (!empty($_POST['date'])) 
&& (!empty($_POST['lieu'])) && (!empty($_POST['adresse'])) && (!empty($_POST['postal'])) 
&& (!empty($_POST['mail'])) && (!empty($_POST['site'])) && (!empty($_POST['tel'])) 
&& (!empty($_POST['semestre'])) && (!empty($_POST['html'])) && (!empty($_POST['connaissance']))){

    //Etape 5: La fonction escape_string permet d'échaper tous les caractères spéciaux que pourra saisir l'utilisateur
    $nom = $idcom->escape_string($_POST['nom']);
    $prenom = $idcom->escape_string($_POST['prenom']);
    $date = $_POST['date'];
    $lieu = $idcom->escape_string($_POST['lieu']);
    $adresse = $idcom->escape_string($_POST['adresse']);
    $postal = $idcom->escape_string($_POST['postal']);
    $mail = $idcom->escape_string($_POST['mail']);
    $site = $idcom->escape_string($_POST['site']);
    $tel = $idcom->escape_string($_POST['tel']);
    $semestre = $idcom->escape_string($_POST['semestre']);
    $html = $idcom->escape_string($_POST['html']);
    $connaissance = $idcom->escape_string($_POST['connaissance']);

    //Etape 6: Ecrire la requête
    $requete = "INSERT INTO form(nom, prenom, date, lieu,adresse,postal,mail,site,tel,semestre,html,connaissance) 
    VALUES ('$nom', '$prenom', '$date', '$lieu','$adresse', '$postal', '$mail', '$site','$tel', '$semestre', '$html', '$connaissance')";

    //Etape 7: Envoyer la requete au serveur en utilisant la fonction query de la classe mysqli
    $result = $idcom->query($requete);

    //Etape 8: On vérifie si la requete a bien été exécuté/recue au niveau du serveur mysql
    if($result){
        echo "Vous avez bien été enregistré au numéro :".$idcom->insert_id;
    }
    else { echo "Erreur ".$idcom->error;}

    //Etape 9 et dernière étape: On ferme la connexion
    $idcom->close();
}
else {echo "Veuillez remplir la formulaire"; }

include_once('myparam.inc.php');
require_once("pied.inc.php"); 
?>