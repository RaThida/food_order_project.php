<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">    
        <h1 style="color: #4b6584">Add_Food</h1>
        <br><br>
        <?php
            if (isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//Displaying Session Message
                unset ($_SESSION['add']);//Removing Session Message
            } 
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class = "tbl-full">
                <tr>
                        <td> Title: </td>
                        <td>
                            <input type = "text" name = "title" placeholder= "category title">
                        </td>
                    </tr>
                    <tr>
                        <td> Description:  </td>
                        <td>
                            <textarea name ="description" cols="30" row = "5" placeholder = "description of the food."></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td> price:  </td>
                        <td>
                        <input type = "number" name = "price" >
                    
                        </td>
                    </tr>
                    <tr>
                        <td> select image:  </td>
                        <td>
                        <input type = "file" name = "image" >
                    
                        </td>
                    </tr>
                    <tr>
                        <td> category:  </td>
                        <td>
                        <select name = "category" >
                        <?php
                            //create php code to display categoreis from database
                            //1. create sql to get all active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'"; 
                                                  
                            //executing query
                            $res = mysqli_query($conn,$sql);
                            //count rows to check whether we have categories or not 
                            $count = mysqli_num_rows($res);
                            $sn=1;
                            if ($count >0){
                                //we have category
                                while($row = mysqli_fetch_assoc($res)){
                                    //get the detail of categorie
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                         <option value = "<?php echo $id?>"><?php echo $title?></option>
                                    <?php
                                }
                            }else{
                                //we don't have category
                                ?>
                                    <option value = "0"> no category found</option>
                                <?php
                            }
                            //2. display on dropdown
                        ?>                           
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td> Featured:  </td>
                        <td>
                        <input type = "radio" name = "featured" value = "yes"> Yes
                        <input type = "radio" name = "featured" value = "no"> No
                    
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
                        <input type = "submit" name = "submit" value = "add food" class =  "btn-secondary">
                        </td>
                    </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $title = $_POST['title'];
                $_description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                //echo $price;
                if (isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "no";
                }
                if (isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "no";
                }

                if(isset($_FILES['image']['name'])){
                    $image_name= $_FILES['image']['name'];
                    if ($image_name!=""){
                        $tmp = explode('.', $image_name);
                        $ext = end($tmp);

                        $image_name = "Food_name".rand(000,999).'.'.$ext;
                        $src= $_FILES['image']['tmp_name'];
                        $dst = "../images/foods/".$image_name;
                        

                        $upload = move_uploaded_file($src, $dst);
                        if($_FILES==false){
                            $_SESSION['upload'] = "<div class = 'error'>failed to upload, please try again.</div>";

                            header('location:'.SITEURL.'admin/add_food.php');
                            die();
                        }
                    }
                    
                }else{
                    $image_name = "";
                }

                $sql1 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$_description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'";

                $res1 = mysqli_query($conn, $sql1);

                if($res1 == true){
                    $_SESSION['add'] = "<div class = 'success'> food has added.</div>";
                    header('location:'.SITEURL.'admin/manage_food.php');
                }else{
                    $_SESSION['add'] = "<div class = 'error'>food not yet add.</div>";
                    header('location: '.SITEURL.'admin/add_food.php');
                    die();
                }
            }         
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>