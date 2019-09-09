<html>
<body>

<style>

</style>



   	 <?php

   	     if (isset($user_check)) {

   		      echo " Welcome: " . ucwords("$user_check_fname"); 	 }

   	     elseif (isset($admin_check)) {

   	         echo " Welcome: " . ucwords($admin_check) ;   }
             ?>


</body>
</html>
