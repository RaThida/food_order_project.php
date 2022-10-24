<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1 style = "color:#278b86;">Update Admin</h1>

        <?php 
            //1. Get the ID of Select Admin
            $id=$_GET['id'];

            //2. Create SQL Query to get the detail
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($conn,$sql);

            //Check whether the Query Execute ot not
            if($res==true)
            {
                //Check whether the data available or not
                $count=mysqli_num_rows($res);
                //Check whether we have data admin ot not
                if($count==1)
                {
                    //Get the detail
                    //echo "Admin available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name=$row['full_name'];
                    $username=$row['user_name'];

                }else
                {
                    //Redirect to Manage Admin Page
                    header('lacation:'.SITEURL.'admin/manage_admin.php');
                }
            }
        ?>

        <form action = "" method ="POST">
            <table class = "tbl-full">
                <tr>
                    <td>full name:</td>
                    <td>
                        <input type = "text" name = "full_name" value = "<?php echo $full_name; ?>">
                    </td>

                </tr>

                <tr>
                    <td> user name:</td>
                    <td><input type = "text" name = "user_name" value = "<?php echo $username; ?>" ></td>

                </tr>

                <tr>
                    <td colspan = "2">
                        <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                        <input type = "submit" name = "submit" value = "update admin" class = "btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php');?>

<?php
        if (isset($_POST['submit']))
        {
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $user_name = $_POST['user_name'];
            $sql = "UPDATE tbl_admin SET
                    full_name = '$full_name', user_name = '$user_name' WHERE id = '$id'";
            $res = mysqli_query($conn, $sql);
            if ($res == true)
            {
                $_SESSION['update'] = "<div class = 'success'> admin updated successfully.</div>";
                header("location: ".SITEURL. 'admin/manage_admin.php');
            }else{

            }
        }
?>