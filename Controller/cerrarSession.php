<?php
session_start();
  

unset($_SESSION);

  session_destroy();
  
  echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
 
