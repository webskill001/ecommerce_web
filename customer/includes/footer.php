<footer class="bg-light">
    <div class="container p-4 pb-2">
        <div class="row">
            <div class="col col-md-3">

                <ul style="list-style:none;text-transform:Capitalize;">
                    <h5>pages</h5>
                    <li><a href="../cart.php" class="text-dark text-muted" style="text-transform:Capitalize;">shopping cart</a>
                    </li>
                    <li><a href="../contact.php" class="text-dark text-muted" style="text-transform:Capitalize;">contact us</a></li>
                    <li><a href="../shop.php" class="text-dark text-muted" style="text-transform:Capitalize;">shop</a></li>
                    <li><a href="myaccount.php" class="text-dark text-muted" style="text-transform:Capitalize;">my account</a></li>
                </ul>
                <ul style="list-style:none;text-transform:Capitalize;">
                    <h5>user section</h5>
                    <?php
                if(isset($_SESSION['username'])){
                    echo '<a href="../logout.php" class="text-dark text-muted">Logout</a>';
                }else{
                    echo '<a href="../login.php" class="text-dark text-muted">Login</a>';
                }
                ?>
                    <li><a href="../register.php" class="text-muted text-dark">register</a></li>
                </ul>
            </div>
            <div class="col col-md-3">
                <ul style="list-style:none;text-transform:Capitalize;">
                    <h5>top product categories</h5>
                    <?php
                    $get_p_cat="select * from product_categories";
                    $res=mysqli_query($conn,$get_p_cat);
                    if(mysqli_num_rows($res))
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $p_cat_id=$row['product_cat_id'];
                            $p_cat_name=$row['product_cat_name'];
                            echo '<li><a href="../shop.php?p_cat='.$p_cat_id.'" class="text-dark text-muted" style="text-transform:Capitalize;">'.$p_cat_name.'</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col col-md-3">
                <ul style="list-style:none;text-transform:Capitalize;">
                    <h5>where to find us</h5>
                    <li class="text-dark" style="text-transform:Capitalize;"><a href="<?php echo WEBSITE_PATH; ?>" class="text-dark"><strong>localhost.com</strong></a></li>
                    <li class="text-dark" style="text-transform:Capitalize;">ahmdabad</li>
                    <li class="text-dark" style="text-transform:Capitalize;">uttar pradash</li>
                    <li class="text-dark" style="text-transform:Capitalize;">example@gmail.com</li>
                    <li class="text-dark" style="text-transform:Capitalize;">+91-9823329823</li>
                </ul>
                <a href="contact.php" style="text-transform:Capitalize;" class="ml-4">go to contact us page</a>
            </div>
            <div class="col col-md-3">
                <ul style="list-style:none;text-transform:Capitalize;">
                    <h5>get the news</h5>

                    <li class="text-dark" style="text-transform:Capitalize;">subscribe here for getting news of our city
                    </li>
                    <li class="text-dark" style="text-transform:Capitalize;">
                        <form class="input-form my-2 my-lg-0">
                            <input class="form-control mr-sm-2 mb-2" required type="subscribe" aria-label="subscribe">
                            <button class="btn my-2 my-sm-0 mr-2 btn-sm btn-outline-danger"
                                type="submit">subscribe</button>
                        </form>
                    </li>

                </ul>
                <ul style="list-style:none;text-transform:Capitalize;">
                    <h5>stay in touch</h5>
                    <li><a href="<?php echo FACEBOOK; ?>" class="text-dark text-muted float-left" style="text-transform:Capitalize;"><i class="fa fa-facebook bg-primary text-center rounded-circle text-white p-2 ml-1" style="width:32px;height:32px;"></i></a></li>
                    <li><a href="<?php echo INSTAGRAM; ?>" class="text-dark text-muted float-left" style="text-transform:Capitalize;"><i class="fa fa-instagram bg-danger text-center rounded-circle text-light p-2 ml-1" style="width:32px;height:32px;"></i></a></li>
                    <li><a href="<?php echo TWITTER; ?>" class="text-dark text-muted float-left" style="text-transform:Capitalize;"><i class="fa fa-twitter bg-primary text-center rounded-circle text-light p-2 ml-1" style="width:32px;height:32px;"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright text-center" style="background-color:rgb(241, 236, 236);">
        <div class="container p-2">
            <span class="text-dark" style="text-transform:Capitalize;">&copy; all rights reserved | <a href="<?php echo WEBSITE_PATH; ?>">localhost.com</a></span>
        </div>
    </div>
</footer>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="https://use.fontawesome.com/37bfff5a04.js"></script>


</body>

</html>