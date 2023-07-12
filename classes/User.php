<?php
class User
{
  private $connection;

  public function __construct()
  {
    global $connection;
    $this->connection = $connection;
  }

  public function isLoggedIn()
  {
    return isset($_SESSION['user_id']);
  }

  public function getUserType()
  {
    $userId = $_SESSION['user_id'];
    $sql = "SELECT type FROM tbl_users WHERE id = $userId";
    $result = $this->connection->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row['type'];
    }

    return null;
  }

  public function login($email, $password)
  {
    $email = $this->connection->real_escape_string($email);
    $password = $this->connection->real_escape_string($password);
    $password = md5($password);

    $query = "SELECT id FROM tbl_users WHERE email = '$email' AND password = '$password'";
    $result = $this->connection->query($query);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION['user_id'] = $row['id'];
      return true;
    } else {
      return false;
    }
  }

  public function logout()
  {
    unset($_SESSION['user_id']);
    session_destroy();
    return true;
  }
}
