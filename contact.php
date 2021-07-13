<?php
include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container-fluid">
    <div class="container pt-3">
        <nav class="breadbcrumb shadow-sm">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" area-current="page">Contact Us</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card text-center">
                <div class="w-100 bg-light">
                    <h3 class="text-center">
                        Contact Form
                    </h3>
                    <p class="text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut, voluptas.</p>
                    </div>
                    <div class="card-body">
                    
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name" class="float-left">Name</label>
                            <input type="text" name="name" id="" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="float-left">Email</label>
                            <input type="email" id="" class="form-control" required validate>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="float-left">Subject</label>
                            <input type="text" name="subject" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="message" class="float-left">Message</label>
                            <textarea name="message" id="" cols="70" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-coupon"><i class="fa fa-user mr-2"></i> Send Message</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "includes/footer.php";
?>