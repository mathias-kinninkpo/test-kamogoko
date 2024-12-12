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
                    <li><a href="/naissance">Actes de naissances</a></li>
                    <li><a href="/deces">Actes de décès</a></li>
                    <li><a href="/mariage">Actes de Mariage</a></li>
                    <li><a href="/arrondissement">Arrondissement</a></li>
                    <?php if  (isset($_SESSION['user_id'])): ?>
                        <li><a href="/login">Connexion</a></li>
                       
                    <?php else: ?>
                        <li><a href="/profile">Profil</a></li>
                        <li><a href="/logout">Déconnexion</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <main>

        <div class="container mt-5">
            <h2>Gestion des utilisateurs</h2>
            <a href="/create_user" class="btn btn-primary mb-3">Ajouter un nouvel utilisateur</a>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id_utilisateur']; ?></td>
                        <td><?php echo $user['nom']; ?></td>
                        <td><?php echo $user['prenom']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['rôle']; ?></td>
                        <td>
                            <a href="/user/edit/<?php echo $user['id_utilisateur']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="/user/delete/<?php echo $user['id_utilisateur']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <!-- app/views/partials/footer.php -->
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Gestion d'Utilisateurs - Tous droits réservés.</p>
            <ul>
                <li><a href="/terms">Conditions d'utilisation</a></li>
                <li><a href="/privacy">Politique de confidentialité</a></li>
            </ul>
        </div>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
