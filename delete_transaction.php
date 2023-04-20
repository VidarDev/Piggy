<!-- ============================================================================ -->
<!-- Delete_transaction.php -->
<!-- ============================================================================ -->

<?php

// Vérifie que l'utilisateur est logé
session_start();
require_once 'functions.php';
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    deleteTransaction($id);

    // Renvoie vers index.php
    header('Location: index.php');
}
