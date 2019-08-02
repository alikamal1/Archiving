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
            <li><a href="#">الجهات</a></li>
            <li><a href="add.php">التحديث</a></li>
            <li class="active"><a href="search.php">البحث</a></li>
          </ul>
        </div>
      </div>
    </div><!-- /.navbar -->
  </div>

  <!-- Jumbotron -->
    <center><div class="page-header">
    <h1>البحث عن كتاب</h1>
    <p class="lead">بحث في الكتب الصادرة والواردة</p>
    </div></center>

<div class="well">


<div class="row-fluid">
    <div class="span6">

    <div>
    <form method="post" action="show_search.php">
    <legend class="text-error"> البحث حسب الموضوع</legend>
    <label class="text-info">أدخل موضوع الكتاب</label>
    <input class="span8" name="name" type="text" placeholder="أدخل موضوع "><br>&nbsp;&nbsp;
    <button type="submit" name="submit_s_name_o" class="btn btn-primary	">بحث في الصادرة</button>&nbsp;&nbsp;
    <button type="submit" name="submit_s_name_i" class="btn btn-success	">بحث في الواردة</button>
    </form></div><br><legend></legend>
    <div>
    <form method="post" action="show_search.php">
    <legend class="text-error"> البحث حسب الرقم</legend>
    <label class="text-info">أدخل رقم الكتاب</label>
    <input class="span8" name="number" type="text" placeholder="أدخل رقم "><br>&nbsp;&nbsp;
    <button type="submit" name="submit_s_number_o" class="btn btn-primary	">بحث في الصادرة</button>&nbsp;&nbsp;
    <button type="submit" name="submit_s_number_i" class="btn btn-success	">بحث في الواردة</button>
    </form></div><br><legend></legend>
    <div>
    <form method="post" action="show_search.php">
    <legend class="text-error">البحث حسب التاريخ</legend>
    <label class="text-info">أدخل تاريخ الكتاب </label>
    <input class="span8" name="date" type="date" value="<?php echo date('Y-m-d'); ?>"  style="text-align: right;"><br>&nbsp;&nbsp;
    <button type="submit" name="submit_s_date_o" class="btn btn-primary	">بحث في الصادرة</button>&nbsp;&nbsp;
    <button type="submit" name="submit_s_date_i" class="btn btn-success	">بحث في الواردة</button>
    </form></div><br><legend></legend>
    <div>
    <form method="post" action="show_search.php">
    <legend class="text-error">البحث حسب المحتوى</legend>
    <label class="text-info">أدخل نبذة عن متحوى الكتاب </label>
    <input class="span8" name="content" type="text" placeholder="أدخل تاريخ "><br>&nbsp;&nbsp;
    <button type="submit" name="submit_s_content_o" class="btn btn-primary	">بحث في الصادرة</button>&nbsp;&nbsp;
    <button type="submit" name="submit_s_content_o" class="btn btn-success	">بحث في الواردة</button>
    </form></div><br><legend></legend>

    
    
    
    </div>
    
    
    <div class="span6">
    

    <div>
    <form method="post" action="show_search.php">
    <legend class="text-error"> البحث حسب الجهة</legend>
    <label class="text-info" for="exampleSelect2">ادخل الجهة المعنية</label>
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
    </select><br>&nbsp;&nbsp;
    <button type="submit" name="submit_s_ministry_o" class="btn btn-primary	">بحث في الصادرة</button>&nbsp;&nbsp;
    <button type="submit" name="submit_s_ministry_i" class="btn btn-success	">بحث في الواردة</button>
    </form></div><br><legend></legend>
       

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
    <form method="post" action="show_search.php">
    <legend class="text-error" >  البحث حسب الدائرة</legend>
      <label class="text-info" for="exampleSelect2">ادخل الدائرة المعنية</label>
       <select name="office" class="span8" id="office_select">
           <?php include"getministry.php"?>
        </select><br>&nbsp;&nbsp;
    <button type="submit" name="submit_s_office_o" class="btn btn-primary	">بحث في الصادرة</button>&nbsp;&nbsp;
    <button type="submit" name="submit_s_office_i" class="btn btn-success	">بحث في الواردة</button>
    </form></div><br><legend></legend>

  
    <div>
    <form method="post" action="show_search.php">
    <legend class="text-error">  البحث حسب النوع</legend>
    <label for="exampleSelect2" class="text-info">ادخل نوع الكتاب</label>
    <select name="content_type" class="span8"  value="<?php echo isset($_POST['content_type']) ? $_POST['content_type'] : '' ?>">
    <?php 
        $query = "SELECT * FROM content_type";
        $select_query=mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_query)){
            $name = $row['name'];
            echo "<option>".$name."</option>";
        }
    ?>
    </select><br>&nbsp;&nbsp;
    <button type="submit" name="submit_s_content_type_o" class="btn btn-primary	">بحث في الصادرة</button>&nbsp;&nbsp;
    <button type="submit" name="submit_s_content_type_o" class="btn btn-success	">بحث في الواردة</button>
    </form></div><br><legend></legend><br>
     
     
    <div>
    <form method="post" action="show_search.php">
    <legend class="text-error">  البحث حسب موقع الخزن</legend>
    <label for="exampleSelect2" class="text-info">ادخل موقع الخزن</label>
    <select name="storage_location" class="span8" value="<?php echo isset($_POST['storage_location']) ? $_POST['storage_location'] : '' ?>">
    <?php 
        $query = "SELECT * FROM storage_location";
        $select_query=mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_query)){
            $name = $row['name'];
            echo "<option>".$name."</option>";
        }
    ?>
    </select><br>&nbsp;&nbsp;
    <button type="submit" name="submit_s_storage_location_o" class="btn btn-primary	">بحث في الصادرة</button>&nbsp;&nbsp;
    <button type="submit" name="submit_s_storage_location_i" class="btn btn-success	">بحث في الواردة</button>
    </form></div><br><legend></legend>

    
    
    
    <br><br><br>
    
    
    
    
    </div>

    



</div> <!-- /container -->

    </div>     <?php include "footer.php"; ?>

    </div>

</body>
  
</html>
