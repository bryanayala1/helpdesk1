<!DOCTYPE html>
<html>

<head>
    <title>Helpdesk Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center mb-3">Helpdesk Login</h4>

                        <form method="POST" action="auth/login.php">
                            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                            <button class="btn btn-primary w-100">Login</button>
                        </form>

                        <a href="auth/register.php" class="btn btn-link text-center w-100">
                            Create Account
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>