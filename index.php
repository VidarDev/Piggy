<!-- ============================================================================ -->
<!-- List_transactions.php / Index.php -->
<!-- ============================================================================ -->

<?php
// Vérifie que l'utilisateur est logé
session_start();
require_once 'functions.php';
check_login();

// Variables
$transactions = listTransactions();
$amounts = getTotalAmount();
$total_expenses = $amounts['total_amount'];
$positive_expenses = $amounts['positive_amount'];
$negative_expenses = $amounts['negative_amount'];
$max_budget = 1500;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>

<body class="list">
    <!-- ---------------------------------------------------------------------------- -->
    <!-- Recupère le header -->
    <?php require_once './components/_header.php'; ?>
    <!-- ---------------------------------------------------------------------------- -->
    <nav id="navbar">
        <a href="./create_transaction.php" tabindex="1"><img src="assets/img/plus.svg" alt="Ajouter une transaction" aria-label="Ajouter une transaction" title="Ajouter une transaction" /></a>
        <ul class="nav__list">
            <li class="nav__item">
                <a href="./list_categories.php">Catégories</a>
            </li>
            <li class="nav__item">
                <a href="./index.php">Transactions</a>
            </li>
        </ul>
    </nav>

    <main class="container">
        <h1>Liste des transactions</h1>
        <div class="card card--accent">
            <h2>Limites des dépenses:</h2>
            <p class="<?= ($total_expenses >= 0 && $total_expenses < $max_budget) ? 'positive-amount' : 'negative-amount'; ?>"><strong><?= $total_expenses ?> / <?= $max_budget ?> €</strong></p>
        </div>
        <!-- ---------------------------------------------------------------------------- -->
        <!-- Affiche les transactions -->
        <?php foreach ($transactions as $transaction) : ?>
            <div class="card-transaction card">
                <!-- ---------------------------------------------------------------------------- -->
                <!-- Foreach pour afficher une image en fonction de la catégorie choisie -->
                <img src="
                    <?php
                    switch (intval($transaction['id_categorie'])) {
                        case 1:
                            echo "assets/img/category_1.svg";
                            break;
                        case 2:
                            echo "assets/img/category_2.svg";
                            break;
                        case 3:
                            echo "assets/img/category_3.svg";
                            break;
                        default:
                            echo "assets/img/category_4.svg";
                    }
                    ?>
                " alt="Transaction: <?= $transaction['description'] ?>" aria-label="Transaction: <?= $transaction['description'] ?>" title="Transaction: <?= $transaction['description'] ?>" />
                <!-- ---------------------------------------------------------------------------- -->
                <div class="right">
                    <div class="right-top">
                        <!-- ---------------------------------------------------------------------------- -->
                        <!-- Transforme la date de transaction mysql en DD/MM/YYYY -->
                        <?php
                        $dateTransaction = substr($transaction['date_transaction'], 0, -9);
                        $newDateTransaction = str_replace('-', '/', date("d-m-Y", strtotime($dateTransaction)))
                        ?>
                        <!-- ---------------------------------------------------------------------------- -->
                        <div class="description">
                            <h3><?= $transaction['description'] ?></h3><span><?= $newDateTransaction ?></span>
                        </div>
                        <div class="price"><span class="<?= $transaction['id_type_comptable'] == 1 ? 'positive-amount' : 'negative-amount'; ?>"><?= $transaction['id_type_comptable'] == 1 ? $transaction['montant'] : '-' . $transaction['montant'] ?> €</span><span><?= $transaction['nom_moyen_de_paiment'] ?></span></div>
                    </div>
                    <div class="actions">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#transactionDetailsModal" data-transaction-id="<?= $transaction['id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path d="M21.92 11.6C19.9 6.91 16.1 4 12 4s-7.9 2.91-9.92 7.6a1 1 0 0 0 0 .8C4.1 17.09 7.9 20 12 20s7.9-2.91 9.92-7.6a1 1 0 0 0 0-.8ZM12 18c-3.17 0-6.17-2.29-7.9-6C5.83 8.29 8.83 6 12 6s6.17 2.29 7.9 6c-1.73 3.71-4.73 6-7.9 6Zm0-10a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm0 6a2 2 0 1 1 0-4 2 2 0 0 1 0 4Z" />
                            </svg></button>
                        <form action="edit_transaction.php" method="get">
                            <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
                            <button type="submit" class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path d="M22 7.24a.999.999 0 0 0-.29-.71l-4.24-4.24a.999.999 0 0 0-.71-.29 1 1 0 0 0-.71.29l-2.83 2.83L2.29 16.05a1.001 1.001 0 0 0-.29.71V21a1 1 0 0 0 1 1h4.24a1.001 1.001 0 0 0 .76-.29l10.87-10.93L21.71 8c.091-.097.166-.208.22-.33.01-.08.01-.16 0-.24a.697.697 0 0 0 0-.14l.07-.05ZM6.83 20H4v-2.83l9.93-9.93 2.83 2.83L6.83 20ZM18.17 8.66l-2.83-2.83 1.42-1.41 2.82 2.82-1.41 1.42Z" />
                                </svg></button>
                        </form>
                        <form action="delete_transaction.php" method="post">
                            <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
                            <button type="submit" class="btn" onclick="return confirm('Voulez-vous vraiment supprimer cette transaction ?')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 1 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4V5Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10v11Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z" />
                                </svg></button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- ---------------------------------------------------------------------------- -->
    </main>
    <div class="modal fade" id="transactionDetailsModal" tabindex="-1" aria-labelledby="transactionDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog card">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="transactionDetailsModalLabel">Détails de la transaction</h4>
                </div>
                <div class="modal-body">
                    <!-- Les détails de la transaction seront chargés ici -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------------------------------------------------------------------------- -->
    <!-- Recupère le footer -->
    <?php require_once './components/_footer.php'; ?>
    <!-- ---------------------------------------------------------------------------- -->

    <!-- ---------------------------------------------------------------------------- -->
    <!-- Script de la modal Bootstrap -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const transactionDetailsModal = document.getElementById('transactionDetailsModal');

            transactionDetailsModal.addEventListener('show.bs.modal', async function(event) {
                const button = event.relatedTarget;
                const transactionId = button.getAttribute('data-transaction-id');

                const response = await fetch('get_transaction_details.php?id=' + transactionId);
                const transactionDetails = await response.text();

                const modalBody = transactionDetailsModal.querySelector('.modal-body');
                modalBody.innerHTML = transactionDetails;
            });
        });
    </script>
    <!-- ---------------------------------------------------------------------------- -->
</body>

</html>