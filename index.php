<?php
//Sessão
ob_start();
session_start();
date_default_timezone_set('America/Sao_Paulo');

  header("Location:login.php");
  die();
