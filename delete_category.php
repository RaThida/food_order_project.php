<?php 
    //Include Constants.php file here
    include('../config/constants.php');
    //1. get the ID of Admin to be delete
    echo $id=$_GET['id'];
    $sql2 = "SELECT * FROM tbl_category WHERE id = $id";
    $res2 = mysqli_query($conn, $sql2);
    if (isset ($_GET['id'])){
        $count2 = mysqli_num_rows($res2);
        if ($count2 == 1){
            $row = mysqli_fetch_assoc($res2);
            $image_name = $row['image_name'];
            
        }
    }else{
        header('location: '.SITEURL. 'admin/manage_category.php');
    }

    //2. Create SQL Query to delete Category
    $slq = "DELETE FROM tbl_category WHERE id=$id";

    //Execute the Query 
    $res = mysqli_query($conn,$slq);
   

    //Check whether the query execute seccessfully or not 
    if($res==true)
    {
        //Query Executed successfully
        //echo "Admin delete successfully";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        //Cureent image is available
        //Remove the image
        $remove_path = "../images/category/".$image_name;
        $remove = unlink($remove_path);
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/manage_category.php');
    }else
    {
        //echo "Fialed delete Category";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='error'>Failed to Deleted Category. Try Again Later.</div>";
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/manage_category.php');
    }

    