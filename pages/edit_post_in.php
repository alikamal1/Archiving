<?php include"conn.php"; ?>
<?php
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    echo $id;
    $query_post = "SELECT * FROM post_ingoing WHERE id={$id};";
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
}
    
?>

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
    $query = "INSERT INTO post_outgoing (id,name,date,number,content,ministry_id,office_id,storage_location_id,note,content_type_id) VALUES (NULL,'{$name}','{$date}','{$number}','{$content}','{$ministry_id}','{$office_id}','{$storage_location_id}','{$note}','{$content_type_id}');";
    echo $query;
    $insert_query=mysqli_query($connection,$query);
    if($insert_query){
        //echo "Value Inserted!";
    }
    
 if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png","bmp");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 5000000){
         $errors[]='File size must be excately 5 MB';
      }
      
      if(empty($errors)==true){
          
        //$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
         move_uploaded_file($file_tmp,"images/".$number.$file_name);
        $query_image ="INSERT INTO images (id,image_name) VALUES (NULL,'{$file_name}');";
         move_uploaded_file($file_tmp,"images/".$file_name);
         $insert_query=mysqli_query($connection,$query_image);
         // echo "Success";
          //<img src="data:image/png;base64,'.base64_encode($row['image']).'">
      }else{
         print_r($errors);
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
            <li class="active"><a href="post_out.php">الكتب الصادرة</a></li>
            <li><a href="post_in.php">الكتب الواردة</a></li>
            <li><a href="show.php">عرض الكتب</a></li>
            <li><a href="add.php">التحديث</a></li>
            <li><a href="search.php">البحث</a></li>
          </ul>
        </div>
      </div>
    </div><!-- /.navbar -->
  </div>
  
  


<!-- Jumbotron -->
<center><div class="page-header">
<h1>الكتب الصادرة</h1>
<p class="lead">ادخال بيانات الكتاب</p>
</div></center>
  

 
<div class="well">
  
<form role="form" method="post" enctype="multipart/form-data">
<legend>اضافة بيانات الكتاب</legend>

  <div class="container-fluid">
  <div class="row-fluid">
    <div class="span6"> 
    <div class="form-group">
        <label>رقم الكتاب</label>
        <input class="span8" name="number" type="text" placeholder="أدخل رقم" value="<?php echo $number; ?>">
    </div>
    <br>
    
    
    <div class="input-group date" data-provide="datepicker">
    <label>تاريخ الكتاب</label>
    <input class="span8" name="date" type="text" value="<?php echo $date; ?>">
    <div class="input-group-addon">
    </div>
    </div>
    <br>
    
    
    <div class="form-group">
        <label>الموضوع</label>
        <input  class="span8" name="name" type="text" placeholder="أدخل رقم"  value="<?php echo $name ?>">
    </div>
    <br>
    
        
    <div>
        <label for="exampleTextarea">المحتوى</label>
        <textarea class="span9" name="content" nid="exampleTextarea" rows="6"><?php echo $content; ?></textarea>
 
    </div>
      
     
      <!--Sidebar content-->
    </div>
    <div class="span6">
      <!--Body content-->
       

    <div >
    <label for="exampleSelect2">الجهة</label>
    <select name="ministry" class="span8" id="ministry" onchange="show(value)" >
       <?php
        $query = "SELECT * FROM ministry";
        $select_query=mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_query)){
            $name = $row['name'];
            $ministry_id = $row['id'];
            if($row['id']==$ministry_id)
            {
                $_SESSION['temp_name']=$name;
                echo "<option selected>".$name."</option>";
            }
            else
            {
                $_SESSION['temp_name']=$name;
                echo "<option>".$name."</option>"; 
            }
        }
    ?>

    </select>                                      
                          
    <br>
      
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
                xmlhttp.open("GET","getministry_edit.php?name="+str,true);
                xmlhttp.send();

        }
        </script>
         
         
    <div>
      <label for="exampleSelect2">الدائرة</label>
        <select name="office" class="span8" id="office_select">
                      <?php include"getministry.php"?>
        </select>
    </div> 
    <br>
    
      <div>
        <label for="exampleSelect2">نوع الكتاب</label>
        <select name="content_type" class="span8"  value="<?php echo isset($_POST['content_type']) ? $_POST['content_type'] : '' ?>">
        <?php 
            $query = "SELECT * FROM content_type";
            $select_query=mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_query)){
                $name = $row['name'];
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
        </select>
    </div>
    
     <br>
     
    <div>
        <label for="exampleSelect2">موقع الخزن</label>
        <select name="storage_location" class="span8" value="<?php echo isset($_POST['storage_location']) ? $_POST['storage_location'] : '' ?>">
        <?php 
            $query = "SELECT * FROM storage_location";
            $select_query=mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_query)){
                $name = $row['name'];
                if($row['id']==$storage_location_id)
                {
                    echo "<option selected>".$name."</option>";
                }
                else
                {
                    echo "<option>".$name."</option>"; 
                }
            }
        ?>
        </select>
    </div>
    <br> 
       
       
    <div>
        <label for="exampleTextarea">الملاحظات</label>
        <textarea class="span10" name="note" id="exampleTextarea" rows="3"><?php echo $note; ?></textarea>
    </div>
    
    
     <div>
       <br>
       <label for="exampleTextarea">تحميل صورة الكتاب</label>
        <input class="btn btn-success" type="file" name="image"/>
    </div>

    </div>
    </div>
    </div>
    </div>
    
     <br> <br> <br>
    <div>
        <button class="btn btn-large btn-block btn-primary" type="submit" name="submit">ادخال البيانات</button>
        <button class="btn btn-large btn-block" type="button">مسح</button>
    </div>
  
    
</form>



    
    </div>
<?php include "footer.php"; ?>

    </div>



</body>
  
</html>
