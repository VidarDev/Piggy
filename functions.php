<!-- ============================================================================ -->
<!-- Functions.php -->
<!-- ============================================================================ -->

<?php

// Importe la fonction de connection à MySQL
require_once 'config.php';

// ----------------------------------------------------------------------------
// Fonction pour vérifier que l'utilisateur est connecté
function check_login()
{
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit;
    }
}

// ----------------------------------------------------------------------------
// Fonction pour créer une catégorie
function createCategory($nom_categorie, $id_type_comptable)
{
    global $mysql_connect;
    // Insertion du formulaire dans la table "categories"
    $sql = "INSERT INTO `categories` (`nom_categorie`, `id_type_comptable`) VALUES (?, ?)";
    $stmt = $mysql_connect->prepare($sql);
    $stmt->execute([$nom_categorie, $id_type_comptable]);
}

// ----------------------------------------------------------------------------
// Fonction pour créer une transaction
function createTransaction($date_transaction, $montant, $description, $id_categorie, $id_moyen_de_paiement)
{
    global $mysql_connect;
    // Insertion du formulaire dans la table "transaction"
    $sql = "INSERT INTO `transaction` (`date_transaction`, `montant`, `description`, `id_categorie`, `id_moyen_de_paiement`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysql_connect->prepare($sql);
    $stmt->execute([$date_transaction, $montant, $description, $id_categorie, $id_moyen_de_paiement]);
}

// ----------------------------------------------------------------------------
// Fonction pour delete une transaction
function deleteTransaction($id)
{
    global $mysql_connect;
    $sql = "DELETE FROM `transaction` WHERE `id` = ?";
    $stmt = $mysql_connect->prepare($sql);
    $stmt->execute([$id]);
}

// ----------------------------------------------------------------------------
// Fonction pour calculer et return le montant total des dépenses
function getTotalAmount()
{
    global $mysql_connect;
    $sql = "SELECT SUM(CASE WHEN tc.coefficient >= 0 THEN t.montant * tc.coefficient ELSE 0 END) as positive_amount,
            SUM(CASE WHEN tc.coefficient < 0 THEN t.montant * tc.coefficient ELSE 0 END) as negative_amount,
            SUM(CASE WHEN tc.coefficient < 0 THEN t.montant * tc.coefficient ELSE 0 END) + SUM(CASE WHEN tc.coefficient >= 0 THEN t.montant * tc.coefficient ELSE 0 END) as total_amount
            FROM `transaction` t
            JOIN `categories` c ON t.id_categorie = c.id
            JOIN `type_comptable` tc ON c.id_type_comptable = tc.id";
    $stmt = $mysql_connect->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// ----------------------------------------------------------------------------
// Fonction pour return une transaction par ID
function getTransactionById($id)
{
    global $mysql_connect;
    $sql = "SELECT * FROM `transaction` WHERE `id` = ?";
    $stmt = $mysql_connect->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// ----------------------------------------------------------------------------
// Fonction pour return les détails d'une transaction par ID
function getTransactionDetailsById($transaction_id)
{
    global $mysql_connect;
    $sql = "SELECT t.id, t.date_transaction, t.montant, t.description, c.nom_categorie, m.nom_moyen_de_paiment
            FROM `transaction` t
            JOIN `categories` c ON t.id_categorie = c.id
            JOIN `moyen_de_paiement` m ON t.id_moyen_de_paiement = m.id
            WHERE t.id = :transaction_id";
    $stmt = $mysql_connect->prepare($sql);
    $stmt->bindParam(':transaction_id', $transaction_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// ----------------------------------------------------------------------------
// Fonction pour lister les transactions
function listTransactions()
{
    global $mysql_connect;
    // selection de la table "transaction" avec une jointure avec les tables "categories", "moyen_de_paiement", "type_comptable"
    $sql = "SELECT t.id, t.date_transaction, t.montant, t.description, t.id_categorie, c.nom_categorie, m.nom_moyen_de_paiment, c.id_type_comptable
            FROM `transaction` t
            JOIN `categories` c ON t.id_categorie = c.id
            JOIN `moyen_de_paiement` m ON t.id_moyen_de_paiement = m.id
            JOIN `type_comptable` tc ON c.id_type_comptable = tc.id";
    $stmt = $mysql_connect->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ----------------------------------------------------------------------------
// Fonction pour lister les éléments de la table "categories"
function listCategories()
{
    global $mysql_connect;
    // selection de la table "catégories" 
    $sql = "SELECT c.id, c.nom_categorie, c.id_type_comptable
            FROM `categories` c ";
    $stmt = $mysql_connect->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ----------------------------------------------------------------------------
// Fonction pour lister les éléments de la table "moyen_de_paiement"
function listPayements()
{
    global $mysql_connect;
    // selection de la table "moyen_de_paiement" 
    $sql = "SELECT m.id, m.nom_moyen_de_paiment
            FROM `moyen_de_paiement` m";
    $stmt = $mysql_connect->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ----------------------------------------------------------------------------
// Fonction pour lister les éléments de la table "type_comptable"
function listTypeComptables()
{
    global $mysql_connect;
    // selection de la table "type_comptable" 
    $sql = "SELECT tc.id, tc.nom_type_comptable
            FROM `type_comptable` tc ";
    $stmt = $mysql_connect->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ----------------------------------------------------------------------------
// Fonction pour créer un transaction
function updateTransaction($id, $date_transaction, $montant, $description, $id_categorie, $id_moyen_de_paiement)
{
    global $mysql_connect;
    $sql = "UPDATE `transaction` SET `date_transaction` = ?, `montant` = ?, `description` = ?, `id_categorie` = ?, `id_moyen_de_paiement` = ? WHERE `id` = ?";
    $stmt = $mysql_connect->prepare($sql);
    $stmt->execute([$date_transaction, $montant, $description, $id_categorie, $id_moyen_de_paiement, $id]);
}

// ----------------------------------------------------------------------------
// Fonction pour vérifier que la MySQL est connecté
function isConnectedToDatabase()
{
    global $mysql_connect;
    return $mysql_connect !== null;
}
