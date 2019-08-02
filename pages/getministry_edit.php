<?php
$name = $_GET['name'];

include "conn.php";
//SELECT ministry.id AS id1,ministry.name AS name1,ministry.id,office.id AS id2,office.name AS name2,office.ministry_id FROM office JOIN ministry WHERE ministry_id=11
$sql="SELECT DISTINCT office.name AS name2 FROM office INNER JOIN ministry ON ministry.id=office.ministry_id WHERE ministry.name=N' {$name}'";
$result = mysqli_query($connection,$sql);

while($row = mysqli_fetch_array($result)) {

         $name = $row['name2'];
                 if($row['id']==$content_type_id)
                {
                    echo "<option selected>".$name."</option>";
                }
                else
                {
                    echo "<option>".$name."</option>"; 
                }  
}
?>