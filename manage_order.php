<?php include('partials/menu.php');?>
<div class = "main-content">
    <div class = "wrapper">
        <h1>Manage order<h1>
        <br><br>
   
        <table class = "tbl-full">
        <tr>
            <td> S.N.</td>
            <td> food</td>
            <td> price</td>
            <td> qty</td>
            <td> total</td>
            <td> order_date</td>
            <td> status</td>
            <td> customer_name</td>
            <td> customer_contact</td>
            <td> customer_email</td>
            <td> customer_address</td>
            <td>action</td>
        </tr>
        <?php
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC ";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn=1;
            if ($count>0){
                //echo "submit!";
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status= $row['status'];
                    $full_name= $row['customer_name'];
                    $contact= $row['customer_contact'];
                    $email_address= $row['customer_email'];
                    $address= $row['customer_address'];
                    ?>
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td> <?php echo $title;?></td>
                            <td> <?php echo $price;?></td>
                            <td> <?php echo $quantity;?></td>
                            <td> <?php echo $total;?></td>
                            <td> <?php echo $order_date;?></td>
                            <td> <?php echo $status;?></td>
                            <td> <?php echo $full_name;?></td>
                            <td> <?php echo $contact;?></td>
                            <td> <?php echo $email_address;?></td>
                            <td> <?php echo$address;?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update_order.php?id=<?php echo $id; ?>" class="btn-secondary">Update order</a>                                   
                            </td>
                           
                            
                        </tr>
                    <?php
                }
            }else{
                ?>
                    <tr>
                        <td colspend="7"><div class="error">no ordered.</div></td>
                    </tr>
                <?php
            }
        ?>
        </table>
    </div>
</div>
<?php include('partials/footer.php');?>