
<style>
#f_pic {
   width: 100%;
   background-position: 50% 50%;
   background-repeat: no-repeat;
   background-size: cover;
   border-radius: 25px 25px 0px 0px;
}




#item_pic_array {
   width: 20%;
   background-position: 50% 50%;
   background-repeat: no-repeat;
   background-size: cover;
}

</style>


<?php
// First Image
$itemID = $row['id'];
$retriv_img = "SELECT * FROM imgs where '$itemID' = item_id";
$result_img = $conn->query($retriv_img);
$row_img = $result_img-> fetch_assoc();
$pic = "Item_img/" . $row_img['value'];
?>
<div class="form-group">
   <a href= "<?php echo $pic;?> " > <img class="" src="<?php echo $pic ; ?>" id="f_pic" > <a/>

   </a/>
</div>



<div id="array_box">
<!-- Rest of the item Imges -->
<?php
// get the element Id associate with the Imges from the current loop
$itemID = $row['id'];
$retriv_img = "SELECT * FROM imgs where '$itemID' = item_id";
$result_img = $conn->query($retriv_img);
while ($row_img = $result_img-> fetch_assoc()) {

  //img path & name
   $pic = "Item_img/" . $row_img['value']
?>

<a href= "<?php echo $pic;?> " > <img class="" src="<?php echo $pic ; ?>" id="item_pic_array" > </a>

<?php
}
?>
</div>
