<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php
    require "../classes/User.php";

    $u = new User;
    $user = $u->findUser($_GET['id']);

    ?>
    <div class="w-50 mx-auto text-center my-5">
        <i class="fa-solid fa-triangle-exclamation text-warning icon-lg"></i>
        <h1 class="h4 text-danger mt-2 mb-4">DELETE USER</h1>

        <p class="mb-3">Are you sure you want to delete user <strong><?= $user['username'] ?></strong>?</p>

        <form action="../actions/deleteUser.php" method="post">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <a href="dashboard.php" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-outline-danger">Delete</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>