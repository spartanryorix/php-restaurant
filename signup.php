<?php 

    define('TITLE', "Abdul Rakeeb's Amazing Dining | Sign Up");
    include('header_2.php');

    $accountExists = '';

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        include('database.php');

        $conn = new mysqli ($servername, $dbusername, $dbpassword, $dbname);

        $stmt = $conn->prepare("SELECT * FROM account_info WHERE username = ? OR email = ?");
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $accountExists = 'Account already exists.';
        } else {
            $stmt = $conn->prepare("INSERT INTO account_info (username, email, password, role) VALUES (?, ?, ?, 'customer')");
            $stmt->bind_param('sss', $username, $email, $password);
            if($stmt->execute()) {
                $_SESSION['account_created'] = true; 
                header('Location: login.php');
                exit;
            }

        }
        $stmt->close();
        $conn->close();
    }

?>

<br><br><br>


<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card tables" style="width: 20rem;">
                <h2><b>Sign Up</b></h2><br>
                <form method="post" action="">
                    <div class="text-start">
                        <label for="username" class="form-label"><b>Username</b></label>
                        <input name="username" id="username" type="text" class="form-control" placeholder="Enter your username" required>
                    </div><br>
                    <div class="text-start">
                        <label for="email" class="form-label"><b>Email</b></label>
                        <input name="email" id="email" type="email" class="form-control" placeholder="Enter your email" required>
                    </div><br>
                    <div class="text-start">
                        <label for="password" class="form-label"><b>Password</b></label>
                        <input name="password" id="password" type="password" class="form-control" placeholder="Enter your password" required>
                    </div><br>
                    <button class="btn btn-success w-100 mb-3" type="submit" name="submit">Create your account!</button>
                </form>
                <a href="login.php">Already have an account? Log in here!</a>
                <?php if (!empty($accountExists)) { ?>
                <div class="p-3 text-center" style="color:green;">
                    <b><?php echo $accountExists; ?></b>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div><br><br><br>

<?php 

    include('footer.php')

?>