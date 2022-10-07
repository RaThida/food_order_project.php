<?php include('partials/menu.php');?>
    <div class="main-content">
        <div class="wrapper">
            <link rel="stylesheet" href="../css/table.css">
            <h1 style="color: #4b6584"> Manage Category</h1>
            <br><br>
            <?php 
            if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];//Displaying Session Message
                    unset ($_SESSION['login']);//Removing Session Message 
                }
            if(isset($_SESSION['remove-failed']))
                {
                    echo $_SESSION['remove-failed'];//Displaying Session Message
                    unset ($_SESSION['remove-failed']);//Removing Session Message 
                }
            if(isset($_SESSION['remove-failed']))
                {
                    echo $_SESSION['update-category'];//Displaying Session Message
                    unset ($_SESSION['update-category']);//Removing Session Message 
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];//Displaying Session Message
                    unset ($_SESSION['delete']);//Removing Session Message 
                }    
            ?>
            <br/><br/>
            <a href="<?php echo SITEURL;?>admin/add_category.php" class="btn-primary">Add Category</a>
            <br/><br/>
            <table class =  "tbl-full">
                <tr>
                    <td> S.N.</td>
                    <td> Title</td>
                    <td> image</td>
                    <td> featured</td>
                    <td> active</td>
                    <td> action</td>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_category";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    //$sn=1;
                    if($count>0)
                    {
                       
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $id         = $row['id'];
                            $title      =$row['title'];
                            $image_name = $row['image_name'];
                            $featured   =$row['featured'];
                            $active     =$row['active'];
                            ?>
                            <tr>
                                <td><?php echo $id;?></td>
                                <td><?php echo $title;?></td>
                                <td>
                                <?php 
                                //Check whether the image is available or not
                                if($image_name!="")
                                {
                                //Display the Image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="150px">
                                <?php
                                }else
                                {
                                //Display the Message
                                    echo "<div class='error'>No Image added.</div>";
                                }
                                ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                         }else
                        {
                        //We don't have data in database
                        ?>
                        <tr>
                            <td colspend="6"><div class="error">No Category added.</div></td>
                        </tr>
                         <?php
                    }
                ?>
            </table>
        </div>
    </div>
<?php include('partials/footer.php');?>