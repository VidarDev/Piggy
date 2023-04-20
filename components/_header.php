<!-- ============================================================================ -->
<!-- Header.php -->
<!-- ============================================================================ -->

<header id="header">
    <div class="logo">
        <a href="index.php"><img src="assets/img/logo.svg" alt="Logo de Piggy" aria-label="Logo de Piggy" title="Logo de Piggy"></a>
        <span>Piggy</span>
    </div>
    <!-- Indique si l'App est connecté à MySQL -->
    <div class="mysql_connexion">
        <span><?php echo $mysql_connect->getAttribute(PDO::ATTR_SERVER_VERSION) ?></span>
        <div class="indicator" style="background-color: <?= isConnectedToDatabase() ? '#1E884B' : '#ED0E0E'; ?>;"></div>
    </div>
</header>