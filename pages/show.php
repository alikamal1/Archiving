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
    <p class="lead">عرض الكتب الصادرة والواردة المخزونة</p>
       </div></center>
       
<div class="navbar">
  <div class="navbar-inner ">
    <ul class="nav">
      <li class="active"><a href="show.php">الكتب الصادرة</a></li>
      <li><a href=show2.php>الكتب الواردة</a></li>
    </ul>
  </div>
  
</div>
<div class="well">
<table class="table table-hover">
<legend class="text-error">جدول الكتب الصادرة المخزونة</legend>

<tr>
   
    <th class='text-info'>رقم الكتاب</th>
    <th class='text-info'>موضوع الكتاب</th>
    <th class='text-info'>تاريخ الكتاب</th>
    <th class='text-info'>اسم الجهة</th>
    <th class='text-info'>اسم الدائرة</th>
    <th class='text-info'>الخيارات</th>
    
</tr>
<?php
    
    $num_rec_per_page=10;
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
    $start_from = ($page-1) * $num_rec_per_page; 
    $query = "SELECT * FROM post_outgoing LIMIT $start_from, $num_rec_per_page"; 
    
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
        echo "<td>{$number}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$date}</td>";
        echo "<td>{$ministry}</td>";
        echo "<td>{$office}</td>";
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
 
   <?php 
    $sql = "SELECT * FROM post_outgoing"; 
    $select_query=mysqli_query($connection,$sql);
    $total_pages = ceil(mysqli_num_rows($select_query) / $num_rec_per_page); 
     
    echo "<ul>";
    echo "<li><a href='show.php?page=1''>البداية</a></li>"; // Goto 1st page  

    for ($i=1; $i<=$total_pages; $i++) { 
                echo "<li><a href='show.php?page=".$i."'>".$i."</a> </li>"; 
    }; 
    echo "<li><a href='show.php?page=$total_pages'>النهاية</a></li>"; // Goto last page
    
    echo "</ul>";

    ?>

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
