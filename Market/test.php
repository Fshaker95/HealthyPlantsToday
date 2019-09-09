<!DOCTYPE html>

<!--

   Author: fahad shaker

-->

<html>
<body>

<style>
#logout_box {
  display: flex;
  position: absolute;
  background: red;
  width: 50px;
  height: 50px;

}



</style>


      <div id="logout_box">

		 </div>

</body>
</html>

<p><button onclick="myMove()">Click Me</button></p>


<script>
function myMove() {
  var elem = document.getElementById("logout_box");
  var pos = 0;
  var id = setInterval(frame, 5);
  function frame() {
    if (pos == 350) {
      clearInterval(id);
    } else {
      pos++;
      elem.style.right = pos + "px";
    }
  }
}
</script>
