<?php include ('partials/menu.php');?>

        <?php
                $id = $_GET['id'];
                $sql2 = "SELECT * FROM tbl_food WHERE id = $id";
                $res2 = mysqli_query($conn, $sql2);
                if (isset ($_GET['id'])){
                    $count2 = mysqli_num_rows($res2);
                    if ($count2 == 1){
                        $row = mysqli_fetch_assoc($res2);
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                }else{
                    header('location: '.SITEURL. 'admin/manage_food.php');
                }
        ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>

        <br><br>

    <form action="" method="POST" enctype="multipart/form-data">
        <table class = "tbl-full" >
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                    <?php 
                        if($image_name=="")
                        {
                            //Image not available
                            echo "<div class'error'>Image not Available.</div>";
                        }else
                        {
                             //Image available
                            ?>
                            <img src="<?php SITEURL;?>images/category<?php echo $image_name?>" alt="<?php echo $title ?>" width="150px" height="50px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                 <td> price:  </td>
                <td>
                    <input type = "number" name = "price" >
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "Checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No"){echo "Checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($featured=="No"){echo "Checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <Input type="hidden" name="id" value="<?php echo $id ?>">
                    <Input type="hidden" name="current_image" value="<?php echo $image_name ?>">
                    <input type="submit" name="submit" value="Update" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                //Update the food in  database

                //1. Get the data from form
                $title = $_POST['title'];
                $current_image =$_POST['current_image'];
                $featured = $_POST['featured'];
                $active   = $_POST['active'];

                //1. For radio input, we check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Get the value from form
                    $featured = $_POST['featured'];
                }else
                {
                    //Set the Default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    //Get the value from form
                    $active   = $_POST['active'];
                }else
                {
                    //Set the Default value
                    $active   = "No";
                }
                //2. Upload the image if select
                //Check whether the image select or not and set the value for image accoridingly
                    $choose_image = $_FILES['image']['name'];
                    if($choose_image!=""){
                        if($image_name!=""){
                            $tmp = explode('.', $image_name);
                            $ext = end($tmp);
                        }else{
                            $tmp = explode('.', $choose_image);
                            $ext = end($tmp);
                        }
                        
                        $image_name = "Food_name".rand(000,999).'.'.$ext;
                        $source_path= $_FILES['image']['tmp_name'];
                        $destination="../images/foods/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination);
                        if ($upload == false){
                            $_SESSION['upload']= "<div class = 'error'>failed to upload</div>";
                            header('location:'.SITEURL.'admin/manage_food.php' );
                            die();
                        }
                        if($current_image!="")
                        {
                            //Cureent image is available
                            //Remove the image
                            $remove_path = "../images/foods/".$current_image;
                            $remove =unlink($remove_path);
                            //Check whether the image removed or not
                            if($remove==false)
                            {
                                //Failed to remove current image
                                $_SESSION['remove_failed'] = "<div class='error'>Failed to remove current image.</div>";
                                //Redirect to manage-food
                                header('location:'.SITEURL.'admin/manage_food.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                        //echo $image_name;
                    }
                    //Insert into database
                    $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    
                    image_name  = '$image_name',
                    
                    featured = '$featured',
                    active   = '$active'
                    WHERE id=$id
                    ";
                    //3. Execute Query
                    $res3 = mysqli_query($conn,$sql3);
                    if($res3==true)
                    {
                        //4. Check whether the query executed or not data add or not
                        $_SESSION['update_food'] = "<div class='success'>Category Update Successfully.</div?";
                        //Redirect to Manage Category Page
                        header("location:".SITEURL.'admin/manage_food.php');
                    }else
                    {
                        //Failed to add category
                        $_SESSION['update_food'] = "<div class='error'>Failed to Update Category.</div?";
                        //Redirect to Manage Category Page
                        header("location:".SITEURL.'admin/manage_food.php');
                    }
                        //print_r($_FILES['image']);
                        //die();//Break the code here
            }
        ?>
    </div>
</div>

<?php include ('partials/footer.php');?>