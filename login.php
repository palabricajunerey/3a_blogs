<?php
$pwedeMabisita = true;
$login = true;
include 'header.php';
if(isset($_SESSION['logged_in'])){
    header("location: blog.php");
}

//if sign in is clicked
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //query to DB
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    //binding
    $check->execute([$email]);

    foreach ($check as $value) {
        if (password_verify($password, $value['password']) && $email == $value['email']) {
            //session variable
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $value['user_id'];

            header("location: blog.php");
        } else {
            $warning_msg = "Email and Password do not match or Incorrect password!";
        }
    }
}
?>
<!-- content start -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 shadow m-4 p-3">
            <?php
            if (isset($warning_msg)) {
                echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>' . $warning_msg . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            ';
            }
            ?>
            <form method="POST" action="login.php">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Sign in</button>
            </form>
        </div>
    </div>
</div>



<script>
    document.title = "Login";
</script>
<!-- content end -->
</body>

</html>