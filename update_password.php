
<?php include('partials/menu.php');?>

<div class ="main-content">
    <div class ="wrapper">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!--change or update password-->
        <h1 style = " color:#278b86;"> update password</h1>
        <?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        ?>
        <form method = "POST" action = "" enctype = "multipart/form-data">
            <div class = "form-group">
                <label for = "current_password"> current password: </label>
                <input type = "password" name = "current_password" class = "form-control"
                        id = "current_password" placeholder = "current password">
            </div>
            <div class = "form-group">
                <label for = new_password>new password: </label>
                <input type = " password" name = "new_password" class = "form-control"
                        id = "new_password" placeholder = "new password">
            </div>
            <div class = "form-group">
                <label for = "confirm_password"> password: </lable>
                <input type = "password" name = "confirm_password" class = "form-control"
                        id = " confirm_password" placeholder = "confirm_password">
            </div>
            <input type = "hidden" name = "id" value = "<?php echo $id;?>">
            <button type = "submit" name = "submit" vllue = "change password" class = "btn-secondary">
                change_password</button><br/>
        </form>
        <?php
            if (isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);
                $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";
                $res = mysqli_query($conn, $sql);
                if ($res == true)
                {
                    $count = mysqli_num_rows($res);
                    if ($count == 1)
                    {
                        if ($new_password ==$confirm_password)
                        {
                            $sql2 = mysqli_query($conn, $sql2);
                            if ($res == true)
                            {
                                $_SESSION['change-pws'] = "<div class='success'>Password Changed Succesfully.</div>";
                                header("location:".SITEURL.'admin/manage_admin.php');
                            }else
                            {
                                $_SESSION['change-pws'] = "<div class='error'>Failed to Change Password.</div>";
                                header("location:".SITEURL.'admin/manage_admin.php');
                            }
                        }else
                        {
                            $_SESSION['pws-not-match'] = "<div class='error'>Password did not match.</div>";
                            header("location:".SITEURL.'admin/manage_admin.php');
                        }
                    }else
                    {
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
                        header("location:".SITEURL.'admin/manage_admin.php'); 
                    }
                }else
                {
                    $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
                    header("location:".SITEURL.'admin/manage_admin.php');
                }
            }
               
            
        ?>
     </div>
</div>
<?php include('partials/footer.php');?>