<?php

session_start();

require_once 'config/databse.php';
require_once 'classes/Drugs.php';
require_once 'classes/User.php';

$drug = new Drugs();
$user = new User();


if (!$user->isLoggedIn()) {
  header('Location: login.php');
  exit;
}

$userType = $user->getUserType();

$drugLists = $drug->getDrugs();

include 'views/includes/header.php';
if ($userType === '0') {
  include 'views/applicant.php';
} elseif ($userType === '1') {
  include 'views/reviewer.php';
}
include 'views/includes/footer.php';
