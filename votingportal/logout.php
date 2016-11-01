<?php
   session_start();
   unset($_SESSION["valid"]);
   unset($_SESSION["cnic"]);
   unset($_SESSION["pkey"]);
   
   header('Location: ../');
?>