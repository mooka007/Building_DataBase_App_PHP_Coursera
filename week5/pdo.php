<?php 

$pdo = new PDO('mysql:localhost;port=8889;dbname=apah', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);