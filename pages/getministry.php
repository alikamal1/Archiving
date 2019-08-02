<?php include"conn.php"; ?>
<?php
if(isset($_GET['name']))
{
 $name = $_GET['name'];
//SELECT ministry.id AS id1,ministry.name AS name1,ministry.id,office.id AS id2,office.name AS name2,office.ministry_id FROM office JOIN ministry WHERE ministry_id=11
$sql="SELECT DISTINCT office.name AS name2 FROM office INNER JOIN ministry ON ministry.id=office.ministry_id WHERE ministry.name=N' {$name}'";
$result = mysqli_query($connection,$sql);

while($row = mysqli_fetch_array($result)) {
            
         $name_office = $row['name2'];
    
                echo "<option>".$name_office."</option>";   
}   
    
}
else
{
    $name=$_SESSION['temp_name'];
    $sql="SELECT DISTINCT office.name AS name2 FROM office INNER JOIN ministry ON ministry.id=office.ministry_id WHERE ministry.name=N'{$name}'";
$result = mysqli_query($connection,$sql);

$row = mysqli_fetch_array($result);
            
         $name_office = $row['name2'];
    
                echo "<option>".$name_office."</option>";   
   
}

?>