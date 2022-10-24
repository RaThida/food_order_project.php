<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
    <!--<link rel="stylesheet" href="../css/add-admin style.css">-->
        <h1 style="color: #4b6584"> Add Admin</h1>
        <br><br>
        <?php
                if(isset($_SESSION['exid']))
                {
                    echo $_SESSION['exid'];
                    unset($_SESSION['exid']);
                }
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <br><br>
        <div class = "tbl_header">
            <form action="" method="POST">
                <table class="tbl-full">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Input Your Name"></td>
                    </tr>

                    <tr>
                        <td>User Name:</td>
                        <td><input type="text" name="user_name" placeholder="Your User Name"></td>
                    </tr>

                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" placeholder="Your Password">
                        </td>
                    </tr>
                    <tr>
                        <td> status: </td>
                        <td>
                        <input type = "radio" name = "active" value = "yes" >Active
                        <input type = "radio" name = "inactive" value = "no" >Inactive
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
        
            </form>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
    //Process the Value from form and Save it in Databse

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        $password  = md5($_POST['password']);

        if(isset($_POST['active']))
                {
                    //Get the value from form
                    $status   = 1;
                }else
                {
                    //Set the Default value
                    $status   = 0;
                }
                //echo $status;

        $sql1 = "SELECT * FROM tbl_admin WHERE user_name = '$user_name'";

        //$sql ="SELECT * FROM tbl_admin WHERE user_name='$user_name' AND password='$password' AND status=1"; 

        $res1 = mysqli_query($conn,$sql1);
        $count1 = mysqli_num_rows($res1);
       if ($count1 ==1){
            $_SESSION['exid'] = "<div class='error'>user exid, please try again with another username.</div>";
            header('location: '.SITEURL.'admin/add-admin.php');
            die();
        }    
        else
        {
        //Button Clicke
         //SQL Queury to save the data into database
         $slq = "INSERT INTO tbl_admin SET 
                full_name = '$full_name',
                user_name  = '$user_name',
                password  = '$password',
                status = $status
         ";
        //3. Executing Query and Saving Data into Database
         $res = mysqli_query($conn,$slq) or die(mysqli_error());
         //4. Check whether the (Query is Executed) data is inserted or not and display appropriate massege
         if($res==TRUE)
         {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to display message
            $_SESSION['add'] = "Admin Added Successfully";
            //Redirect Page To Manage Admin
            header("location:".SITEURL.'admin/manage_admin.php');
            //echo "Submit successfilly";
         }else{
            //Failed to Insert Data
            //echo "Faile to Inserte Data";
                //Create a Session Variable to display message
                $_SESSION['add'] = "Failed to Add Admin";
                //Redirect Page To Add Admin
                header("location:".SITEURL.'admin/add-admin.php');
         }
        }
        
    }
?>