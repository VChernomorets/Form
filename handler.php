<?php
include 'application/validation.php';
// We start form validation
formValidation($_POST);
header("Location: index.php");