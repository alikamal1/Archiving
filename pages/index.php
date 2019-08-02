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
            <li class="active"><a href="index.php">الرئيسية</a></li>
            <li><a href="post_out.php">الكتب الصادرة</a></li>
            <li><a href="post_in.php">الكتب الواردة</a></li>
            <li><a href="show.php">عرض الكتب</a></li>
            <li><a href="add.php">التحديث</a></li>
            <li ><a href="search.php">البحث</a></li>
          </ul>
        </div>
      </div>
    </div><!-- /.navbar -->
  </div>

  <!-- Jumbotron -->
  <div class="jumbotron">
    <h1>الارشفة الالكترنية</h1>
    <p class="lead">الاخبار</p>
    <a class="btn btn-large btn-success" href="#">أدخال البيانات</a>
  </div>

  <hr>

  <!-- Example row of columns -->
  <div class="row-fluid">
    <div class="span4">
      <h2>الكتب الصادرة</h2>
      <p>خرن الكتب الصادرة  </p>
      <p><a class="btn" href="#">التفاصيل &raquo;</a></p>
    </div>
    <div class="span4">
      <h2>الكتب الوادرة</h2>
      <p>خزن الكتب الواردة </p>
      <p><a class="btn" href="#">التفاصيل &raquo;</a></p>
   </div>
    <div class="span4">
      <h2>الجهات / الدائرة</h2>
      <p>عرض الجهات والدوائر</p>
      <p><a class="btn" href="#">التفاصيل &raquo;</a></p>
    </div>
  </div>

<?php include "footer.php"; ?>
</div> <!-- /container -->


</body>
  
</html>
