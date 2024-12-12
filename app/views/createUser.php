<!-- app/views/createUser.php -->
<?php include 'app/views/header.php'; ?>

<div class="container mt-5">
    <h2>Ajouter un nouvel utilisateur</h2>
    <form action="/user/create" method="POST">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" name="nom" id="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" name="prenom" id="prenom" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" required>
        </div>
        <div class="form-group">
            <label for="role">Rôle</label>
            <select class="form-control" name="role" id="role" required>
                <option value="administrateur">Administrateur</option>
                <option value="superviseur">Superviseur</option>
                <option value="opérateur">Opérateur</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include 'app/views/footer.php'; ?>
