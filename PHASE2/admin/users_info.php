<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../accueil.php');
    exit();    
}

$fichier = '../utilisateurs.json';
if (!file_exists($fichier)) {
    echo "<p style='color:red; text-align:center;'>Erreur.</p>";
    exit();
}

$utilisateurs = json_decode(file_get_contents($fichier), true);

$isAdmin = false;
foreach ($utilisateurs as $user) {
    if ($user['email'] === $_SESSION['email']) {
        if (isset($user['admin']) && $user['admin'] == "1") {
            $isAdmin = true;
        } else {
            header('Location: ../accueil.php');
            exit();
        }
        break;
    }
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$usersPerPage = 10;
$totalUsers = count($utilisateurs);
$totalPages = ceil($totalUsers / $usersPerPage);

// Correction si page invalide
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;

$offset = ($page - 1) * $usersPerPage;
$paginatedUsers = array_slice($utilisateurs, $offset, $usersPerPage);

function calculerAge($date_naissance) {
    if (empty($date_naissance)) return "N/A";
    
    $naissance = new DateTime($date_naissance);
    $aujourdhui = new DateTime();
    $age = $aujourdhui->diff($naissance);
    return $age->y;
}

function afficherUtilisateurs($utilisateurs) {
    $html = "";
    foreach ($utilisateurs as $index => $user) {
        $prenom = $user['prenom'] ?? '';
        $nom = $user['nom'] ?? '';
        $email = $user['email'] ?? '';
        $date_naissance = $user['date_naissance'] ?? '';
        $age = !empty($user['age']) ? $user['age'] : calculerAge($date_naissance);

        $html .= "<tr>";
        $html .= "<td>{$prenom} {$nom}</td>";
        $html .= "<td>{$age}</td>";
        $html .= "<td>{$email}</td>";
        $html .= "<td>
            <form method='POST' action='modifier_utilisateur.php' style='display:inline;'>
                <input type='hidden' name='id' value='{$index}'>
                <button type='submit' title='Modifier'>
                    <img src='../pencil.jpg' alt='Modifier' style='width:20px; height:auto; vertical-align:middle;'>
                </button>
            </form>
            <form method='POST' action='supprimer_utilisateur.php' style='display:inline;' onsubmit='return confirm(\"Supprimer cet utilisateur ?\");'>
                <input type='hidden' name='id' value='{$index}'>
                <button type='submit' title='Supprimer'>🗑️</button>
            </form>
            <form method='GET' action='voir_reservations.php' style='display:inline;'>
                <input type='hidden' name='id' value='{$index}'>
                <button type='submit' title='Voir les réservations'>📄</button>
            </form>
        </td>";
        $html .= "</tr>";
    }
    return $html;
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="../head.css">
    <link rel="stylesheet" href="users-res_info.css">

</head>
<body>
    <div class="head">
        <a href="../accueil.php"><img src="../VolcanFly.jpg" alt="Accueil"></a>
        <div class="headers">
            <ul>
                <li><a href="../accueil.php">Accueil</a></li>
                <li><a href="../reg.php">Inscription</a></li>
                <li><a href="../log.php">Connexion</a></li>
                <li><a href="../choice.php">Voyages</a></li>
                <li><a href="../aides.php">Aides</a></li>
            </ul>
        </div>
        <a href="../profile.php"><img src="../pp.jpg" alt="profile"></a>
    </div>

    <div class="table">
        <div class="side">
            <button onclick="window.location.href='../admin.php'">Dashboard</button>
            <button style="background-color: #bdbdbd7e;">Gestion des utilisateurs</button>
            <button onclick="window.location.href='reservations_info.php'">Réservations</button>
            <button onclick="window.location.href='payments_info.php'">Paiements</button>
        </div>

        <div class="Principal">
            <div class="stat-box">
                <h2>Utilisateurs</h2>
                <p>📌 <?= $totalUsers ?> inscrits (Page <?= $page ?>/<?= $totalPages ?>)</p>
            </div>

            <div class="users-tool">
                <div class="research-users">
                    <input type="text" class="search-box" placeholder="Rechercher un utilisateur...">
                    <button class="search-button">🔍</button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Nom-Prénom</th>
                            <th>Âge</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= afficherUtilisateurs($paginatedUsers) ?>
                    </tbody>
                </table>

                <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=1">« Première</a>
                        <a href="?page=<?= $page - 1 ?>">‹ Précédente</a>
                    <?php endif; ?>

                    <?php
                    $start = max(1, $page - 2);
                    $end = min($totalPages, $page + 2);
                    
                    if ($start > 1) echo '<span>...</span>';
                    for ($i = $start; $i <= $end; $i++): ?>
                        <a href="?page=<?= $i ?>" <?= $i == $page ? 'class="active"' : '' ?>><?= $i ?></a>
                    <?php endfor;
                    if ($end < $totalPages) echo '<span>...</span>';
                    ?>

                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?= $page + 1 ?>">Suivante ›</a>
                        <a href="?page=<?= $totalPages ?>">Dernière »</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="tail">
        <a href="../accueil.php"><p>Accueil</p></a>
        <p>| Destinations | Offres spéciales | Contact | À propos</p>
    </div>

    <script>
    document.querySelector('.search-box').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        document.querySelectorAll("tbody tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    });
    </script>
</body>
</html>
