<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php
        session_start();
        include_once "nav.php";

        require "../classes/User.php";
        $u = new User;
        $user = $u->findUser($_SESSION['id']);
    ?>
    <div class="container">
        <div class="card w-50 mx-auto my-5">
            <div class="card-header">
                <div class="row align-items-center gx-3">
                    <div class="col-3">
                        <!-- photo -->
                        <?php if($user['photo']){ ?>
                            <img src="../assets/images/photos/<?= $user['photo'] ?>" alt="user's photo" class="photo-lg">
                        <?php }else{ ?>
                            <i class="fa-solid fa-user text-secondary icon-lg"></i>
                        <?php } ?>
                    </div>
                    <div class="col">
                        <form action="../actions/uploadPhoto.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="photo" id="photo" class="w-auto form-control form-control-sm">
                            <button type="submit" class="btn btn-sm mt-2 btn-outline-secondary">Upload Photo</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h2 class="h3"><?= $_SESSION['full_name'] ?></h2>
                <h3 class="h4"><?= $_SESSION['username'] ?></h3>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>