<?php
if (isset($_GET['idCommand'])) {
    $id = $_GET['idCommand'];
    $getDataMod = $connexion->prepare("SELECT * FROM command WHERE id=?");
    $getDataMod->execute([$id]);
    $tab = $getDataMod->fetch();

    #Ici je specifie le lien lors qu'il s'agit de la modification, 
    $url = "../models/updat/up-utilisateur-post.php?idCommand=" . $id;
    $btn = "Modify";
    $title = "Modify a command";
} elseif (isset($_GET['idcom'])) {
    #Ici je specifie le lien lors de l'enregistrement des participants à la commande
    $url = "../models/add/add-Command-post.php?idCom";
    $btn = "Save";
    $title = "Add a to the command";
    #La selection du user
    $statut=0;
    $etat=0;
    $getUser = $connexion->prepare("SELECT * FROM `user` WHERE statut=? and etat=?");
    $getUser->execute([$statut,$etat]);
} else {

    #Ici je specifie le lien lors qu'il s'agit de l'enregistrement
    $url = "../models/add/add-Command-post.php";
    $btn = "Save";
    $title = "Add a new Command";
}

$getData = $connexion->prepare("SELECT * FROM `command`");
$getData->execute();
