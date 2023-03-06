<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Tanmay Food Order System</title>

        <!--Stylesheet only for login -->
        <style>

*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: black;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}


form{
    height: 550px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
.login-click{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}


/* CSS for login success msg  */
.success {
  color: rgb(44, 165, 33);
  font-weight: 600;
}

/* CSS for login fail msg  */
.error {
  color: rgb(255, 10, 10);
  font-weight: 600;
}

.text-center {
  text-align: center;
  clear: none;
}


    </style>

</head>

    <body>
        
        <div>


            <!-- Login Form  -->
            <form action="" method="POST">

                <h2 class="text-center">Food Order Website</h2>
                <h3>Login Here</h3>

                <!-- session to display login msg -->
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }

                    // session msg present in login-check.php
                    if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                ?>
                <br>
    

                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter Username">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Password">

                <input type="submit" name="submit" value="Log In now" class="login-click">
                <br><br>

                <br><br>
                <!-- <p class="text-center">Developed By - Tanmay Chavan</p> -->
            </form>
            <!-- Login Form End -->

            
            

        </div>

    </body>
</html>


<?php 

    //Check whether the Submit Button is Clicked or Not
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        // old queries 
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        // after SQL INJECTION
        //to covert whole input in a string
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)  // i.e there atleast one user
        {
            //User Available and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";

            //To check whether the user is logged in or not and logout will unset it
            $_SESSION['user'] = $username; 

            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not Available and Login Fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //Redirect to HOme Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }


    }

?>