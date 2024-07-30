<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="mb-4">Welcome <?php echo $_SESSION['name']; ?></h4>
                            <p>Your id is: <?php echo $_SESSION['id']; ?></p>
                            <p>Your phone is: <?php echo $_SESSION['phone']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
