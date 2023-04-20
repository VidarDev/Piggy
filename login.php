<!-- ============================================================================ -->
<!-- Login.php -->
<!-- ============================================================================ -->

<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Identifiants pour se connecter à l'App
    $username = "admin";
    $password = "admin";

    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        $_SESSION['loggedin'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect";
    }
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
    <title>Piggy - Connection</title>
</head>

<body class="login">
    <main class="card card--inverted container">
        <img src="assets/img/logo.svg" alt="" />
        <h1>Connection</h1>
        <!-- ---------------------------------------------------------------------------- -->
        <!-- Si les données rentrées dans le formulaire sont fausses alors afficher le message d'erreur   -->
        <?php if (isset($error_message)) : ?>
            <p style="color: #ED0E0E;"><?= $error_message ?></p>
        <?php endif; ?>
        <!-- ---------------------------------------------------------------------------- -->
        <form action="login.php" method="post">
            <label class="input input--inverted">
                <input type="text" class="input__field" name="username" id="username" placeholder=" " required>
                <span for="username" class="input__label">Nom d'utilisateur</span>
            </label>
            <label class="input input--inverted">
                <input type="password" class="input__field" name="password" id="password" placeholder=" " required>
                <span for="password" class="input__label">Mot de passe</span>
            </label>
            <button class="btn btn--inverted" type="submit">Connection</button>
        </form>
    </main>
</body>

</html>