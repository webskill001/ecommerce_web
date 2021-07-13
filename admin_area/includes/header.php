<?php
include "_constant.php";
$title="";
if(isset($_GET['dashboard'])){
    $title="Dashboard";
}
if(isset($_GET['insert_pro'])){
    $title="Insert Product";
}
if(isset($_GET['del_pro'])){
    $title="Delete Product";
}
if(isset($_GET['edit_pro'])){
    $title="Edit Product";
}
if(isset($_GET['view_prod'])){
    $title="View Product";
}
if(isset($_GET['insert_p_cat'])){
    $title="Insert Product Category";
}
if(isset($_GET['view_p_cat'])){
    $title="View Product Category";
}
if(isset($_GET['del_p_cat'])){
    $title="Delete Product Category";
}
if(isset($_GET['edit_p_cat'])){
    $title="Edit Product Category";
}
if(isset($_GET['insert_cat'])){
    $title="Insert Category";
}
if(isset($_GET['view_cat'])){
    $title="View Category";
}
if(isset($_GET['del_cat'])){
    $title="Delete Category";
    
}
if(isset($_GET['edit_cat'])){
    $title="Edit Category";

}
if(isset($_GET['insert_slider'])){
    $title="Insert Slider";

}
if(isset($_GET['view_slider'])){
    $title="View Slider";

}
if(isset($_GET['del_c'])){
    $title="Delete Slider";

}
if(isset($_GET['edit_c'])){
    $title="Edit Slider";

}
if(isset($_GET['view_customer'])){
    $title="View Customer";

}
if(isset($_GET['del_cus'])){
    $title="Delete Customer";

}
if(isset($_GET['view_order'])){
    $title="View Order";

}
if(isset($_GET['del_id'])){
    $title="Delete Order";

}
if(isset($_GET['view_pay'])){
    $title="View Payment";

}
if(isset($_GET['insert_user'])){
    $title="Insert User";

}
if(isset($_GET['view_user'])){
    $title="View User";

}
if(isset($_GET['edit_user'])){
    $title="Edit User";

}
if(isset($_GET['del_user'])){
    $title="Delete User";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title."-".WEBSITE_NAME; ?></title>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>