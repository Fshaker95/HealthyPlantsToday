<!--
	Author: Fahad Shaker
-->
<?php

session_start();


if(session_destroy()) {
	session_unset();
	 echo "logout Successfully!";
echo "<script>setTimeout(\"location.href = 'Market.php';\",1500);
</script>";

}

?>

<html>
<body>
<?php
 echo "If the page taken too long to redirect!";
?> <a href="index.php">Press Here</a>
</body>
</html>
