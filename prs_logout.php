<?php
if (!isset($_SESSION)) {
  session_start();
}
session_destroy();
$_SESSION[PREFIJO.'user'] = NULL;
$_SESSION[PREFIJO.'iduser'] = NULL;
header("Location:".URL."login/");
exit();
?>