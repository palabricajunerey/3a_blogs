<?php
$pwedeMabisita = true;
$signup = true;
include 'header.php';

if(isset($_SESSION['logged_in'])){
    header("location: blog.php");
}

//if signup button is clicked
if (isset($_POST['register'])) {
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $email = $_POST['email'];
    $password = $_POST['password1'];
    $con_pass = $_POST['password2'];

    //check email if taken
    $check_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email->execute([$email]);
    if($check_email->rowCount() != 0){
        $warning_msg = "Email already USED!";
    }elseif ($password != $con_pass) { //check password if same
        $warning_msg = "Password do not match!";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users(first_name, last_name, email, password) VALUES(?, ?, ?, ?)";
        $register = $conn->prepare($query);
        //data binding
        $register->execute([
            $fname,
            $lname,
            $email,
            $hashed
        ]);

        $msg = "User has been regitered!";
    }
}
?>
<!-- content start -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 shadow m-4 p-3">
            <?php
            if (isset($msg)) {
                echo '
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>' . $msg . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            ';
            } elseif (isset($warning_msg)) {
                echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>' . $warning_msg . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            ';
            }
            ?>
            <form method="POST" action="signup.php">
                <div class="row mb-3">
                    <label for="fname" class="col-sm-4 col-form-label">First Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="fname" name="f_name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="lname" class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="lname" name="l_name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="Email" name="email">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pass" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="pass" name="password1">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pass2" class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="pass2" name="password2">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="register">Sign up</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.title = "Signup";
</script>
<!-- content end -->
</body>

</html>