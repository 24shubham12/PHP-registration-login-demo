<?php
session_start();

if(isset($_SESSION['user_id'])!="") {
    header("Location : index.php");
}
include_once 'dbconnect.php';

if (isset($_POST['login'])) {
    
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    $query = "SELECT * FROM users where email='".$email."' and password='".md5($password)."'"; 
    $result = mysqli_query($con, $query);
    
    $row = mysqli_fetch_array($result);
    
    if($row){
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        header("Location: index.php");
    }
    else{
        $errormsg = "Invalid email or password";
    }
}
?>

<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <div>
            <h1>Login</h1>
        </div>
        <br>
        <div>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="loginform" method="post" >
                <div>
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Email" />
                </div>
                
                <div>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password"/>
                </div>
                    
                <div>
                    <input type="submit" name="login" value="Login" />
                </div>
                <span><?php if(isset($errormsg)) {echo $errormsg; } ?></span>
                    
            </form>
            
            <div>New user? <a href="register.php">Sign Up Here</a></div>
        </div>
    </body>
    
</html>


