<!-- ============================================================================ -->
<!-- Edit_transaction.php -->
<!-- ============================================================================ -->

<?php

// Vérifie que l'utilisateur est logé
session_start();
require_once 'functions.php';
check_login();

// Variables pour les listes de categories et de moyens de payements
$categories = listCategories();
$payments = listPayements();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $transaction = getTransactionById($id);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $date_transaction = $_POST['date_transaction'];
    $montant = $_POST['montant'];
    $description = $_POST['description'];
    $id_categorie = $_POST['id_categorie'];
    $id_moyen_de_paiement = $_POST['id_moyen_de_paiement'];

    updateTransaction($id, $date_transaction, $montant, $description, $id_categorie, $id_moyen_de_paiement);

    // Renvoie vers index.php
    header('Location: index.php');
}
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
        <h1>Modifier la transaction</h1>
        <form action="edit_transaction.php" method="post">
            <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
            <label class="input input--inverted">
                <input type="datetime-local" class="input__field" name="date_transaction" id="date_transaction" placeholder=" " value="<?= $transaction['date_transaction'] ?>" required>
                <label for="date_transaction" class="input__label">Date</label>
            </label>
            <label class="input input--inverted">
                <input type="number" class="input__field" name="montant" id="montant" step="1" placeholder=" " min="1" value="<?= $transaction['montant'] ?>" required>
                <label for="montant" class="input__label">Montant</label>
            </label>
            <label class="input input--inverted">
                <input type="text" class="input__field" name="description" id="description" placeholder=" " value="<?= $transaction['description'] ?>" required>
                <label for="description" class="input__label">Description</label>
            </label>
            <label class="input input--inverted">
                <select name="id_categorie" class="input__field" id="id_categorie" required>
                    <option value="">-- Choisir une catégtorie --</option>
                    <!-- ---------------------------------------------------------------------------- -->
                    <!-- Foreach pour lister les catégories -->
                    <?php foreach ($categories as $category) : ?>
                        <option <?= $transaction['id_categorie'] ==  $category['id'] ? 'selected="selected"' : '' ?> value="<?= $category['id'] ?>"><?= $category['nom_categorie'] ?></option>
                    <?php endforeach; ?>
                    <!-- ---------------------------------------------------------------------------- -->
                </select>
                <label for="id_categorie" class="input__label">Catégorie</label>
            </label>
            <label class="input input--inverted">
                <select name="id_moyen_de_paiement" class="input__field" id="id_moyen_de_paiement" required>
                    <option value="">-- Choisir un moyen de paiement --</option>
                    <!-- ---------------------------------------------------------------------------- -->
                    <!--  Foreach pour lister les moyens de payements -->
                    <?php foreach ($payments as $payment) : ?>
                        <option <?= $transaction['id_moyen_de_paiement'] ==  $payment['id'] ? 'selected="selected"' : '' ?> value="<?= $payment['id'] ?>"><?= $payment['nom_moyen_de_paiment'] ?></option>
                    <?php endforeach; ?>
                    <!-- ---------------------------------------------------------------------------- -->
                </select>
                <label for="id_moyen_de_paiement" class="input__label">Moyen de paiement</label>
            </label>
            <button class="btn btn--inverted" type="submit">Mettre à jour</button>
        </form>
    </main>
</body>

</html>