

                                <?php
                                if(isset($_POST['remove'])) {
                                  $id = $_POST['hidden_id'];
                                  $remove_sql = "delete from market where id = '$id'";
                                  $remove_img = "delete from imgs where item_id = '$id'";
                                  $conn->query($remove_sql);
                                  $conn->query($remove_img);
                                }
                                ?>
