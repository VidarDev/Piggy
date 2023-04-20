<!-- ============================================================================ -->
<!-- Add_category.php -->
<!-- ============================================================================ -->

<?php

// Vérifie que l'utilisateur est logé
session_start();
require_once 'functions.php';
check_login();

// Recupère le données du formulaire de create_category.php et le POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_categorie = $_POST['nom_categorie'];
    $id_type_comptable = $_POST['id_type_comptable'];

    createCategory($nom_categorie, $id_type_comptable);

    // Renvoie vers list_categories.php
    header('Location: list_categories.php');
}
