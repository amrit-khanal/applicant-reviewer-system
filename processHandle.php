<?php
session_start();
require_once 'config/databse.php';
require_once('config/const.php');
require_once 'classes/Drugs.php';
require_once 'classes/User.php';

$drug = new Drugs();
$user = new User();

$baseUrl = BASE_URL;
$action = @$_REQUEST['action'];
switch ($action) {
  case 'login':
    $_SESSION["user_id"] = @$_REQUEST['value'];
    header("Location: $baseUrl");
    break;

  case 'SaveDrug':
    if (!$user->isLoggedIn()) {
      header('Location: login.php');
      exit;
    }
    if (isset($_POST['name'], $_POST['description'])) {
      if ($drug->saveDrug(@$_POST)) {
        $_SESSION['message'] = 'Saved successfully.';
      } else {
        $_SESSION['message'] = 'Couldnit Save.';
      }
    }
    header('Location: index.php');
    break;
  case 'accept':
    $drugID = $_POST['drugID'];
    $dataArray = [
      'drugID' => $drugID,
      'status' => 'approved'
    ];
    if ($drug->updateDrugStatus($dataArray)) {
      $_SESSION['message'] = 'Drug accepted successfully.';
    }
    break;
  case 'reject':
    $drugID = $_POST['drugID'];
    $dataArray = [
      'drugID' => $drugID,
      'status' => 'rejected',
      'rejectionNote' => @$_POST['rejectionNote']
    ];
    if ($drug->updateDrugStatus($dataArray)) {
      $_SESSION['message'] = 'Drug rejected successfully.';
    }
    break;
  default:
    break;
}
