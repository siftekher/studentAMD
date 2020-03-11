<!DOCTYPE html>

<html>

<head>

  <title>Majestic demo</title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>


<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat|Open+Sans');
body {
    font-family: 'Open Sans', sans-serif;
    font-family: 'Montserrat', sans-serif;
}
input[type="text"], input[type="email"] {
    font-size: 1.6rem;
    color: #010100;
    width: 100%;
    line-height: 65px;
    padding-left: 3rem;
}
select {
    width: 100%;
    height: 65px;
    color: #010100;
    padding-left: 3rem;
}
.h1, h1 {
    font-size: 36px;
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-top: 20px;
    margin-bottom: 10px;
}
.text-white {
    color: #fff!important;
}
.font-w400 {
    font-weight: 400;
}
.padding-top-xl {
    padding-top: 5rem!important;
}
.padding-bottom-xl {
    padding-bottom: 5rem!important;
}
.margin-top-m {
    margin-top: 3rem!important;
}
.margin-bottom-m {
    margin-bottom: 3rem!important;
}
.section5 h2 {
    line-height: 35px;
}
.section5 p {
    font-size: 16px;
    line-height: 26px;
}
.has-error input[type="text"], .has-error input[type="email"], .has-error select {
    border: 1px solid #a94442;
}
</style>

<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({format : "DD/MM/YYYY"});
                $('#datetimepicker2').datetimepicker({format : "DD/MM/YYYY"});
            });
        </script>
</head>

<body>


<div class="container">
  <div class="row">
      <div class="col-xs-12 section5 text-right">
           <a href="/majestic/run.php">Back to List</a>
      </div>
  </div>

<?php if(count($rows) > 0) {
foreach($rows as $row) {
     ?>
<section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
  <div class="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 section5 text-center">
          <h2 class="h1 font-w400">Edit Student</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

          <form name="contentForm" enctype="multipart/form-data" method="POST" action="/majestic/run.php/Student/update_student" role="form" data-toggle="validator" novalidate="true">
          <input type="hidden" id="studentId" name="studentId" value="<?php echo $row->student_id;?>">
          <div class="form schedule-assessment">
            <div class="row margin-top-l">
            <div class="form-group col-md-6">
              <label for="first_name" class="sr-only">First Name: </label>
              <input name="first_name" id="first_name" placeholder="First name" type="text" value="<?php echo $row->first_name;?>" required="required" data-error="Please enter your first name.">
              <div class="help-block with-errors"></div>
            </div><!-- close col-->
            <div class="form-group col-md-6">
              <label for="last_name" class="sr-only">Last Name: </label>
              <input name="last_name" id="last_name" placeholder="Last Name" type="text" value="<?php echo $row->last_name;?>" required="required" data-error="Please enter your last name.">
              <div class="help-block with-errors"></div>
            </div><!-- close col-->
            </div><!-- close row-->

            <div class="row">
               <div class="form-group col-md-6">
                 <label for="date_of_birth" class="sr-only">Date of Birth: </label>

                  <div class='input-group date' id='datetimepicker1'>
                      <input name="date_of_birth" id="date_of_birth" placeholder="Date of Birth" type="text" value="<?php echo date("d/m/Y", strtotime($row->date_of_birth));?>" required="required" data-error="Please enter your Date of Birth.">
                      <div class="help-block with-errors"></div>
                      <!-- <input type='text' class="form-control" /> -->
                      <span class="input-group-addon">
                         <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>

               </div>
               <div class="form-group col-md-6">
                 <label for="enrollment_date" class="sr-only">Enrolment Date: </label>
                  <div class='input-group date' id='datetimepicker2'>
                      <input name="enrollment_date" id="enrollment_date" placeholder="Enrolment Date" type="text" value="<?php echo date("d/m/Y", strtotime($row->enrollment_date));?>" required="required" data-error="Please enter your Enrolment Date.">
                      <div class="help-block with-errors"></div>
                      <!-- <input type='text' class="form-control" /> -->
                      <span class="input-group-addon">
                         <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
                </div>
            </div>
            <div class="row">
            <div class="form-group col-md-6">
              <label for="email" class="sr-only">Email Address: </label>
              <input name="email" id="email" placeholder="Email Address" type="email" value="<?php echo $row->email;?>" required="required" data-error="Please enter a valid email.">
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group col-md-6">
              <label for="select_options" class="sr-only">What is Current School year? </label>
              <select name="current_school_year" required="required" data-error="Please select current school year.">
              <option value="">What is Current School year?</option>
              <option value="7" <?php if( $row->current_school_year == 7) echo 'selected';?> >7</option>
              <option value="8" <?php if( $row->current_school_year == 8) echo 'selected';?>>8</option>
              <option value="9" <?php if( $row->current_school_year == 9) echo 'selected';?>>9</option>
              <option value="10" <?php if( $row->current_school_year == 10) echo 'selected';?>>10</option>
              <option value="11" <?php if( $row->current_school_year == 11) echo 'selected';?>>11</option>
              <option value="12" <?php if( $row->current_school_year == 12) echo 'selected';?>>12</option>
              </select>
              <div class="help-block with-errors"></div>
            </div>
            </div><!-- close row-->

            <div class="row">
               <div class="form-group col-md-6">
                  <label for="home_phone" class="sr-only">Home Phone: </label>
                  <input name="home_phone" id="home_phone" placeholder="Home Phone" type="text" value="<?php echo $row->home_phone;?>" required="required" data-error="Please enter home phone.">
                  <div class="help-block with-errors"></div>
               </div>

               <div class="form-group col-md-6">
                  <label for="mobile" class="sr-only">Home Phone: </label>
                  <input name="mobile" id="mobile" placeholder="mobile" type="text" value="<?php echo $row->mobile;?>" required="required" data-error="Please enter mobile number.">
                  <div class="help-block with-errors"></div>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-6">
                  <label for="first_contact_name" class="sr-only">First contact name: </label>
                  <input name="first_contact_name" id="first_contact_name" placeholder="First contact name" type="text" value="<?php echo $row->first_contact_name;?>" required="required" data-error="Please enter First contact name.">
                  <div class="help-block with-errors"></div>
               </div>

               <div class="form-group col-md-6">
                  <label for="first_contact_phone" class="sr-only">First contact phone: </label>
                  <input name="first_contact_phone" id="first_contact_phone" placeholder="First contact phone" type="text" value="<?php echo $row->first_contact_phone;?>" required="required" data-error="Please enter First contact phone.">
                  <div class="help-block with-errors"></div>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-6">
                  <label for="second_contact_name" class="sr-only">Second contact name: </label>
                  <input name="second_contact_name" id="second_contact_name" placeholder="First contact phone" type="text" value="<?php echo $row->second_contact_name;?>" required="required" data-error="Please enter Second contact name.">
                  <div class="help-block with-errors"></div>
               </div>

               <div class="form-group col-md-6">
                  <label for="second_contact_phone" class="sr-only">Second contact phone: </label>
                  <input name="second_contact_phone" id="second_contact_phone" placeholder="Second contact phone" type="text" value="<?php echo $row->second_contact_phone;?>" required="required" data-error="Please enter Second contact phone.">
                  <div class="help-block with-errors"></div>
               </div>
            </div>

            <div class="row">
               <span class="control-fileupload">
                  <label for="file">Choose a file :</label>
                  <input type="file" id="file" name="file">
                </span>
            </div>


            <div class="form-group text-center">
            <input class="submit center-block btn btn-primary" value="Update" type="submit">
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
 <?php }  }?>

</div>


</body>



</html>