<!-- ============================================================================ -->
<!-- Get_transaction_details.php -->
<!-- ============================================================================ -->

<?php

// Vérifie que l'utilisateur est logé
session_start();
require_once 'config.php';
require_once 'functions.php';
check_login();

if (isset($_GET['id'])) {
    $transaction_id = $_GET['id'];
    $transaction = getTransactionDetailsById($transaction_id);

    if ($transaction) {
        // Affichez les détails de la transaction ici
        echo "ID: " . $transaction['id'] . "<br>";
        echo "Date: " . $transaction['date_transaction'] . "<br>";
        echo "Montant: " . $transaction['montant'] . " €<br>";
        echo "Description: " . $transaction['description'] . "<br>";
        echo "Catégorie: " . $transaction['nom_categorie'] . "<br>";
        echo "Moyen de paiement: " . $transaction['nom_moyen_de_paiment'] . "<br>";
    } else {
        echo "Transaction introuvable.";
    }
} else {
    echo "Erreur : ID de transaction manquant.";
}
