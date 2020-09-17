<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../jquery/jquery-3.5.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <title>TP liste articles</title>
</head>
<body>
    <div class="container-fluid">
        <div class="container">
            <h1 class="jumbotron text-center">Liste des articles</h1>
        </div>
        <!-- Gestion des messages d'erreurs  -->
        <?php if(count($errors) > 0): ?>
        <div class="container">
            <ul class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <li>
                    <?= $error ?>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
        <?php endif ?>
        <!-- Gestion des messages success  -->
        <?php if(count($success) > 0): ?>
        <div class="container">
            <ul class="alert alert-success">
                <?php foreach($success as $succes): ?>
                <li>
                    <?= $succes ?>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
        <?php endif ?>
        <!-- Si pas de connexion à la BD on n'affiche pas le tableau  -->
        <?php if(empty($errors) || $errors[0] != $errorPDO ): ?>
        <div class="container mt-2">
            <!-- Formulaire suppression de produit  -->
            <form method="post">
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th scope="col">Référence</th>
                            <th scope="col">Désignation</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($productsList as $row): ?>
                        <tr>
                            <?php foreach($row as $line): ?>
                                <td><?= $line ?></td>       
                            <?php endforeach ?>
                            <td><button class="btn btn-secondary" type="submit" name="sup" value="<?= $row['id'] ?>">Supprimer</button></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>          
            </form>
        </div>
        <?php endif ?>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <!-- Formulaire de modification de produit -->
                    <form method="post">
                        <div class="container border border-dark mt-3">
                            <div class="row">
                                <h2 class="mt-2 ml-2">Modifier un article à la liste ?</h2>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="id" placeholder="Référence">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="product_name" placeholder="Désignation">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="price" placeholder="Prix">
                                </div>
                            </div>
                            <div class="input-group my-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Catégories</label>
                                </div>
                                <select class="custom-select" name="category" id="inputGroupSelect01">
                                    <option selected>Choisissez une catégorie...</option>
                                    <option value="liquide">Liquide</option>
                                    <option value="Epicerie sucrée">Epicerie sucrée</option>
                                    <option value="Epicerie salée">Epicerie salée</option>
                                    <option value="Animalerie">Animalerie</option>
                                    <option value="Droguerie">Droguerie</option>
                                    <option value="Parfumerie">Parfumerie</option>
                                    <option value="Crémerie">Crémerie</option>
                                </select>
                                <td><button class="btn btn-secondary" type="submit">Modifier</button></td>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <!--  Formulaire d'ajout de produit -->
                    <form method="post">
                        <div class="container border border-dark mt-3">
                            <div class="row">
                                <h2 class="mt-2 ml-2">Ajouter un article à la liste ?</h2>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="product_name" placeholder="Désignation">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="price" placeholder="Prix">
                                </div>
                            </div>
                            <div class="input-group my-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Catégories</label>
                                </div>
                                <select class="custom-select" name="category" id="inputGroupSelect01">
                                    <option selected>Choisissez une catégorie...</option>
                                    <option value="liquide">Liquide</option>
                                    <option value="Epicerie sucrée">Epicerie sucrée</option>
                                    <option value="Epicerie salée">Epicerie salée</option>
                                    <option value="Animalerie">Animalerie</option>
                                    <option value="Droguerie">Droguerie</option>
                                    <option value="Parfumerie">Parfumerie</option>
                                    <option value="Crémerie">Crémerie</option>
                                </select>
                                <td><button class="btn btn-secondary" name="add" type="submit">Ajouter</button></td>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>