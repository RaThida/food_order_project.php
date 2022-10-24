<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1> update order</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_order WHERE id = $id";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count==1){
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['qty'];
                    $order_date=$row['order_date'];
                    $status= $row['status'];
                    $full_name= $row['customer_name'];
                    $contact= $row['customer_contact'];
                    $email_address= $row['customer_email'];
                    $address= $row['customer_address'];
                }
                else
                {
                    header('location: '.SITEURL.'admin/manage_order.php');
                }
            }
            else
            {
                header('location: '.SITEURL.'admin/manage_order.php');
            }
        ?>
        <form action ="" method ="POST">
            <table class = "tbl-full">
                <tr>
                    <td>food name: </td>
                    <td><b><?php echo $title;?></b></td>
                </tr>
                <tr>
                    <td>price: </td>
                    <td>
                        <b>$<?php echo $price;?></b>
                    </td>
                </tr>
                <tr>
                    <td>quantity:</td>
                    <td>
                        <input type = "number" name = "qty" value ="<?php echo $quantity;?>">
                    </td>
                   
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name ="status">
                            <option <?php if($status=="ordered"){ echo "selected";}?>value = "ordered">ordered</option>
                            <option  <?php if($status=="on delivery"){ echo "selected";}?> value = "on delivery">on delivery</option>
                            <option  <?php if($status=="delivered"){ echo "selected";}?> value = "delivered">delivered</option>
                            <option <?php if($status=="cancel order"){ echo "selected";}?> value = "cancel order">cancel order</option>
                        </select>    
                    </td>
                </tr>
                <tr>
                    <td>customer_name:</td>
                    <td>
                        <input type = "text" name = "customer_name" value ="<?php echo $full_name;?>">
                    </td>
                   
                </tr>
                <tr>
                    <td>customer_contact:</td>
                    <td>
                        <input type = "text" name = "customer_contact" value ="<?php echo $contact;?>">
                    </td>
                   
                </tr>
                <tr>
                    <td>customer_email:</td>
                    <td>
                        <input type = "text" name = "customer_email" value ="<?php echo  $email_address;?>">
                    </td>
                   
                </tr>
                <tr>
                    <td>customer_address:</td>
                    <td>
                        <textarea name = "customer_address" cols ="30" rows="5"><?php echo  $address;?> </textarea>
                    </td>
                   
                </tr>
                
            </table>
            <tr>
                    <td clospan ="2">
                        <input type = "hidden" name = "id" value= "<?php echo $id?>">
                        <input type = "hidden" name = "price" value= "<?php echo $price?>">
                        <input type="submit" name="submit" value="Update order" class="btn-secondary">
                    </td>
                
                </tr>
        </form>
        <?php
        if(isset($_POST['submit'])){
            //echo "submit";
            $id = $_POST['id'];
            $food = $title;
            $price = $_POST['price'];
            $quantity = $_POST['qty'];
            $total = $price * $quantity;

            $status = $_POST['status'];
            $full_name = $_POST['customer_name'];
            $contact = $_POST['customer_contact'];
            $email_address = $_POST['customer_email'];
            $address = $_POST['customer_address'];
            
            $sql1 = "UPDATE tbl_order SET 
            food = '$title',
            price = $price,
            qty = $quantity, 
            total = $total,
        
            status = '$status',
            customer_name = '$full_name',
            customer_contact = '$contact',
            customer_email = '$email_address',
            customer_address = '$address' WHERE id = $id";
            //echo $sql1;
            $res1 = mysqli_query($conn,$sql1);
            if($res1==true)
            {
                //4. Check whether the query executed or not data add or not
                $_SESSION['update_order'] = "<div class='success'>Category Update Successfully.</div?";
                //Redirect to Manage Category Page
                header("location:".SITEURL.'admin/manage_order.php');
            }else
            {
                //Failed to add category
                $_SESSION['update_order'] = "<div class='error'>Failed to Update Category.</div?";
                //Redirect to Manage Category Page
                header("location:".SITEURL.'admin/manage_order.php');
            }
        }
        ?>
    </div>
</div>


<?php include('partials/footer.php');?>