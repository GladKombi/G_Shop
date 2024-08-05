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
    $id = $_GET['idcom'];
    #Ici je specifie le lien lors de l'enregistrement des participants à la commande
    $url = "../models/add/add-Command-post.php?idcom=$id";
    $btn = "Save";
    $title = "Add a to the command";
    #La selection du user
    $statut = 0;
    $etat = 0;
    $getUser = $connexion->prepare("SELECT * FROM `user` WHERE statut=? and etat=?");
    $getUser->execute([$statut, $etat]);
    #Recuperation de la quantité totale de la commande
    $getQuantity = $connexion->prepare("SELECT quantite FROM `command` WHERE id=?");
    $getQuantity->execute(array($id));
    if ($tab = $getQuantity->fetch()) {
        $commandQte = $tab['quantite'];
    } else {
        $commandQte = 0;
    }
    #Selection de la quantité déjà Attribueé
    $getQuantity = $connexion->prepare("SELECT SUM(quantite) as stock FROM participants WHERE commad=?");
    $getQuantity->execute(array($id));
    if ($table = $getQuantity->fetch()) {
        $stockAttri = $table['stock'];
    } else {
        $stockAttri = 0;
    }
    #Calucul de la quantite non attribuer 
    $stockResta = $commandQte - $stockAttri;
    #Recuperation de la Description de la commande
    $getDescription = $connexion->prepare("SELECT `description` FROM `command` WHERE id=?;");
    $getDescription->execute([$id]);
    if ($Des = $getDescription->fetch()) {
        $Descrption = $Des['description'];
    }
    # Affichage des participants
    $getParticipant = $connexion->prepare("SELECT `participants`.*, user.nom, user.postnom, user.prenom FROM `participants`,user WHERE participants.commad=?;");
    $getParticipant->execute([$id]);
} else {

    #Ici je specifie le lien lors qu'il s'agit de l'enregistrement
    $url = "../models/add/add-Command-post.php";
    $btn = "Save";
    $title = "Add a new Command";
}

# Selection de la commande et ses participant
$getData = $connexion->prepare("SELECT `command`.*, user.nom,user.prenom FROM `command`,user,participants WHERE participants.commad=command.id and participants.user=user.id GROUP BY participants.commad ORDER BY command.id DESC;");
$getData->execute();
