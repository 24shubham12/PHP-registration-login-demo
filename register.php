<?php

session_start();

if(isset($_SESSION['user_id'])!=""){
    header("Location: index.php");
}
include_once 'dbconnect.php';

$error = false;

if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    if (!$error) {
        if(mysqli_query($con, "INSERT INTO users(name,email,password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
            $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
    }
}

?>

<html>
    <head>
        <title>Sign Up</title>
    </head>
    <body>
        <div>
            <h1>Sign Up</h1>
        </div>
        <br>
        
        <div>
            <form name="signupform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div>
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Name" required value="<?php if($error) echo $name; ?>"/>
                    <span><?php if(isset($name_error)) echo $name_error;?> </span> 
                </div>
            
                <div>
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>"/>
                    <span><?php if(isset($email_error)) echo $email_error;?> </span> 
                </div>
                
                <div>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" />
                    <span><?php if(isset($password_error)) echo $password_error;?> </span> 
                </div>
                
                <div>
                    <label>Confirm Password</label>
                    <input type="password" name="cpassword" placeholder="Confirm Password" />
                    <span><?php if(isset($cpassword_error)) echo $cpassword_error;?> </span> 
                </div>
                
                <div>
                    <input type="submit" name="signup" value="Sign Up"/>
                </div>
                
            </form>
            <span><?php if(isset($successmsg)) {echo $successmsg;} ?></span>
            <span><?php if(isset($errormsg)) {echo $errormsg;} ?></span>
            
            <div>Already registered? <a href="login.php">Login here</a></div>
            
        </div>
    </body>
</html>