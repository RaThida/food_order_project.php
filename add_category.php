<?php include ('partials/menu.php');?>
    <div class="main-content">
        <div class="wrapper">
            <h1 style="color: #4b6584">Add_Category</h1>
            <br><br>
            
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class = "tbl-full">
                    <tr>
                        <td> Title: </td>
                        <td>
                            <input type = "text" name = "title" placeholder= "category title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image" id="image">
                        </td>
                    </tr>
                    <tr>
                        <td> Feature: </td>
                        <td>
                            <input type = "radio" name = "featured" value = "yes" >Yes
                            <input type = "radio" name = "featured" value = "no" >No
                        </td>
                    </tr>
                    <tr>
                        <td> Active: </td>
                        <td>
                        <input type = "radio" name = "active" value = "yes" >Yes
                        <input type = "radio" name = "active" value = "no" >No
                        </td>
                    </tr>
                    <tr>
                        <td colspan = "2">
                        <input type = "submit" name = "submit" value = "add category" class =  "btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
            //Check whether the submit button clicked or not

            if(isset($_POST['submit']))
            {
                //Echo "Button Clicked";
                //Get the Data from Category form
                $title = $_POST['title'];
                //echo "submit";
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
                //Check whether the image select or not and set the value for image accoridingly
                //print_r($_FILES['image']);
                //die();//Break the code here
                $choose_image = $_FILES['image']['name'];
                if($choose_image!="")
                {
                    //echo $choose_image;
                    //Upload the image
                    $image_name = $_FILES['image']['name'];
                    //Auto Rename image 
                    //Get the extention if our image (jpg,png,gif,etc) e.g "Special.food.jpg"
                    $tmp = explode('.', $image_name);
                    $ext = end($tmp);
                    //Rename the image
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext;//e.g Food_Category_832.jpg

                    $source_path= $_FILES['image']['tmp_name'];
                    $destination="../images/category/".$image_name;

                    //Finally upload image
                    $upload = move_uploaded_file($source_path,$destination);
                    //Check whether the image upload or not
                    //And if the image is not upload then we will stop the proccess and redirect with the error message
                    if($_FILES==false)
                    {
                        //Set message
                        $_SESSION['upload'] ="<div class='error'>Fialed to upload Image.</div>";
                        header('lacation:'.SITEURL.'admin/add_category.php');
                        //Stop the proccess
                        die();
                    }
                }else
                {
                    $image_name = "";
                    //echo "not choose!";
                }
                //2. Create SQL Query to insert Category into Database
                $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active   = '$active'
                ";
                //3. Execute Query
                $res = mysqli_query($conn,$sql);

                if($res==true)
                {
                    //4. Check whether the query executed or not data add or not
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div?";
                    //Redirect to Manage Category Page
                    header("location:".SITEURL.'admin/manage_category.php');
                }else
                {
                    //Failed to add category
                    $_SESSION['add'] = "<div class='error'>Failed to add Category.</div?";
                    //Redirect to Manage Category Page
                    header("location:".SITEURL.'admin/add_category.php');
                }
            }
        ?>
        </div>
    </div>
<?php include ('partials/footer.php');?>