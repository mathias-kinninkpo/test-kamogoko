<!-- app/views/partials/header.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion d'Utilisateurs</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <header>
        <nav>
            <div class="container">
                <a href="/dashboard" class="logo">Dashboard</a>
                <ul class="nav-links">
                    <li><a href="/dashboard">Accueil</a></li>
                    <li><a href="/users">Utilisateurs</a></li>
                    <li><a href="/settings">Paramètres</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="/profile">Profil</a></li>
                        <li><a href="/logout">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="/login">Connexion</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <main>
