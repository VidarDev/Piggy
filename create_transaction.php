<!-- ============================================================================ -->
<!-- Create_transaction.php -->
<!-- ============================================================================ -->

<?php

// Vérifie que l'utilisateur est logé
session_start();
require_once 'functions.php';
check_login();

// Récupération des 
$categories = listCategories();
$payments = listPayements();
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
    <title>Piggy - Transaction</title>
</head>

<body class="create">
    <main class="card card--inverted">
        <h1>Nouvelle transaction</h1>
        <!-- ---------------------------------------------------------------------------- -->
        <!-- Fomulaire pour créer une transaction -->
        <form action="add_transaction.php" method="post">
            <label class="input input--inverted">
                <input type="datetime-local" class="input__field" name="date_transaction" id="date_transaction" placeholder=" " required>
                <label for="date_transaction" class="input__label">Date</label>
            </label>
            <label class="input input--inverted">
                <input type="number" class="input__field" name="montant" id="montant" step="1" min="1" placeholder=" " required>
                <label for="montant" class="input__label">Montant</label>
            </label>
            <label class="input input--inverted">
                <input type="text" class="input__field" name="description" id="description" placeholder=" " required>
                <label for="description" class="input__label">Description</label>
            </label>
            <label class="input input--inverted">
                <select name="id_categorie" class="input__field" id="id_categorie" required>
                    <option value="">-- Choisi une catégtorie --</option>
                    <!-- ---------------------------------------------------------------------------- -->
                    <!-- Foreach pour lister les catégories -->
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['nom_categorie'] ?></option>
                    <?php endforeach; ?>
                    <!-- ---------------------------------------------------------------------------- -->
                </select>
                <label for="id_categorie" class="input__label">Catégorie</label>
            </label>
            <label class="input input--inverted">
                <select name="id_moyen_de_paiement" class="input__field" id="id_moyen_de_paiement" required>
                    <option value="">-- Choisi un moyen de paiement --</option>
                    <!-- ---------------------------------------------------------------------------- -->
                    <!--  Foreach pour lister les moyens de payements -->
                    <?php foreach ($payments as $payment) : ?>
                        <option value="<?= $payment['id'] ?>"><?= $payment['nom_moyen_de_paiment'] ?></option>
                    <?php endforeach; ?>
                    <!-- ---------------------------------------------------------------------------- -->
                </select>
                <label for="id_moyen_de_paiement" class="input__label">Moyen de paiement</label>
            </label>
            <button class="btn btn--inverted" type="submit">Créer</button>
        </form>
    </main>
</body>

</html>