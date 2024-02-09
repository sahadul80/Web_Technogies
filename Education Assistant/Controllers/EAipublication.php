<?php
include '../Model/EA.php';

session_start();
if(isset($_POST['publications']))
{ ?>
  Recently Published:<hr> <?php
  requestedPublication();
}
?>