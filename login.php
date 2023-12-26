<?php
session_start();
if (isset($_SESSION['id']))
    header('location:workstatusAuthority.php');

// print_r($_POST);
$errors = "";

// var_dump($_POST);

if (isset($_POST['submit'])) {
    if (isset($_POST['username']) and !empty($_POST['username']))
        $username = $_POST['username'];
    else
        $errors .= "Error: Please enter a valid username";

    if (isset($_POST['password']) && !empty($_POST['password']))
        $password = md5($_POST['password']);
    else
        $errors .= "Error: Empty password not accepted.<br>";

    if (!empty($errors))
        die($errors);

     $sql = "SELECT * FROM employee WHERE username = '$username' AND password = '$password'";
    include('db.php');
    $result = $conn->query($sql);
    // var_dump($result);
    if ($result->num_rows > 0) {
        session_start();
        while ( $row = $result->fetch_assoc() ){
            $_SESSION['id'] = $row['id'];
            header('workstatusAuthority.php');
        }
       
        exit();
    } else {
        // var_dump($result);
    }

    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row" style="padding-top: 60px; display:flex;justify-content:center;">
            <div class="col-md-5">
                <div class="card border-secondary">
                    <div class="card-header" style="display: flex; justify-content:center;">
                        <!-- <p class="lead text-primary text-center">Login</p> -->
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <!--id-->
                                <div class="row">
                                    <div class="col-4">
                                        <label for="emp_id">Username</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="username">
                                    </div>
                                </div>
                                <br>

                                <!--password-->
                                <div class="row">
                                    <div class="col-4">
                                        <label for="password">Password </label>
                                    </div>
                                    <div class="col-8">
                                        <input type="password" class="form-control"  name="password" >
                                    </div>
                                </div>
                                <br>

                                <!-- Buttons -->
                                <div class="row">
                                    <div class="col-md-2 col-sm-4 offset-5  ">
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit" value="submit">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


</body>

</html>