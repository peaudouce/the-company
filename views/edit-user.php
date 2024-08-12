<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php
        session_start();
        include_once "nav.php";

        require "../classes/User.php";

        $u = new User;

        $id = $_GET['id'];

        $user = $u->findUser($id); //calling findUser method in User.php with id as argument

    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <form action="../actions/updateUser.php" method="post">
                    <h2 class="display-6 text-center mb-3">EDIT USER</h2>

                    <input type="hidden" name="id" value="<?= $user['id'] ?>">

                    <label for="first-name" class="form-label">First Name</label>
                    <input type="text" name="first_name" value="<?= $user['first_name'] ?>" id="first-name" class="form-control mb-2">

                    <label for="last-name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" value="<?=$user['last_name']?>" id="last-name" class="form-control mb-2">

                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" value="<?= $user['username'] ?>" id="username" class="form-control mb-3">

                    <button type="submit" class="btn btn-warning">Save</button>
                    <a href="dashboard.php" class="btn btn-secondary ms-1">Cancel</a>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>