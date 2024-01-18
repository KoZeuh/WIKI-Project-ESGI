<!-- Templates/admin/index.php -->

<?php ob_start();
$pageTitle = "ADMIN | Utilisateurs" ?>

<script>
    function openModal($id) {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
</script>

<div class="flex">
    <h1>Utilisateurs</h1>
</div>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Email</th>
        <th scope="col">Username</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Role</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <form method="POST" action="/user/edit/<?= $user->getId() ?>">
                <td><?= $user->getId() ?></td>
                <td><input name="email" id="email" value="<?= $user->getEmail() ?>"></td>
                <td><input name="username" id="username" value="<?= $user->getUsername() ?>"></td>
                <td><input name="firstname" id="firstname" value="<?= $user->getFirstname() ?>"></td>
                <td><input name="lastname" id="lastname" value="<?= $user->getLastname() ?>"></td>
                <td>
                    <select name="role" id="role">
                        <option value="ROLE_USER" <?php if ($user->getRole() === 'ROLE_USER') echo 'selected' ?>>
                            Utilisateur
                        </option>
                        <option value="ROLE_ADMIN" <?php if ($user->getRole() === 'ROLE_ADMIN') echo 'selected' ?>>
                            Administrateur
                        </option>
                    </select>
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <a href="/user/delete/<?= $user->getId() ?>"
                       class="btn btn-danger">Supprimer</a>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); ?>

<?php include './App/Templates/admin/base.php'; ?>
