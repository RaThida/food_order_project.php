<?php include ('frontend/partials_frontend/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <br><br>
            <?php
            
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//Displaying Session Message
                unset ($_SESSION['add']);//Removing Session Message
            } 
        ?>
            <form  action="" method = "POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>                   
                    <?php
                        $id = $_GET['food_id'];
                        $sql = "SELECT * FROM tbl_food WHERE id =$id";                           
                        $res = mysqli_query($conn,$sql);                                                                                                              
                        $row = mysqli_fetch_assoc($res);
                        $image_name = $row['image_name'];
                        $title = $row['title'];
                        $price = $row['price'];                                                                                    
                    ?>
                    <div class="food-menu-img">
                        <?php
                            if ($image_name==""){
                                //echo "image";
                                echo "<div class = 'error'>image not available.</div>";                                
                            }else{
                                //echo "no image";
                                ?>
                                <img src="<?php echo SITEURL; ?>images/foods/<?php echo $image_name?>"  width="150px" height="50px" class="img-responsive img-curve">
                                <?php
                            }                            
                        ?>                        
                    </div>                                               
                    <div class="food-menu-desc">
                        <h3><?php echo $title?></h3>
                        <input type = 'hidden' name = "food" value = "<?php echo $title; ?>">
                        <p>$<?php echo $price ?></p>
                        <input type = 'hidden' name = "price" value = "<?php echo $price;?>">                                              
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        <input type ='hidden' name = "id" value = "<?php echo $id;?>">
                       
                    </div>

                </fieldset>    
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="customer_name" placeholder="enter your name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="text" name="customer_contact" placeholder="enter your phone number" class="input-responsive" required>

                    <div class="order-label">Email address</div>
                    <input type="email" name="customer_email" placeholder="enter your email address" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="customer_address" rows="10" placeholder="enter your address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    
                </fieldset>                                                                
            </form>

            <?php
                /*date_default_timezone_set('Asia/Phnom_Penh');
                $date = date_default_timezone_get();
                $order_date = date('Y/m/d h:i a');
                echo $order_date;*/
                if(isset($_POST['submit'])){
                    
                    $id = $_POST['id'];
                    $title = $_POST['food'];
                    $price = $_POST['price'];
                    $quantity = $_POST['qty'];
                    $status ="Ordered";                 
                    $total = $price*$quantity;
                    //change the line of the timezone!
                    
                    
                    $order_date = date('Y-m-d h:i:s ');                   
                    
                    $full_name = $_POST['customer_name'];
                    $contact = $_POST['customer_contact'];
                    $email_address = $_POST['customer_email'];
                    $address = $_POST['customer_address'];
                    //echo $order_date;
                    $sql1 = "INSERT INTO tbl_order SET
                    food = '$title',
                    price = $price,
                    qty = $quantity,
                    total = $total, 
                    status  = '$status',                   
                    order_date = '$order_date',                                            
                    customer_name = '$full_name',
                    customer_contact = '$contact',
                    customer_email = '$email_address',
                    customer_address = '$address'                   
                    ";
                    //echo $sql1;
                    $res1 = mysqli_query($conn, $sql1);
                    //echo $sql1;
                    if ($res1  == True){
                        //echo "true";
                        $_SESSION['add'] = "you ordered your food";
                        header('location:'.SITEURL);
                    }else{
                        $_SESSION['error'] = "you haven't ordered your food";
                        header('location:'.SITEURL);
                    }                                                                                                                       
                }
            ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <?php include ('frontend/partials_frontend/footer.php');?>