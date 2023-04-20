<!-- ============================================================================ -->
<!-- Create_category.php -->
<!-- ============================================================================ -->


<?php

// Vérifie que l'utilisateur est logé
session_start();
require_once 'functions.php';
check_login();

// Variables pour lister les types Comptables
$type_comptables = listTypeComptables();
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

<body class="create">
    <main class="card card--inverted">
        <h1>Nouvelle catégorie</h1>
        <!-- ---------------------------------------------------------------------------- -->
        <!-- Fomulaire pour créer une catégorie -->
        <form action="add_category.php" method="post">
            <label class="input input--inverted">
                <input type="text" class="input__field" name="nom_categorie" placeholder=" " id="nom_categorie" required>
                <span for="nom_categorie" class="input__label">Nom de la catégorie</span>
            </label>
            <label class="input input--inverted">
                <select name="id_type_comptable" class="input__field" id="id_type_comptable" required>
                    <option value="">-- Choisir un type --</option>
                    <!-- ---------------------------------------------------------------------------- -->
                    <!--  Foreach pour lister les types de comptables -->
                    <?php foreach ($type_comptables as $type_comptable) : ?>
                        <option value="<?= $type_comptable['id'] ?>"><?= $type_comptable['nom_type_comptable'] ?></option>
                    <?php endforeach; ?>
                    <!-- ---------------------------------------------------------------------------- -->
                </select>
                <label for="id_type_comptable" class="input__label">Type Comtable</label>
            </label>
            <button class="btn btn--inverted" type="submit">Créer</button>
        </form>
    </main>
</body>

</html>