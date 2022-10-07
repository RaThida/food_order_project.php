<?php 
    include ('partials/menu.php');
?>
<link rel="stylesheet" href="../css/table.css">

       <!-- Menu Content Section Starts -->
        <div class="Main-Content">
        <div class="wrapper">
            <h1 style = "color:#278b86;">Manage Admin</h1>
            <br />

            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];//Displaying Session Message
                    unset($_SESSION['add']);//Removing Session Message
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];//Displaying Session Message
                    unset ($_SESSION['delete']);//Removing Session Message
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];//Displaying Session Message
                    unset ($_SESSION['update']);//Removing Session Message
                }
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];//Displaying Session Message
                    unset ($_SESSION['user-not-found']);//Removing Session Message
                }
                if(isset($_SESSION['pws-not-match']))
                {
                    echo $_SESSION['pws-not-match'];//Displaying Session Message
                    unset ($_SESSION['pws-not-match']);//Removing Session Message
                }
                if(isset($_SESSION['change-pws']))
                {
                    echo $_SESSION['change-pws'];//Displaying Session Message
                    unset ($_SESSION['change-pws']);//Removing Session Message
                }
            ?>
            <br><br><br>
            <!---Button Add Admin-->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br /> <br /> <br />
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>full_name</th>
                        <th>user_name</th>
                        <th style = "text-align:center;">action</th>
                        
                    </tr>

                    <?php 
                        //Query to set all admin
                        $slq = "SELECT * FROM tbl_admin";
                        //Execute the Query
                        $res = mysqli_query($conn,$slq);

                        //Check whether the query is execute or not
                        if($res==true)
                        {
                            //Count rows we check whether we have data in database or not
                            $count = mysqli_num_rows($res);//Function to get all the rows in database
                            $sn=1; //Create a variable and Assign value
                            //Check the num of rows
                            if($count>0)
                            {
                                //We have data in Database
                                while ($rows = mysqli_fetch_assoc($res))
                                {
                                    //Using while loop to get all data from database
                                    //And while loop will run as long as we have data in database

                                    //Get individual data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $user_name = $rows['user_name'];

                                    //Display the values in our table

                                    ?>
                                          <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $user_name; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="btn-primary">update_password</a>
                                                <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn-secondary">update_admin</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn-danger">delete_admin</a>
                                            </td>
                                        </tr>
                                    <?php

                                }
                            }
                            else
                            {
                                //We do not have data in database
                            }
                        }
                    ?>
                </table>
            <div class="clearfix"></div>
        </div>
        </div>
       <!-- Menu Content Section Ends -->

       <?php include ('partials/footer.php') ?>