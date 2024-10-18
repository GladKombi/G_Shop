<?php
# Connexion à la BD
include '../connexion/connexion.php'; //
# Appel de la page qui fait les affichages
require_once('../models/select/select-ViewCommand.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Command</title>
    <?php require_once('style.php') ?>
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php
        require_once('Active.php');
        $Activecommand = 1;
        require_once('aside.php');
        ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <?php
            #pour afficher les massage  
            if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
            ?>
                <div class="alert-primary alert text-center"><?php echo $_SESSION['msg']; ?> </div>
            <?php }
            unset($_SESSION['msg']);
            ?>
            <div class="row">                
                <div class="col-xl-12 col-md-6 col-sm-12">                    
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title mb-0 text-center"><?=$ShowCom["description"] ?></h4>
                            </div>
                            <div class="embed-responsive embed-responsive-item embed-responsive-16by9 w-100">
                                <img src="../assets/photo/<?= $ShowCom["photo"] ?>" class="w-100">
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <h6 class="text-center"><?=$ShowCom["description"]." Of ".$ShowCom["date"] ?></h6>
                                    This command contains a total of <b><?=$ShowCom["quantite"]?> Pcs</b> Voir les details pour cette commande dans le tableau ci-bas !
                                </p>
                                <div class=" text-center">
                                    <a href="command.php" class="card-link btn btn-primary">Other commands</a>
                                </div>
                                                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-heading">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-center">
                                Command Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="table1">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Participants</th>
                                        <th>Quantity</th>                                        
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $n = 0;
                                    while ($Command = $getData->fetch()) {
                                        $n++;
                                    ?>
                                        <tr>
                                            <td><?= $n ?></td>
                                            <td><?= $Command["date"] ?></td>
                                            <td><?= $Command["description"] ?></td>
                                            <td><?= $Command["nom"]." ".$Command["prenom"] ?></td>
                                            <td><?= $Command["quantite"] ?> Pcs</td>
                                            <td>
                                                <a href="Command-Details.php?idCommand=<?= $Command['id'] ?>" class="btn btn-primary btn-sm "><i class="bi bi-pencil-square"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy; G_Shop</p>
                    </div>
                    <div class="float-end">
                        <p>Design with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="#">Glad</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php require_once('script.php') ?>

</body>

</html>