<!-- ============================================================================ -->
<!-- Config.php -->
<!-- ============================================================================ -->

<?php
// Variables pour se connnecter à MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SP_Comptable";
$port = 3307;

try {
    $mysql_connect = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $mysql_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
