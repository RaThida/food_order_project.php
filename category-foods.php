<?php include ('frontend/partials_frontend/menu.php');?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"Category"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                //Getting Foods from Database that are active and featured
                //SQL Query
                $sql2 ="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' ";

                //Execute Query 
                $res2 = mysqli_query($conn, $sql2);
                //Count Rows
                  $count2 = mysqli_num_rows($res2);
                //Check whether food available or not
                  if($count2>0)
                  {
                    //Food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //Get all the value
                        $id = $row['id'];
                        $title=$row['title'];
                        $price = $row['price'];
                        $description=$row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                //Check whether image available or not
                                if($image_name=="")
                                {
                                    //image not available
                                    echo "<div class='error'>Image not available.</div>";
                                }else
                                {
                                    //Image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/foods/<?php echo $image_name; ?>" alt="Chicke Hawain Momo" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title ?></h4>
                                    <p class="food-price">$<?php echo $price ?></p>
                                    <p class="food-detail">
                                        <?php echo $description ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                  }else
                  {
                    //Food not available
                    echo "<div class='error'>Food not available.</div>";
                  }

            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

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