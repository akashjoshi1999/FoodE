<?php
    session_start();
    if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
        header("Location: admin_product.php");
    }
?>

<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN Login</title>
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="css/style_login.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        
                        <h3 class="heading">Admin</h3>
                        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    require "config.php";
    if(isset($_POST['login'])){
        if(empty($_POST['email']) || empty($_POST['password'])){
            echo '<div class="alert alert-danger">All Fields must be entered.</div>';
            die();
          }else{
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo '<div class="alert alert-danger">Invalid email</div>';
            } else {
                $email =  $_POST['email'];
                $password = md5($_POST['password']);
                $sql = "SELECT password FROM user WHERE email = '{$email}'";
                $result = mysqli_query($conn, $sql) or die("Query Failed.");
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $pass = $row['password'];
                        if($pass == $password){
                            session_start();
                            $_SESSION['login'] = true;
                            $_SESSION["email"] = $row['email'];
                            $_SESSION["password"] = $row['password'];
                            header("Location: admin_product.php");
                        } else {
                            echo '<div class="alert alert-danger">email and Password are not matched.</div>';
                        }
                    }
                } else{
                    echo '<div class="alert alert-danger">empty.</div>';
                }          
            }
        }
    }
?>