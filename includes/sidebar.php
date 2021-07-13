<div class="list-group mb-3" style="border-bottom:1px solid #EBE6E6;">
    <h5 class="list-group-item mb-0" style="font-weight:500;background-color:rgb(235, 230, 230);">
        Farmer Products</h5>
    <div style="height:197px;overflow-y:auto;">
    <?php
        $get_p_cat="select * from product_categories";
        $res=mysqli_query($conn,$get_p_cat);
        if(mysqli_num_rows($res))
        {
             while($row=mysqli_fetch_assoc($res))
             {
                $p_cat_id=$row['product_cat_id'];
                $p_cat_name=$row['product_cat_name'];
                $isselected="";
                if(in_array($p_cat_id,$idarr)){
                    $isselected="checked";
                }
                ?>
                <p class="list-group-item form-group mb-0">
                    <input type="checkbox" style="cursor:pointer;" <?php echo $isselected; ?> name="pro_cat" onclick="pro_category(<?php echo $p_cat_id; ?>)" class="form-check float-left mr-2 align-middle mt-1"><?php echo ucwords($p_cat_name); ?>
                </p>
                <?php
             }
        }
    ?>
    </div>
</div>

<div class="list-group mb-3" style="border-bottom:1px solid #EBE6E6;">
    <h5 class="list-group-item mb-0" style="font-weight:500;background-color:rgb(235, 230, 230);border-bottom:0px;">
        Tribal Products</h5>
        <div style="height:197px;overflow-y:auto;">
    <?php
        $get_cat="select * from categories";
        $res=mysqli_query($conn,$get_cat);
        if(mysqli_num_rows($res))
        {
            $i=1;
             while($row=mysqli_fetch_assoc($res))
             {
                $iscselected="";
                $cat_id=$row['cat_id'];
                $cat_name=$row['cat_name'];
                if(in_array($cat_id,$cidarr)){
                    $iscselected="checked";
                }
                ?>
                <p class="list-group-item form-group mb-0">
                    <input type="checkbox" <?php echo $iscselected; ?> name="p_cat_id" onclick="category(<?php echo $cat_id; ?>)" class="form-check float-left mr-2 align-middle mt-1" id="catid<?php echo $i; ?>"><?php echo ucwords($cat_name); ?>
                </p>
                <?php
             $i++;}
        }
        else{
                echo '<h5 class="list-group-item">No any categories available in the database.</h5>';
        }
    ?>
    </div>
</div>
<form method="get" id="formprocat">
        <input type="hidden" name="p_cat" id="p_cat" value="<?php echo $id; ?>" />
        <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cid; ?>" />
</form>

<script>
function pro_category(pid){
    var p_cat=jQuery('#p_cat').val();
    var check=p_cat.search(":"+pid);
    if(check!="-1"){
        p_cat=p_cat.replace(":"+pid,"");
    }else{
        p_cat=p_cat+":"+pid;
    }
    jQuery('#p_cat').val(p_cat);
    jQuery('#formprocat')[0].submit();
}
function category(id){
    var cat_id=jQuery('#cat_id').val();
    var check=cat_id.search(":"+id);
    if(check!="-1"){
        cat_id=cat_id.replace(":"+id,"");
    }else{
        cat_id=cat_id+":"+id;
    }
    jQuery('#cat_id').val(cat_id);
    jQuery('#formprocat')[0].submit();
}
</script>