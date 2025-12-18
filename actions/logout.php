<?php
setcookie("usuario","",time()-3600,"/");
header("location: ../pages/login.php");
exit();
?>
