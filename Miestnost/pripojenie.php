<?php
/*$dbServername = '147.232.40.14:3306';
$dbUsername = "km863qc";
$password = "km863qc";
$connect = mysqli_connect($dbServername,$dbUsername,$password,$dbUsername);
*/
//$connect->close();


class Miestnost{



  

  public function getData() {
    $dbServername = '147.232.40.14:3306';
    $dbUsername = "km863qc";
    $password = "km863qc";
    $connect = mysqli_connect($dbServername,$dbUsername,$password,$dbUsername);
    $sql = "SELECT *FROM Miestnost";
    $result = mysqli_query($this->db,$sql);
    $resultcheck = mysqli_num_rows($result);
    if ($resultcheck>0){
        while ($row = mysqli_fetch_assoc($result)){
            $data[]=$row;
        }
    }
    return $data;
  }
}


 ?>
