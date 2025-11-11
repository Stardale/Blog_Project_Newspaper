<?php
$filepath = realpath(dirname(__FILE__));

include $filepath . "/../lib/connection.php";
include $filepath . "/../helpers/Helper.php";

session_start();
/* form submit */
$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email    = validate($_POST['email']);
    $password = $_POST['password'];



    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    } else {
        $data['email'] = $email;
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } else {
        $data['password'] = $password;
    }


    if (empty($errors)) {

        /* check email and password */
        $sql = "SELECT * FROM admin WHERE email = :email";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_OBJ);


        if ($user) {

            if (password_verify($data['password'], $user->password)) {

                $_SESSION['user_id'] = $user->id;
                $_SESSION['name'] = $user->name;
                $_SESSION['type'] = $user->type;


                if ($user->type == 'admin') {
                    $_SESSION['type'] = $user->type;
                    header('Location: dashboard.php');
                } elseif ($user->type == 'author') {
                    $_SESSION['type'] = $user->type;
                    header('Location: author/dashboard.php');
                } else {
                    header('Location:./index.php');
                }
            } else {
                $errors['password'] = 'Password is incorrect';
            }
        } else {
            $errors['email'] = 'Email is not registered';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="email" type="email" value="<?= $data['email'] ?? '' ?>" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                            <span class="text-danger"><?php echo $errors['email'] ?? ''; ?></span>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                            <span class="text-danger"><?php echo $errors['password'] ?? ''; ?></span>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>