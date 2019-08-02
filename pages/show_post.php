<?php include"conn.php"; ?>
<?php
if(isset($_GET['show'])){
    $id = $_GET['show'];
    $query_post = "SELECT * FROM post_outgoing WHERE id={$id};";
    $select_query_post=mysqli_query($connection,$query_post);
    $row_post = mysqli_fetch_assoc($select_query_post);
    $content_type_id = $row_post['id'];
    $number =$row_post['number'];
    $date = $row_post['date'];
    $name = $row_post['name'];
    $content = $row_post['content'];
    $content_type_id = $row_post['content_type_id'];
    $ministry_id = $row_post['ministry_id'];
    $office_id = $row_post['office_id'];
    $storage_location_id = $row_post['storage_location_id'];
    $note = $row_post['note'];
    
    $images_id = $row_post['images_id'];
    $query = "SELECT * FROM images WHERE id={$images_id};";
    echo  $query;
    $select_query_images=mysqli_query($connection,$query);
    $row_images = mysqli_fetch_assoc($select_query_images);
    $images_name = $row_images['name'];
echo $images_name;
    $query = "SELECT * FROM content_type";
    $select_query=mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_query)){
        $name = $row['name'];
        if($row['id']==$content_type_id)
        {
            $content_type=$name;
        }

    }

    $query = "SELECT * FROM storage_location";
    $select_query=mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_query)){
        $name = $row['name'];
        if($row['id']==$storage_location_id)
        {
            $storage_location=$name;
        }

    }

    $query = "SELECT * FROM ministry";
    $select_query=mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_query)){
        $name = $row['name'];
        $ministry_id = $row['id'];
        if($row['id']==$ministry_id)
        {
            $ministry=$name;
        }
    }
    
    $query = "SELECT * FROM office";
    $select_query=mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_query)){
        $name = $row['name'];
        $ministry_id = $row['id'];
        if($row['id']==$office_id)
        {
            $office=$name;
        }
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
            <li class="active"><a href="show.php">عرض الكتب</a></li>
            <li><a href="add.php">التحديث</a></li>
            <li><a href="search.php">البحث</a></li>
          </ul>
        </div>
      </div>
    </div><!-- /.navbar -->
  </div>
<br>
  <!-- Jumbotron -->
  <center><div class="page-header">
    <h1>عرض معلومات الكتاب</h1>
    <p class="lead">تفاصيل الكتاب</p>
  </div></center>

<div class="well">

<form>
      <div class="container-fluid">
  <div class="row-fluid">
   <div class="span6">
   <div class="form-group">
        <label>الرقم</label>
        <input  class="span8" name="name" type="text" readonly value ="<?php echo $number ?>">
    </div>
    <br>    <legend></legend>
    
    <div>
        <label>الموضوع</label>
        <input  class="span8" name="name" type="text" readonly value ="<?php echo $name ?>">
    </div>
    <br>    <legend></legend>
    
    
    <div class="form-group">
        <label>الجهة</label>
        <input  class="span8" name="name" type="text" readonly value ="<?php echo $ministry ?>">
    </div>
       <br>    <legend></legend>

     <div class="form-group">
        <label>المحتوى</label>
         <textarea  class="span8" name="name" type="text" rows="6" readonly><?php echo $content ?></textarea>
    </div>
    <br>    <legend></legend><p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <?php 
    if($images_name <> ""){
       echo "<a href='images/$images_name' data-lightbox='image-1' data-title='Image'><button class='btn btn-large btn-primary btn btn-success	' type='button'>عرض صورة الكتاب</button></a></p>";
    
    }
   else{
       echo "<a href='images/$images_name' data-lightbox='image-1' data-title='Image'><button class='btn btn-large btn-primary btn btn-success	disabled' disabled type='button'>عرض صورة الكتاب</button></a></p>";
   }
     ?>
   
     
      
     
      </div>
    <div class="span6">    
    <div class="form-group">
        <label>تاريخ الكتاب</label>
        <input  class="span8" name="name" type="text" readonly value ="<?php echo $date ?>">
    </div>
    <br>    <legend></legend>
    
    <div class="form-group">
        <label>نوع الكتاب</label>
        <input  class="span8" name="name" type="text" readonly value ="<?php echo $content_type ?>">
    </div>
    <br>    <legend></legend>
    
    <div class="form-group">
        <label>الدائرة</label>
        <input  class="span8" name="name" type="text" readonly value ="<?php echo $office ?>">
    </div>
    <br>    <legend></legend>
    
      <div class="form-group">
        <label>موقع الخزن</label>
        <input  class="span8" name="name" type="text" readonly value ="<?php echo $storage_location ?>">
    </div>
    <br>    <legend></legend>
    <div class="form-group">
        <label>الملاحظات</label>
        <textarea  class="span8" name="name" type="text" rows="3" readonly><?php echo $note ?></textarea>
    </div>
    <br>    <legend></legend>
    </div> </div></div>  
</form>


</div> <!-- /container -->
    <?php include "footer.php"; ?>

    </div>

</body>
  
</html>
