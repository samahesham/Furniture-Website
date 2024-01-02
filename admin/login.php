<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Furniture Admin | Login/Register</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <?php
    try {
      require("database.php");
      $db = new DB();
      $db->get_connection();
      $error = [];
      if (isset($_POST["submit"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $data = $db->select('*', 'users', "username='$username'");
        $user = $data->fetch(PDO::FETCH_ASSOC);
        if ($user) {
          if ($user["password"] == $password) {
            session_start();
            $_SESSION['usern'] = $fullname;
            // echo $_SESSION['usern'];
            header("Location:addUser.php");
          } else {
            $error['passErr'] = "This password doesn't match";
          }
        } else {
          $error["userErr"] = "This username doesn't match";
        }
      }
    } catch (PDOException $errors) {
      echo $errors;
    }
    ?>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" name="username" />
                            <span style="color: red;"><?php
                                        if (isset($error['userErr'])) {
                                          echo $error["userErr"];
                                        }
                                        ?></span>
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" name="password" />
                            <span style="color: red;"><?php
                                        if (isset($error['passErr'])) {
                                          echo $error["passErr"];
                                        }
                                        ?></span>
                        </div>
                        <div>
                            <!-- <a class="btn btn-default submit" href="index.php">Log in</a> -->
                            <input class="btn btn-default submit" type="Submit" name="submit" value="Log in">
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">New to site?
                                <a href="#signup" class="to_register"> Create Account </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-graduation-cap"></i></i> Furniture Admin</h1>
                                <p>©2016 All Rights Reserved. Furniture Admin is a Bootstrap 4 template. Privacy and
                                    Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

            <?php
      try {
        // require("database.php");
        // $db = new DB();
        // $db->get_connection();
        if (isset($_POST["submit"])) {
          $fullname = $_POST['fullname'];
          $username = $_POST['username'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $uppercase = preg_match('@[A-Z]@', $password);
          $lowercase = preg_match('@[a-z]@', $password);
          $number    = preg_match('@[0-9]@', $password);
          $specialChars = preg_match('@[^\w]@', $password);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['emailErr'] = "Please enter a valid email";
          } else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $error['passErr'] =  'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
          } else {
            // session_start();
            $_SESSION['usern'] = $fullname;
            // echo $_SESSION['usern'];
            $db->insert('users', "fullname,username,email,password,regDate", "'$fullname','$username','$email','$password',NOW()");
          }
        }
      } catch (PDOException $errors) {
        echo $errors;
      }
      ?>
            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form method="POST" autocomplete="on">
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Fullname" name="fullname" />
                        </div>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" name="username" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" name="email" />
                            <p><?php if (isset($error['emailErr'])) {
                    echo $error['emailErr'];
                  } ?></p>
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" name="password" />
                            <p><?php if (isset($error['passErr'])) {
                    echo $error['passErr'];
                  } ?></p>
                        </div>
                        <div>
                            <!---Submit Button------>
                            <div>
                                <input class="btn btn-default submit" type="Submit" name="submit" value="SUBMIT">
                            </div>
                            <!---Submit Button----->
                            <!-- <a class="btn btn-default submit" href="index.php" name="submit">Submit</a> -->
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member ?
                                <a href="#signin" class="to_register"> Log in </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-graduation-cap"></i></i> Furniture Admin</h1>
                                <p>©2016 All Rights Reserved. Furniture Admin is a Bootstrap 4 template. Privacy and
                                    Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
