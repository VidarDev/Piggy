<!-- ============================================================================ -->
<!-- List categories.php -->
<!-- ============================================================================ -->

<?php
// Vérifie que l'utilisateur est logé
session_start();
require_once 'functions.php';
check_login();

$categories = listCategories();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="./favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="./manifest.json">
    <link rel="stylesheet" href="./assets/css/style.css">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Découvrez l'application de budget de Théo Richier.">
    <meta name="keywords" content="budgeting, application, budgeting app, designer, freelance, portfolio">
    <meta name="author" content="Théo Richier">
    <title>Piggy - Catégorie</title>
</head>

<body class="list">
    <!-- ---------------------------------------------------------------------------- -->
    <!-- Recupère le header -->
    <?php require_once './components/_header.php'; ?>
    <!-- ---------------------------------------------------------------------------- -->
    <nav id="navbar">
        <a href="./create_category.php"><img src="assets/img/plus.svg" /></a>
        <ul class="nav__list">
            <li class="nav__item">
                <a href="./list_categories.php">Catégories</a>
            </li>
            <li class="nav__item">
                <a href="./index.php">Transactions</a>
            </li>
        </ul>
    </nav>
    <main class="container">
        <h1>Liste des catégories</h1>
        <div class="card">
            <table>
                <tr>
                    <th>Nom de la catégorie</th>
                    <th>ID Type comptable</th>
                </tr>
                <!-- ---------------------------------------------------------------------------- -->
                <!-- Liste les catégories -->
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?= $category['nom_categorie'] ?></td>
                        <td><?= $category['id_type_comptable'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <!-- ---------------------------------------------------------------------------- -->
            </table>
        </div>
    </main>
    <!-- ---------------------------------------------------------------------------- -->
    <!-- Recupère le footer -->
    <?php require_once './components/_footer.php'; ?>
    <!-- ---------------------------------------------------------------------------- -->
</body>

</html>