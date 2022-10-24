<?php
    include('../config/constants.php');
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
  
   if($id!="" && $image_name!=""){
      

        if ($image_name!=""){
           
             $path = "../images/foods/".$image_name;

             $remove = unlink($path);
            if($remove==false)
             {
                 //Failed to remove image
                 $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
                 //Redirect to manage food
                 header('location:'.SITEURL.'admin/manage_food.php');
                 die();
             }
             
        }
        
    }
   
    $slq = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn,$slq);
        if($res==true)
        {
            //Query Executed successfully
            //echo "Admin delete successfully";
            //Create Session Variable to Display Message
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
            //Redirect to Manage Category
           header('location:'.SITEURL.'admin/manage_food.php');
        }else{
            //echo "Fialed delete Category";
            //Create Session Variable to Display Message
            $_SESSION['delete'] = "<div class='error'>Failed to Deleted Food. Try Again Later.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage_food.php');
        }
    
   
    
?>