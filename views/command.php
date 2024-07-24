<?php
# Connexion à la BD
include '../connexion/connexion.php'; //
# Appel de la page qui fait les affichages
require_once('../models/select/select-Command.php');
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
            if (isset($_GET['newCommand']) || isset($_GET['idCommand'])) {
            ?>
                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title text-center"><?= $title ?></h4>
                                <div class="form-body">
                                    <form class="form" enctype="multipart/form-data" action="<?= $url ?>" method="post">
                                        <div class="row">
                                            <div class="form-group col-xl-4 col-lg-4 col-md-4  col-sm-6 p-3">
                                                <label for="feedback1" class="sr-only">Description <span class="text-danger">*</span></label>
                                                <input type="text" autocomplete="off" id="feedback1" class="form-control" placeholder="Enter the Description" name="description">
                                            </div>
                                            <div class="form-group col-xl-4 col-lg-4 col-md-4  col-sm-6 p-3">
                                                <label for="feedback1" class="sr-only">Quantity <span class="text-danger">*</span></label>
                                                <input type="number" autocomplete="off" id="feedback1" class="form-control" placeholder="Enter the Quantity" name="quantite">
                                            </div>
                                            <div class="form-group col-xl-4 col-lg-4 col-md-4  col-sm-6 p-3">
                                                <label for="feedback4" class="sr-only">Price <span class="text-danger">*</span></label>
                                                <input type="text" autocomplete="off" id="feedback4" class="form-control" placeholder="Enter the price" name="prix">
                                            </div>
                                            <div class="form-group col-xl-4 col-lg-4 col-md-4  col-sm-6 p-3">
                                                <label for="feedback2" class="sr-only">Photo <span class="text-danger">*</span></label>
                                                <input type="file" id="feedback2" class="form-control" placeholder="Select a photo" name="picture">
                                            </div>

                                            <div class="form-actions d-flex justify-content-end">
                                                <a href="command.php"><button type="reset" class="btn btn-danger me-1">Cancel</button></a>
                                                <button type="submit" class="btn btn-primary " name="valider"><?= $btn ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } elseif (isset($_GET['idcom']) && !isset($_GET['newCommand'])) {
            ?>
                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title text-center"><?= $title ?></h4>
                                <div class="form-body">
                                    <form class="form" enctype="multipart/form-data" action="<?= $url ?>" method="post">
                                        <div class="row">
                                            <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                <label for="feedback1" class="sr-only">Select a user <span class="text-danger">*</span></label>
                                                <select class="form-select" name="user" id="inputGroupSelect01">
                                                    <?php
                                                    while ($iduser = $getUser->fetch()) {
                                                    ?>
                                                        <option value="<?= $iduser['id'] ?>"><?= $iduser['nom'] . " " . $iduser['postnom'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                <label for="feedback1" class="sr-only">Quantity <span class="text-danger">*</span></label>
                                                <input type="number" autocomplete="off" id="feedback1" class="form-control" placeholder="E.g: 100" name="quantite">
                                            </div>

                                            <div class="form-actions d-flex justify-content-end">
                                                <a href="command.php"><button type="reset" class="btn btn-danger me-1">new Command</button></a>
                                                <button type="submit" class="btn btn-primary " name="save"><?= $btn ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <a href="command.php?newCommand">Add a new Command</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>


            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>DataTable</h3>
                            <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables.</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Simple Datatable
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Graiden</td>
                                        <td>vehicula.aliquet@semconsequat.co.uk</td>
                                        <td>076 4820 8838</td>
                                        <td>Offenburg</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>

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