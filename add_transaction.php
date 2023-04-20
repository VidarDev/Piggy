<!-- ============================================================================ -->
<!-- Add_transaction.php -->
<!-- ============================================================================ -->

<?php
// Vérifie que l'utilisateur est logé
session_start();
require_once 'functions.php';
check_login();

// Recupère le données du formulaire de create_transaction.php et le POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date_transaction = $_POST['date_transaction'];
    $montant = $_POST['montant'];
    $description = $_POST['description'];
    $id_categorie = $_POST['id_categorie'];
    $id_moyen_de_paiement = $_POST['id_moyen_de_paiement'];

    createTransaction($date_transaction, $montant, $description, $id_categorie, $id_moyen_de_paiement);

    // Renvoie vers index.php
    header('Location: index.php');
}
