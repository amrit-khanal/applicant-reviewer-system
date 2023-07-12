<?php
class Drugs
{
  private $connection;

  public function __construct()
  {
    global $connection;
    $this->connection = $connection;
  }

  /**
   * @return [array]
   */
  public function getDrugs()
  {
    $sqlQuery = "SELECT * FROM tbl_drugs ";
    $result = $this->connection->query($sqlQuery);
    $drugs = [];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $drugs[] = $row;
      }
    }

    return $drugs;
  }


  /**
   * @param mixed $postArgs
   * 
   * @return Bool
   */
  public function saveDrug($postArgs)
  {

    $expiredOn = date('Y-m-d', strtotime('+1 year'));
    $name = $postArgs['name'];
    $description = $postArgs['description'];

    $sql = "INSERT INTO tbl_drugs (drug_name, description, expired_on) VALUES ('$name', '$description', '$expiredOn')";
    $result = $this->connection->query($sql);

    return $result;
  }



  /**
   * @param mixed $putArgs
   * 
   * @return Bool
   */
  public function updateDrugStatus($putArgs)
  {
    $userID = $_SESSION['user_id'];
    $status = $putArgs['status'] ?? 'pending';
    $note = $putArgs['rejectionNote'] ?? '';
    $drugID = $putArgs['drugID'];

    $sql = "UPDATE tbl_drugs SET status = '$status', rejection_note = '$note',
      user_id = '$userID'
      WHERE id = $drugID";
    $result = $this->connection->query($sql);

    return $result;
  }
}
