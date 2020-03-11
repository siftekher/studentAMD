<?php
/*
echo 'FROM REPORT TEMPLATE';
echo '<PRE>';
print_r($rows);
echo '</PRE>';
*/
?>

<!DOCTYPE html>

<html>

<head>

  <title>Majestic demo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://drvic10k.github.io/bootstrap-sortable/Contents/bootstrap-sortable.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.js"></script>
  <script src="https://drvic10k.github.io/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <script>
     function deleteStudent( studentId){
         var conf = confirm("Are you sure you want to delete?");

         if(conf) {
            window.location.href = "/majestic/run.php/Student/delete/"+studentId;
            //$("table#student tr_"+studentId).remove();
         }
     }
  </script>
</head>

<body>


<div class="container">

  <h1>Student List</h1>
  <div class="row">
      <div class="col-xs-12 section5 text-right">
            <a href="/majestic/run.php/Student/add">ADD NEW </a> ｜ <a href="/majestic/run.php">List</a>
      </div>
  </div>

  <table class="table table-bordered sortable" id="student">
    <thead>
      <tr>
        <th>Enrollment Year</th>
        <th>No. Of Student</th>
      </tr>
    </thead>

    <tbody>
     <?php if(count($rows) > 0) {
     foreach($rows as $row) {
     ?>
      <tr>
        <td><?php echo $row->e_year;?></td>
        <td><?php echo $row->total ;?></td>
      </tr>
   <?php }  }?>

    </tbody>

  </table>

</div>


</body>

</html>