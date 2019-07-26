<?php
include 'application/validation.php';
include 'application/config.php';

// We start form validation
formValidation($_POST);
header("Location: index.php");