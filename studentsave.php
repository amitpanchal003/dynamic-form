<?php

$tablename = base64_decode($_GET['v']);

$conn = new mysqli('localhost','root','','dynamicform');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SHOW COLUMNS FROM ".$tablename;
$result = mysqli_query($conn,$sql);
$id = 0;
$command = "INSERT INTO ".$tablename." VALUES ('',";
while($row = mysqli_fetch_array($result)){
    if($id++ == 0){
        continue;
    }
    if($row['Field'] == 'created_at'){
        break;
    }
    $command .= "'".$_POST[$row['Field']]."', ";
    
}

$command .= "'".time()."')";

// echo $command.'<br>';


if ($conn->query($command) === TRUE) {
    echo 'data inserted successfully';
} 
else {
    echo 'Error inserting data in table: ' . $conn->error;
}
  
$conn->close();
header('Location: showform.php?v='.base64_encode($tablename));

?>