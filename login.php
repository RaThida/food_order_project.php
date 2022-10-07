<?php include ('../config/constants.php');?>
<html>
    <header>
        <title>Login</title>
        

    </header>
    <body>
        <div class ="login">
            <h1 class = "text-center" > Login</h1>
            <link rel="stylesheet" href="../css/login_style.css">
            <br><br>
            <?php 
               if (isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];//Displaying Session Message
                    unset ($_SESSION['no-login-message']);
                }
                if(isset($_SESSION['user']))
                {
                    echo $_SESSION['user'];//Displaying Session Message
                    unset ($_SESSION['user']);//Removing Session Message
                }
            ?>
            <br><br>
            <div class="wrapper">
                <div class="logo">
                    
                </div>
                <div class="text-center mt-4 name">
                    Login
                </div>
                <form class="p-3 mt-3" method="POST">
                    <div class="form-field d-flex align-items-center">
                        <span class="far fa-user"></span>
                        <input type="text" name="user_name"  placeholder="Username">
                    </div>
                    <div class="form-field d-flex align-items-center">
                        <span class="fas fa-key"></span>
                        <input type="password" name="password"  placeholder="Password">
                        
                    </div>
                   
                    <button class="btn mt-3" name = "submit">Login</button>
                </form>
                <br><br>
                <p class="text-center">Create By - <a href="#">IT TEAM</a></p>
                <?php 
    //Check whether the submit button clicked or not
    if(isset($_POST['submit']))
    {
        //Process the login
        //1. Get the Data from login form
         $user_name = $_POST['user_name'];
         $password = md5($_POST['password']);
        
        //2. SQL to check whether the user with username and password exists or not
       $sql ="SELECT * FROM tbl_admin WHERE user_name='$user_name' AND password='$password'";

        //$sql ="SELECT user_name,password,  status  FROM tbl_admin WHERE username='$username' AND password='$password' AND status=$status";
        //3. Execute the Query
        $res= mysqli_query($conn,$sql);

        //Count the rows to check whether the user axists or not
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //User Available and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successfully.</div>";
            $_SESSION['user']  = $user_name; //To check whether the user is logged in or not and will logout unset it

            //Redirect to Home Page.Dashboard
            header('location:'.SITEURL.'admin/');
        }else
        {
            //User Not Available and ligin Failed
            $_SESSION['login'] = "<div class='error text-center'>Username or password did not match.</div>";
            //Redirect to Login Page Again
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>
            </div>
        </div>
    </body>
</html>

