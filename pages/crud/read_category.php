<?php
require '../../config.php';

$queryCat = "SELECT * FROM tb_category";
$queryCatTo = $conn->prepare($queryCat);
$queryCatTo->execute();
$cats = $queryCatTo->fetchAll(PDO::FETCH_ASSOC);
?>