<?php

$tablename = $_POST['tablename'];
$namelist = $_POST['name'];
$datatypelist = $_POST['datatype'];
$lengthlist = $_POST['length'];
$defaultlist = $_POST['default'];

$command = 'CREATE TABLE '.$tablename.' (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,';

for($i=0;$i<sizeof($namelist);$i++){
    $command .= $namelist[$i].' '.
    $datatypelist[$i].
    '('.
    $lengthlist[$i].
    ') '.
    $defaultlist[$i].
    ', ';
}

$command .= 'created_at varchar(191) null)';

$conn = new mysqli('localhost','root','','dynamicform');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn->query($command) === TRUE) {
    echo 'Table '.$tablename.' created successfully';
} 
else {
    echo 'Error creating table: ' . $conn->error;
}
  
$conn->close();

// echo $command;
header('Location: showform.php?v='.base64_encode($tablename));

?>
