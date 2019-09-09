<style>


#item_pic_array {
  display: block;
   width: 50%;
   background-position: 50% 50%;
   background-repeat: no-repeat;
   background-size: cover;
   border-radius: 25px 25px 0px 0px;
}

</style>





<div id="array_box">
<?php
$itemID = $row['id'];
$retriv_img = "SELECT * FROM imgs where '$itemID' = item_id";
$result_img = $conn->query($retriv_img);
while ($row_img = $result_img-> fetch_assoc()) {

  //img path & name
   $pic = "Item_img/" . $row_img['value']
?>

<a href= "<?php echo $pic;?> " >  </a>

<?php
}
?>
</div>
