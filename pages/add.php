<?php include"conn.php"; ?>
<?php 
if(isset($_POST['submit_storage']))
{       

    $name = $_POST['name'];
    $query = "INSERT INTO storage_location (id, name) VALUES (NULL,N' ".$name."');";
    echo $query;
    echo "d".mysqli_query($connection, "SET NAMES 'utf8'");   
    $insert_query=mysqli_query($connection,$query);
    if($insert_query){
       // echo "Value Inserted!";
    }
    
}
if(isset($_POST['submit_ministry']))
{       

    $name = $_POST['name'];
    $query = "INSERT INTO ministry (id, name) VALUES (NULL,' ".$name."');";
    echo $query;
    $insert_query=mysqli_query($connection,$query);
    if($insert_query){
       // echo "Value Inserted!";
    }
    
}
if(isset($_POST['submit_office']))
{       

    $name = $_POST['name'];
    $ministry = $_POST['ministry'];
    
    $query = "SELECT * FROM ministry WHERE name LIKE '%".$ministry."'";
    $select_query=mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($select_query);
    $id = $row["id"];
    $query = "INSERT INTO office (id, name,ministry_id) VALUES (NULL,'".$name."',".$id.");";
    //echo $query;
    $insert_query=mysqli_query($connection,$query);
    if($insert_query){
      //  echo "Value Inserted!";
    }
    
}
if(isset($_POST['submit_type']))
{       

    $name = $_POST['name'];
    $query = "INSERT INTO content_type (id, name) VALUES (NULL,' ".$name."');";
   // echo $query;
    $insert_query=mysqli_query($connection,$query);
    if($insert_query){
       // echo "Value Inserted!";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include"header.php"; ?>


<body>

<div class="container">

  <div class="masthead">
    <h2 class="muted">الجامعة التكنولوجية / قسم هندسة الحاسوب</h2><br>
    <div class="navbar">
      <div class="navbar-inner">
        <div class="container">
          <ul class="nav">
            <li><a href="index.php">الرئيسية</a></li>
            <li><a href="post_out.php">الكتب الصادرة</a></li>
            <li><a href="post_in.php">الكتب الواردة</a></li>
            <li><a href="show.php">عرض الكتب</a></li>
            <li class="active"><a href="add.php">التحديث</a></li>
            <li><a href="search.php">البحث</a></li>
          </ul>
        </div>
      </div>
    </div><!-- /.navbar -->
  </div>

  <!-- Jumbotron -->
   <center><div class="page-header">
    <h1>تحديث الادخلات</h1>
    <p class="lead">أضافة ادخالات جديدة</p>
       </div></center>

<div class="well">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span6">
      <!--Sidebar content-->
      <form method="post">
  <fieldset>
    <legend class="text-error">اضافة وزارة / جهة</legend>
    <label class="text-info">اسم الوزارة / الجهة</label>
    <input class="span8" name="name" type="text" placeholder="أدخل الاسم"><br>
    <button type="submit" name="submit_ministry" class="btn btn-success">حفظ اسم الجهة الجديدة</button>
  </fieldset><br><legend></legend><br>
</form>     
 <form method="post">
  <fieldset>
    <legend class="text-error">اضافة الدائرة التابعة</legend>
        <label class="text-info">اسم الوزارة / الجهة</label>
        <select class="span8" name="ministry">
        <?php 
            $query = "SELECT * FROM ministry";
            $select_query=mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_query)){
                $name = $row['name'];
                echo "<option>".$name."</option>";
            }
        ?>

        </select>
    <label class="text-info">اسم الدائرة</label>
    <input class="span8" name="name" type="text" placeholder="أدخل الاسم"><br>
    <button type="submit" name="submit_office" class="btn  btn-success">حفظ اسم الدائرة الجديدة</button>
  </fieldset><br><legend></legend><br>
</form>
    </div>
    <div class="span6">
      <!--Body content-->
      
           <form method="post">
  <fieldset>
    <legend class="text-error">اضافة نوع كتاب</legend>
    <label class="text-info">اسم النوع</label>
    <input class="span8" name="name" type="text" placeholder="أدخل الاسم"><br>
    <button type="submit" name="submit_type" class="btn  btn-success">حفظ نوع الكتاب الجديد</button>
  </fieldset><br><legend></legend><br>
</form>
<form method="post">
  <fieldset><br><br>
    <legend class="text-error">اضافة موقع خزن</legend>
    <label class="text-info">اسم موقع الخزن</label>
    <input class="span8" name="name" type="text" placeholder="أدخل الاسم"><br>
    <button type="submit" name="submit_storage" class="btn  btn-success"> حفظ موقع الخزن الجديد</button>
  </fieldset><br><legend></legend><br>
</form>
    </div>
  </div>
</div>
</div>






<?php include "footer.php"; ?>
</div> <!-- /container -->


</body>
  
</html>
