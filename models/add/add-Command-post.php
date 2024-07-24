<?php
include_once '../../connexion/connexion.php'; // Appel de la connexion
// Enregistrement de la commande
if (isset($_POST['valider'])) {
    $date = date('Y-m-d');
    $Description = htmlspecialchars($_POST['description']);
    $Quantite = htmlspecialchars($_POST['quantite']);
    $prix = htmlspecialchars($_POST['prix']);
    $image = $_FILES['picture']['name'];
    $file = $_FILES['picture'];
    $destination = "../../assets/photo/" . basename($image);
    // fonction permettant de recuperer la photo
    $newimage = RecuperPhoto($image, $file, $destination);
    $statut = 0;
    // requette permettant d'inserer une commande dans la base des données
    $req = $connexion->prepare("INSERT INTO `command`(`date`, `description`, `quantite`, `prix`, `photo`, `statut`) VALUES (?,?,?,?,?,?)");
    $resultat = $req->execute(array($date, $Description, $Quantite, $prix, $photo, $statut));
    $id = $connexion->lastInsertId();
    if ($resultat == true) {
        $_SESSION['msg'] = " Votre commande viens d'être enregistrer avec succes";
        header("location:../../views/commande.php?idcom=$id");
    }
} elseif (isset($_POST['save'])) { //Ajout au participant
    $id = $_GET['idCom'];
    $user = htmlspecialchars($_POST['user']);
    $Quantite = htmlspecialchars($_POST['quantite']);
    /**
     * Cette requette retourne la quantité total de a command
     */
    $getQuantity = $connexion->prepare("SELECT quantite FROM `command` WHERE id=?"); //Recuperation de la quantité et du prix
    $getQuantity->execute(array($id));
    if ($tab = $getQuantity->fetch()) {
        $QuantiteEnre = $tab['quantite'];       
    } else {
        $QuantiteEnre = 0;
    }
    /**
     * Cette requette retourne la quantité déjà attribuer
     */
    $requete = $connexion->prepare("SELECT SUM(quantite) as stock FROM participants WHERE commad=?");
    $requete->execute(array($id));
    if ($table = $requete->fetch()) {
        $stockVendu = $table['stock'];
    } else {
        $stockVendu = 0;
    }
    $stockResta = $QuantiteEnre - $stockVendu;
    //Ici on verifie si quantité qu'on a besion de commandée est supperieur à ce qui est en stok                  
    if ($Quantite > $stockResta) {
        $_SESSION['msge'] = "Please enter a valid quantity !";
        header("location:../../views/command.php?idcom=$id");
    } else {
        $req = $connexion->prepare("INSERT INTO `participants`(`user`, `commad`, `quantite`, `statut`) VALUES (?,?,?,?,?)");
        $req->execute(array($user, $id, $Quantite, $statut));
        if ($req) {
            $_SESSION['msge'] = "A new addition to the order has just been made !";
            // if (isset($_GET['idpartic'])) {
            //     header("location:../../views/command.php?idcom=$id&idpartic=0");
            // } else {
                header("location:../../views/command.php?idcom=$id");
            // }
        }
    }
} else {
    header("location:../../views/command.php");
}
