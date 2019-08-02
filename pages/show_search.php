<?php include"conn.php"; ?>
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
            <li class="active"><a href="show.php">عرض الكتب</a></li>
            <li><a href="add.php">اضافة تحديث</a></li>
            <li><a href="search.php">البحث</a></li>
          </ul>
        </div>
      </div>
    </div><!-- /.navbar -->
  </div>

  <!-- Jumbotron -->
   <center><div class="page-header">
    <h1>عرض الكتب</h1>
    <p class="lead">عرض الكتب المخزونة</p>
       </div></center>

<div class="well">
<table class="table table-hover">
<legend class="text-error">جدول الكتب المخزونة</legend>

<tr>
    <th class='text-info'>التسلسل</th>
   
    <th class='text-info'>رقم اسم الكتاب</th>
    <th class='text-info'>موضوع الكتاب</th>
    <th class='text-info'>تاريخ الكتاب</th>
    <th class='text-info'>اسم المحفظة</th>
    <th class='text-info'>الخيارات</th>
    
</tr>
<?php
    if(isset($_POST['submit_s_name_o']))
    {
        $x=$_POST['name'];
        $query = "SELECT * FROM post_outgoing WHERE name =N'{$x}'";
    }
    else if(isset($_POST['submit_s_name_i']))
    {
        $x=$_POST['name'];
        $query = "SELECT * FROM post_ingoing WHERE name =N'{$x}'";
    }
    
    else if(isset($_POST['submit_s_number_o']))
    {
        $x=$_POST['number'];
        $query = "SELECT * FROM post_outgoing WHERE number =N'{$x}'";
    }
    else if(isset($_POST['submit_s_number_i']))
    {
        $x=$_POST['number'];
        $query = "SELECT * FROM post_ingoing WHERE number =N'{$x}'";
    }
    
    else if(isset($_POST['submit_s_date_o']))
    {
        $x=$_POST['date'];
        $query = "SELECT * FROM post_outgoing WHERE date =N'{$x}'";
    }
    else if(isset($_POST['submit_s_date_i']))
    {
        $x=$_POST['date'];
        $query = "SELECT * FROM post_ingoing WHERE date =N'{$x}'";
    }
    
    else if(isset($_POST['submit_s_content_o']))
    {
        $x=$_POST['content'];
        $query = "SELECT * FROM post_outgoing WHERE content LIKE '%".$x."%'";
        echo $query;
    }
    else if(isset($_POST['submit_s_content_i']))
    {
        $x=$_POST['content'];
        $query = "SELECT * FROM post_ingoing WHERE content =N'{$x}'";
    }
    
    else if(isset($_POST['submit_s_ministry_o']))
    {
        $ministry = $_POST['ministry'];
        $query_ministry_id = "SELECT id FROM ministry WHERE name=N' {$ministry}';";
        $select_query_ministry_id=mysqli_query($connection,$query_ministry_id);
        $row_ministry_id = mysqli_fetch_assoc($select_query_ministry_id);
        $ministry_id = $row_ministry_id['id'];
        
        $x=$ministry_id;
        $query = "SELECT * FROM post_outgoing WHERE ministry_id =N'{$x}'";
    }
    else if(isset($_POST['submit_s_ministry_i']))
    {
        $ministry = $_POST['ministry'];
        $query_ministry_id = "SELECT id FROM ministry WHERE name=N' {$ministry}';";
        $select_query_ministry_id=mysqli_query($connection,$query_ministry_id);
        $row_ministry_id = mysqli_fetch_assoc($select_query_ministry_id);
        $ministry_id = $row_ministry_id['id'];
        
        $x=$ministry_id;
        $query = "SELECT * FROM post_ingoing WHERE ministry_id =N'{$x}'";
    }
    
    else if(isset($_POST['submit_s_office_o']))
    {
        $office = $_POST['office'];
        $query_office_id = "SELECT id FROM office WHERE name=N'{$office}';";
        $select_query_office_id=mysqli_query($connection,$query_office_id);
        $row_office_id = mysqli_fetch_assoc($select_query_office_id);
        $office_id = $row_office_id['id'];
        
        $x=$office_id;
        $query = "SELECT * FROM post_outgoing WHERE office_id =N'{$x}'";
    }
    else if(isset($_POST['submit_s_office_i']))
    {
        $office = $_POST['office'];
        $query_office_id = "SELECT id FROM office WHERE name=N'{$office}';";
        $select_query_office_id=mysqli_query($connection,$query_office_id);
        $row_office_id = mysqli_fetch_assoc($select_query_office_id);
        $office_id = $row_office_id['id'];
        
        $x=$office_id;
        $query = "SELECT * FROM post_ingoing WHERE office_id =N'{$x}'";
    }
    
    else if(isset($_POST['submit_s_content_type_o']))
    {
        $content_type = $_POST['content_type'];
        $query_type_id = "SELECT id FROM content_type WHERE name=N' {$content_type}';";
        $select_query_type_id=mysqli_query($connection,$query_type_id);
        $row_type_id = mysqli_fetch_assoc($select_query_type_id);
        $content_type_id = $row_type_id['id'];
        $x=$content_type_id;
        $query = "SELECT * FROM post_outgoing WHERE content_type_id =N'{$x}'";
    }
    else if(isset($_POST['submit_s_content_type_i']))
    {
        $content_type = $_POST['content_type'];
        $query_type_id = "SELECT id FROM content_type WHERE name=N' {$content_type}';";
        $select_query_type_id=mysqli_query($connection,$query_type_id);
        $row_type_id = mysqli_fetch_assoc($select_query_type_id);
        $content_type_id = $row_type_id['id'];
        $x=$content_type_id;
        $query = "SELECT * FROM post_ingoing WHERE content_type_id =N'{$x}'";
    }
    
    else if(isset($_POST['submit_s_storage_location_o']))
    {
        $storage_location = $_POST['storage_location'];
        $query_storage_location_id ="SELECT id FROM storage_location WHERE name=N' {$storage_location}';";
        $select_query_storage_location_id=mysqli_query($connection,$query_storage_location_id);
        $row_storage_location_id = mysqli_fetch_assoc($select_query_storage_location_id);
        $storage_location_id = $row_storage_location_id['id'];
        
        $x=$storage_location_id;
        $query = "SELECT * FROM post_outgoing WHERE storage_location_id =N'{$x}'";
    }
    else if(isset($_POST['submit_s_storage_location_i']))
    {
        $storage_location = $_POST['storage_location'];
        $query_storage_location_id ="SELECT id FROM storage_location WHERE name=N' {$storage_location}';";
        $select_query_storage_location_id=mysqli_query($connection,$query_storage_location_id);
        $row_storage_location_id = mysqli_fetch_assoc($select_query_storage_location_id);
        $storage_location_id = $row_storage_location_id['id'];
        
        $x=$storage_location_id;
        $query = "SELECT * FROM post_ingoing WHERE storage_location_id =N'{$x}'";
    }
    
   
    
    
    $select_query=mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_query)){
        $id = $row['id'];
        $name = $row['name'];
        $date = $row['date'];
        $number = $row['number'];
        
        $type_id = $row['content_type_id'];
        $query_type = "SELECT name FROM content_type WHERE id=".$type_id;
        $select_query_type=mysqli_query($connection,$query_type);
        $row_type = mysqli_fetch_assoc($select_query_type);
        $type=$row_type['name'];
        
        $content = $row['content'];
        
        $ministry_id = $row['ministry_id'];
        $query_ministry = "SELECT name FROM ministry WHERE id=".$ministry_id;
        $select_query_ministry=mysqli_query($connection,$query_ministry);
        $row_ministry = mysqli_fetch_assoc($select_query_ministry);
        $ministry = $row_ministry['name'];
        
        $office_id = $row['office_id'];
        $query_office = "SELECT name FROM office WHERE id=".$office_id;
        $select_query_office=mysqli_query($connection,$query_office);
        $row_office = mysqli_fetch_assoc($select_query_office);
        $office = $row_office['name'];
        
        $storage_location_id = $row['storage_location_id'];
        $query_storage_location = "SELECT name FROM storage_location WHERE id=".$storage_location_id;
        $select_query_storage_location=mysqli_query($connection,$query_storage_location);
        $row_storage_location = mysqli_fetch_assoc($select_query_storage_location);
        $storage_location = $row_storage_location['name'];
        
        $note = $row['note'];
        
        $content_type_id = $row['content_type_id'];
        $query_content_type = "SELECT name FROM content_type WHERE id=".$content_type_id;
        $select_query_content_type=mysqli_query($connection,$query_content_type);
        $row_content_type = mysqli_fetch_assoc($select_query_content_type);
        $content_type = $row_content_type['name'];
        
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$number}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$date}</td>";
        echo "<td>{$content_type}</td>";
        echo "<td>";
        
        echo "<a href='show_post.php?show={$id}' target='_blank''><button class='btn btn-primary' type='button'>عرض</button></a>&nbsp;&nbsp;";
        
        echo "<a href='edit_post_out.php?edit={$id}'><button class='btn btn-warning' type='button'>تعديل</button></a>&nbsp;&nbsp;";
        
        echo "<a href='show.php?delete={$id}'><button class='btn btn-danger' type='button'>حذف</button></a>&nbsp;&nbsp;";
        
        echo "</td>";
        echo "</tr>";
        
        

    }
?>


</table></div>
<center>
<div class="pagination  pagination-large">
  <ul>
    <li><a href="#">الرجوع</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">التالي</a></li>
  </ul>
</div>
</center>
    <?php include "footer.php"; ?>
</div> <!-- /container -->


<?php
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "DELETE FROM post_outgoing WHERE id={$id}";
    $delete_query = mysqli_query($connection,$query);
}    
?>

<?php
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
}    
?>


</body>
  
</html>
