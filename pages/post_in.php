<?php include"conn.php"; ?>
<?php
if(isset($_POST['submit']))
{
    $number = $_POST['number'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $content = $_POST['content'];
    
    $content_type = $_POST['content_type'];
    $query_type_id = "SELECT id FROM content_type WHERE name=N' {$content_type}';";
    $select_query_type_id=mysqli_query($connection,$query_type_id);
    $row_type_id = mysqli_fetch_assoc($select_query_type_id);
    $content_type_id = $row_type_id['id'];
    
    $ministry = $_POST['ministry'];
    $query_ministry_id = "SELECT id FROM ministry WHERE name=N' {$ministry}';";
    $select_query_ministry_id=mysqli_query($connection,$query_ministry_id);
    $row_ministry_id = mysqli_fetch_assoc($select_query_ministry_id);
    $ministry_id = $row_ministry_id['id'];
    
    $office = $_POST['office'];
    $query_office_id = "SELECT id FROM office WHERE name=N'{$office}';";
    $select_query_office_id=mysqli_query($connection,$query_office_id);
    $row_office_id = mysqli_fetch_assoc($select_query_office_id);
    $office_id = $row_office_id['id'];
        
    $storage_location = $_POST['storage_location'];
    $query_storage_location_id ="SELECT id FROM storage_location WHERE name=N' {$storage_location}';";
    $select_query_storage_location_id=mysqli_query($connection,$query_storage_location_id);
    $row_storage_location_id = mysqli_fetch_assoc($select_query_storage_location_id);
    $storage_location_id = $row_storage_location_id['id'];
    $note = $_POST['note'];
    
    //echo "Post OK !";
    
    if(isset($_FILES['image']) && $_FILES['image']['name']<>""){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png","bmp","pdf","doc","docx");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 150000000){
         $errors[]='File size must be excately 15 MB';
      }
      
      if(empty($errors)==true){
          
        //$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
         $file_name=$number.$file_name;
         move_uploaded_file($file_tmp,"images/".$file_name);
          
         $query_image ="INSERT INTO images (id,name) VALUES (NULL,'{$file_name}');";
         $insert_query=mysqli_query($connection,$query_image);
         // echo "Success";
          //<img src="data:image/png;base64,'.base64_encode($row['image']).'">
          //echo $file_name;
          $query_images = "SELECT * FROM images WHERE name='{$file_name}';";
          //echo $query_images ;
          $select_query_images=mysqli_query($connection,$query_images);
          $row_images = mysqli_fetch_assoc($select_query_images);
          $images_id = $row_images['id'];
          
          $query = "INSERT INTO post_ingoing (id,name,date,number,content,ministry_id,office_id,storage_location_id,note,content_type_id,images_id) VALUES (NULL,'{$name}','{$date}','{$number}','{$content}','{$ministry_id}','{$office_id}','{$storage_location_id}','{$note}','{$content_type_id}','{$images_id}');";
          echo $query;
      }else{
         print_r($errors);
      }
    }
    else {
        $query = "INSERT INTO post_ingoing (id,name,date,number,content,ministry_id,office_id,storage_location_id,note,content_type_id,images_id) VALUES (NULL,'{$name}','{$date}','{$number}','{$content}','{$ministry_id}','{$office_id}','{$storage_location_id}','{$note}','{$content_type_id}','');";
    }
    
    
    //echo $query;
    $insert_query=mysqli_query($connection,$query);
    if($insert_query){
        //echo "Value Inserted!";
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
            <li class="active"><a href="post_in.php">الكتب الواردة</a></li>
            <li><a href="show.php">عرض الكتب</a></li>
            <li><a href="add.php">التحديث</a></li>
            <li><a href="search.php">البحث</a></li>
          </ul>
        </div>
      </div>
    </div><!-- /.navbar -->
  </div>
  
  
  <!-- Jumbotron --><center><div class="page-header">
    <h1>الكتب الواردة</h1>
    <p class="lead">ادخال بيانات الكتاب</p>
  </div></center>
  

 
<div class="well">
  
<form role="form" method="post" enctype="multipart/form-data">
<legend class="text-error">اضافة بيانات الكتاب</legend>

<div class="container-fluid">
<div class="row-fluid">
<div class="span6">
    
    <div class="form-group">
        <label class="text-info">رقم الكتاب</label>
        <input class="span8"  name="number" type="text" placeholder="أدخل رقم" value="<?php //echo isset($_POST['number']) ? $_POST['number'] : '' ?>">
    </div>
    <br><legend></legend>
            

    <div class="input-group date" >
    <label class="text-info">تاريخ الكتاب</label>
    <input class="span8"  name="date" type="date" value="<?php echo date('Y-m-d'); ?>"  style="text-align: right;" >
    </div>
    <br><legend></legend>
            

    <div class="form-group">
        <label class="text-info">الموضوع</label>
        <input  class="span8" name="name" type="text" placeholder="أدخل رقم"  value="<?php //echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
    </div>
    <br><legend></legend>
    
            
    <div>
        <label class="text-info" for="exampleTextarea">المحتوى</label>
        <textarea class="span9" name="content" nid="exampleTextarea" rows="6"><?php //echo isset($_POST['content']) ? $_POST['content'] : '' ?></textarea>
 
    </div>
    
    
    <div>
       <br>
       <label class="text-info" for="exampleTextarea">تحميل صورة الكتاب</label>
        <input class="btn btn-success" type="file" name="image"/>
    </div>
     
     
      <!--Sidebar content-->
    </div>
    <div class="span6">
      <!--Body content-->
       
         

    <div >
    <label class="text-info" for="exampleSelect2">الجهة</label>
    <select name="ministry" class="span8" id="ministry" onchange="show(value)" >
       <?php 
        $r=1;
        $query = "SELECT * FROM ministry";
        $select_query=mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_query)){
            $name = $row['name'];
            if($r){$_SESSION['temp_name']=$name;$r=0;}
            $ministry_id = $row['id'];
            echo "<option>".$name."</option>";
        }
    ?>
    </select><br><br><legend></legend>
                   

    <script>

    function show(str) {

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("office_select").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","getministry.php?name="+str,true);
            xmlhttp.send();

    }
    </script>
        
          
    <div>
      <label class="text-info" for="exampleSelect2">الدائرة</label>
       <select name="office" class="span8" id="office_select">
           <?php include"getministry.php"?>
         </select>
    </div> 
    <br><legend></legend>

  
    <div>
    <label class="text-info" for="exampleSelect2">نوع الكتاب</label>
    <select name="content_type" class="span8"  value="<?php echo isset($_POST['content_type']) ? $_POST['content_type'] : '' ?>">
    <?php 
        $query = "SELECT * FROM content_type";
        $select_query=mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_query)){
            $name = $row['name'];
            echo "<option>".$name."</option>";
        }
    ?>
    </select>
    </div><br><legend></legend><br>
     
     
    <div>
        <label class="text-info" for="exampleSelect2">موقع الخزن</label>
        <select name="storage_location" class="span8" value="<?php echo isset($_POST['storage_location']) ? $_POST['storage_location'] : '' ?>">
        <?php 
            $query = "SELECT * FROM storage_location";
            $select_query=mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_query)){
                $name = $row['name'];
                echo "<option>".$name."</option>";
            }
        ?>
        </select>
    </div><br><legend></legend>


    <div>
        <label class="text-info" for="exampleTextarea">الملاحظات</label>
        <textarea class="span10" name="note" id="exampleTextarea" rows="6"><?php //echo isset($_POST['note']) ? $_POST['note'] : '' ?></textarea>
    </div>
 

    </div>
    
    </div>
    </div>
    </div>
     <br> <br> <br>
     
    <div>
        <button class="btn btn-large btn-block btn-primary" type="submit" name="submit">ادخال البيانات</button>
        <button class="btn btn-large btn-block" type="reset" >مسح الحقول</button>
    </div>
    <legend></legend>

    
</form>

    </div>
<?php include "footer.php"; ?>

    </div>





</body>
  
</html>
