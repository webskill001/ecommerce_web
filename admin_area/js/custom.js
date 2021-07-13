jQuery('#forminsertuser').on('submit',function(e){
    e.preventDefault();
    jQuery.ajax({
        url:'register_login.php',
        type:'POST',
        data:jQuery('#forminsertuser').serialize(),
        success:function(result){
            var data=jQuery.parseJSON(result);
            if(data.status=="error"){
                jQuery('#'+data.field).html(data.message);
                jQuery('#'+data.field).html("");
            }else if(data.status1=="error1"){
                jQuery('#'+data.field1).html(data.message1);
            }
            if(data==arr1){
                jQuery('#error_password').html("print");
            }
            
        }

    });
    
});

function orderStatus(oid){
    var order_status=jQuery('#order_status').val();
    if(order_status!=""){
        window.location.href=WEBSITE_PATH+'admin_area/index.php?oid='+oid+'&order_status='+order_status;
    }
}

function deliveryboy(oid){
    var deliveryboy=jQuery('#deliveryboy').val();
    if(deliveryboy!=""){
        window.location.href=WEBSITE_PATH+'admin_area/index.php?oid='+oid+'&deliveryboy='+deliveryboy;
    }
}
