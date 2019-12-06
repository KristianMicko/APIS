<?php
header("Content-type:application/json");
$dbServername = '147.232.40.14:3306';
$dbUsername = "km863qc";
$password = "km863qc";
$connect = mysqli_connect($dbServername,$dbUsername,$password,$dbUsername);
$sql = "SELECT Miestnost.id as ID, Miestnost.label as Miestnosti, Regal.label as Regale, Miesto.label as Miesta, Polozka.nazov as Polozka, Polozka.nakupna_cena as Nakupna_cena, Polozka.predajna_cena as Predajna_cena, Polozka.balenie as Balenie, Polozka.mnozstvo as Mnozstvo,Vlastnost.nazov as Vlastnosti, Vlastnost.popis as Popis from Miestnost inner JOIN Regal on Miestnost.id = Regal.id_miestnost inner join Miesto on Regal.id = Miesto.id_regal inner join Polozka on Miesto.id = Polozka.id_miesto left join Vlastnost on Vlastnost.id_polozka = Polozka.id";



$result = mysqli_query($connect,$sql);
    $resultcheck = mysqli_num_rows($result);
    if ($resultcheck>0){
        while ($row = mysqli_fetch_assoc($result)){
            $jsondata[]=$row;
        }
    }

$jsondata = json_encode($jsondata);
print_r($jsondata);
$connect->close();
?>
