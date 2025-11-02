<?php 

    define('TITLE', "Abdul Rakeeb's Amazing Dining | Login");
    include('header_2.php');

    $error = '';

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        include('database.php');

        if(empty($username) || empty($password)) {
            $error = "Please fill in the required fields.";
        } else{
            $conn = new mysqli ($servername, $dbusername, $dbpassword, $dbname);

            $stmt = $conn->prepare("SELECT * FROM account_info WHERE username = ?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if(password_verify($password, $user['password'])) {
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    header('Location: home.php');
                    exit;
                } else {
                    $error = 'Incorrect username or password.';
                }
            } else {
                $error = "Account doesn't exist.";
            }

            $stmt->close();
            $conn->close();
        }
    }

?>

<br><br><br>


<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card tables" style="width: 20rem;">
                <h2><b>Log In</b></h2><br>
                <form method="post" action="">
                    <div class="text-start">
                        <label for="username" class="form-label"><b>Username</b></label>
                        <input name="username" id="username" type="text" class="form-control" placeholder="Enter your username">
                    </div><br>
                    <div class="text-start">
                        <label for="password" class="form-label"><b>Password</b></label>
                        <input name="password" id="password" type="password" class="form-control" placeholder="Enter your password">
                    </div><br>
                    <button class="btn btn-success w-100 mb-3" type="submit" name="submit">Submit</button>
                </form>
                <a href="signup.php">Don't have an account? Create one!</a>
                <?php if (!empty($error)) { ?>
                <div class="p-3 text-center" style="color:red;">
                    <b><?php echo $error; ?></b>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div><br><br><br>

<?php 

    include('footer.php')

?>