<?php
session_start();
$page = "Student Details";

require_once '../_config/dbconnect.php';
require_once '../classes/admin.class.php';
require_once '../classes/studdetails.class.php';
require_once '../classes/institutedetails.class.php';
require_once '../classes/studdetails.class.php';
require_once '../classes/student.class.php';
require_once '../classes/fees-accounts.class.php';





$Admin                  = new Admin();
$Institute              = new InstituteDetails();                                
$StudentDetails         = new StudentDetails();
$Student                = new Student();
$FeesAccount                  = new FeesAccount();


$result                 = $Institute->instituteShow();

$showStudentDetails   = $Student->studentByClass($_GET['class']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Student Management / Student Details / NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/css/fontawesome-all.min.css" rel="stylesheet">
    <?php require_once "require/headerLinks.php"; ?>
</head>

<body>
    <!-- ======= Header ======= -->
    <?php require_once 'require/navigationbar.php'; ?>
    <!-- End Header -->


    <main id="main" class="main w-100 ms-0">

        <div class="pagetitle">
            <h1>Student Summary</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="addnewstudent.php">Student
                            Management</a></li>
                    <li class="breadcrumb-item "><a href="studentdetails.php">Student
                            Details </a></li>
                    <li class="breadcrumb-item active">Class <?php   echo $_GET['class']  ?></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">

            <div class="row">
                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto p-4">
                        <form method="POST" action="ajax/stuSummary.action.php?class=<?php   echo $_GET['class']  ?>">
                            <table class="table">

                                <thead>
                                    <tr>
                                        <th scope="col">Roll no</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Guardian Name</th>
                                        <th scope="col">Student Id</th>
                                        <th scope="col">gurdian Name</th>
                                        <th scope="col">Exam Status</th>
                                    </tr>
                                </thead>

                                <tbody>


                                    <div class="row mb-3">

                                        <!-- =============== -->

                                        <label class="col-sm-2 col-form-label">Academic Year :</label>
                                        <div class="col-sm-4">

                                            <input type="text" class="form-control"
                                                value="<?php  echo  $_GET['session']  ?>" name="session" id="session"
                                                readonly>

                                        </div>

                                        <!-- =============== -->


                                        <?php
                                        $i=1;
                 if ($showStudentDetails == 0) {
                  echo "No data Type Avilable.";
                 }else{
               foreach ($showStudentDetails as $showStudentDetailsshow) {
                $showclass            = $showStudentDetailsshow['class'];
                $showname             = $showStudentDetailsshow['name'];
                $showstuid            = $showStudentDetailsshow['student_id'];
                $showid               = $showStudentDetailsshow['id'];
                $showroll_no          = $showStudentDetailsshow['roll_no'];
                $showgurdian_name     = $showStudentDetailsshow['gurdian_name'];
                $showstream           = $showStudentDetailsshow['stream'];

                $showaddress          = $showStudentDetailsshow['address'];
                $showcontact_no       = $showStudentDetailsshow['contact_no'];
                
                $showpost_office      = $showStudentDetailsshow['post_office'];
                $showpolice_station   = $showStudentDetailsshow['police_station'];
                $showpin_code         = $showStudentDetailsshow['pin_code'];

                $showsdo_or_bdo       = $showStudentDetailsshow['sdo_or_bdo'];
                $showdistrict         = $showStudentDetailsshow['district'];
                $showstate	          = $showStudentDetailsshow['state'];
                $showdate_of_birth    = $showStudentDetailsshow['date_of_birth'];
                $showadded_by         = $showStudentDetailsshow['added_by'];
                $showadded_on         = $showStudentDetailsshow['added_on'];
              

                $showacademic_year    = $showStudentDetailsshow['academic_year'];
                $showdate             = $showStudentDetailsshow['date'];

                $StudentDetails   = $FeesAccount->schowAmount($showstuid, $showacademic_year);
                foreach ($StudentDetails as $showStudentDetails) {

                    $showtotal_amount     = $showStudentDetails['payable_fee'];
                    $showtotal_due        = $showStudentDetails['total_due'];

                    
                $myuid = uniqid('inp');
                $idbtn = uniqid('btn');

                $shownameid    = $showid.$myuid.$_GET['class'];
                $showbtnid     = $showid.$idbtn.$_GET['class'];
                $showstudentid = $showid.$idbtn.$showstuid 

                         ?>


                                        <tr>
                                            <td>
                                                <?php  echo  $i;        ?>
                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showstuid;  ?>" name="student_id[]" id="id">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showclass;  ?>" name="class" id="class">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showroll_no;  ?>" name="roll_no[]"
                                                    id="roll_no">


                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showaddress;  ?>" name="address[]"
                                                    id="address">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showcontact_no;  ?>" name="contact[]"
                                                    id="roll_no">

                                            </td>
                                            <td>
                                                <?php  echo  $showname;  ?>
                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showname;  ?>" name="name[]" id="name">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showpost_office;  ?>" name="post_office[]"
                                                    id="post_office">
                                            </td>
                                            <td>
                                                <?php  echo  $showgurdian_name;  ?>
                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showgurdian_name;  ?>" name="gurdian[]"
                                                    id="gurdian">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showtotal_amount;  ?>" name="total_amount[]"
                                                    id="roll">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showstream;  ?>" name="stream[]" id="stream">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showtotal_due;  ?>" name="total_due[]"
                                                    id="total_due">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showpolice_station;  ?>"
                                                    name="police_station[]" id="police_station">
                                            </td>

                                            <td>
                                                <?php  echo  $showstuid;  ?>

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showpin_code;  ?>" name="pin_code[]"
                                                    id="total_due">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showsdo_or_bdo;  ?>" name="sdo_or_bdo[]"
                                                    id="sdo_or_bdo">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showstate;  ?>" name="state[]"
                                                    id="district">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showdistrict;  ?>" name="district[]"
                                                    id="district">
                                            </td>

                                            <td>
                                                <?php  echo  $showgurdian_name;  ?>

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showdate_of_birth;  ?>" name="date_of_birth[]"
                                                    id="date_of_birth">

                                                    <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showadded_by;  ?>" name="dded_by[]"
                                                    id="dded_by">


                                                    <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showadded_on;  ?>" name="added_on[]"
                                                    id="added_on">

                                                    <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showdate;  ?>" name="date[]"
                                                    id="date">

                                                    <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showacademic_year;  ?>" name="academic_year[]"
                                                    id="academic_year">
                                            </td>


                                            <td>

                                                    <input type="text" maxlength="3" id="<?php  echo $shownameid  ?>"
                                                        style="width: 4rem;" name="exam_status[]" required>
                                                    <label class="form-check-label ps-3" id="<?php  echo $showbtnid ?>"
                                                        onclick='setAbsent("<?php    echo $shownameid  ?>", this.id)'>
                                                        P
                                                    </label>

                                                    <label class="form-check-label ps-3" id="<?php  echo $showbtnid ?>"
                                                        onclick='setAbsents("<?php    echo $shownameid  ?>", this.id)'>
                                                        F
                                                    </label>

                                                </td>


                                        </tr>

                                        <?php
                                                $i++;  }}}
                                                ?>

                                </tbody>
                            </table>
                            <div class=" d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary" name="Submitdata">All Submit</button>
                            </div>

                            <!-- <div class=" d-flex justify-content-center align-items-center">     
                                <button type = "button" class="btn btn-primary"><a href = "http://localhost/institute1/admin/studentdetails.php">Back</a></button>
                                </div> -->

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script scr="ajax.js"></script> -->
    <!-- End #main -->


    <?php require_once 'require/addfooter.php'; ?>

    <script>
    const setAbsent = (i, btnId) => {
        console.log(i);

        let input = document.getElementById(i);
        let btn = document.getElementById(btnId);
        if (input.readOnly) {
            input.readOnly = false;
            input.value = "";

        } else {
            input.readOnly = true;
            input.value = "Pass";

        }
    }

    const setAbsents = (i, btnId) => {
        console.log(i);

        let inputs = document.getElementById(i);
        let btns = document.getElementById(btnId);
        if (inputs.readOnly) {
            inputs.readOnly = false;
            inputs.value = "";

        } else {
            inputs.readOnly = true;
            inputs.value = "Faill";

        }
    }
    </script>


</body>

</html>










<?php
session_start();
$page = "Student Details";

require_once '../_config/dbconnect.php';
require_once '../classes/studdetails.class.php';
require_once '../classes/student.class.php';
require_once '../classes/admin.class.php';
require_once '../classes/exam.class.php';

require_once '../classes/utility.class.php';

require_once '../includes/constant.php';

$Utility        = new Utility(); 

$Admin          = new Admin();
$Student        = new Student();
$Examination    = new Examination();

$showStudentDetails   = $Student->studentByClass($_GET['studenttype'], $_GET['session']);
$showStudentfinalexam = $Examination->examByClassName($_GET['studenttype'], $_GET['session']);

$_SESSION['current-url'] = $Utility->currentUrl();

if (!isset($_SESSION['user_name']) && !isset($_SESSION['loggedin']) ) {

  header("Location: login.php");

  exit;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Studentclass - <?php echo SITE_NAME; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php require_once 'require/headerLinks.php'; ?>
</head>

<body>
    <!-- ======= Header ======= -->
    <?php require_once 'require/navigationbar.php'; ?>
    <!-- ===== End Header ===== -->

    <!--======== sidebar ========-->
    <?php require_once 'require/sidebar.php'; ?>
    <!--======== End sidebar ========-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Student Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="http://localhost/institute1/admin/addnewstudent.php">Student
                            Management</a></li>
                    <li class="breadcrumb-item "><a href="http://localhost/institute1/admin/studentdetails.php">Student
                            Details</a></li>
                    <li class="breadcrumb-item active">Class <?php  echo $_GET['studenttype']  ?></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <div class="row">
            <!-- Sales Card -->

            <?php
     
     if ($showStudentfinalexam == 0) {
      echo "Not Avilable.";
     }else{
   foreach ($showStudentfinalexam as $showStudentDetailsshow) {
    $showclass = $showStudentDetailsshow['id'];
    $showexam_name = $showStudentDetailsshow['exam_name'];
   
    // foreach ($showStudentDetails as $showStudentDetailsshow) {
    //     $showstream = $showStudentDetailsshow['stream'];}
           $studenttypeclass=$_GET['studenttype'];
    $showstu = "unit-test.php?studentunittest1type=".$showexam_name;
   echo '<div class="col-xxl-3 col-md-3">
                <div class="card">
                    <a href="'.$showstu.'&studentgettypedata='.$studenttypeclass.'">
                        <div class="card-body" style="padding: 20px 20px 20px 20px;">
                            <h5 class="card-title" style="text-align: center;">'.$showexam_name.'<i class="bi bi-check-circle-fill ps-3" style="color: #10c910;font-size: 1.5rem;"></i>
                            </h5>
                        </div>
                    </a>
                </div>
            </div>';}}?>
            <!-- sales end -->
            <!-- sales -->
            <div class="col-xxl-3 col-md-3">
                <div class="card">
                    <a
                        href='submit_subject_marks.php?studentgettypesub=<?php    echo $_GET['studenttype']  ?>&session=<?php    echo $_GET['session']  ?>'>
                        <div class="card-body" style="padding: 20px 20px 20px 20px;">
                            <h5 class="card-title" style="text-align: center;">Submit Marks
                                <img src="assets/img/doc.png  " style="height: 28px; padding-left:1rem;" alt="">
                            </h5>
                        </div>
                    </a>
                </div>
            </div>
            <!-- sales  end -->
  <!-- sales -->
  <div class="col-xxl-3 col-md-3">
                <div class="card">
                    <a
                        href='student_summary.php?class=<?php    echo $_GET['studenttype']  ?>&session=<?php    echo $_GET['session']  ?>'>
                        <div class="card-body" style="padding: 20px 20px 20px 20px;">
                            <h5 class="card-title" style="text-align: center;">Student Summary
                                <img src="assets/img/doc.png  " style="height: 28px; padding-left:1rem;" alt="">
                            </h5>
                        </div>
                    </a>
                </div>
            </div>
            <!-- sales  end -->

        </div>
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto p-4">



                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.No</th>
                                            <th scope="col">Roll Number</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Guardian's Name</th>
                                            <th scope="col">Student Id</th>
                                            <th scope="col">Exam Status</th>
                                            <th scope="col">Attendance</th>
                                            <th scope="col">Fees Status</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Marksheet</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i=1;
                                        if ($showStudentDetails == 0) {
                                        echo "No data Type Avilable.";
                                        }else{
                                        foreach ($showStudentDetails as $showStudentDetailsshow) {
                                        $showclass1         = $showStudentDetailsshow['class'];
                                        $showname           = $showStudentDetailsshow['name'];
                                        $showstuid          = $showStudentDetailsshow['student_id'];
                                        $showid             = $showStudentDetailsshow['id'];
                                        $showroll_no        = $showStudentDetailsshow['roll_no'];
                                        $showgurdian_name   = $showStudentDetailsshow['gurdian_name'];
                                        $showstream         = $showStudentDetailsshow['stream'];
                                        $showacademic_year  = $showStudentDetailsshow['academic_year'];

                                        $showStudentmarks = $Student->maxmarks($showclass1, $showacademic_year);
                                        foreach($showStudentmarks as $row){
                                        $totalnumber = $row['sum_marks'];
                                        }
                                        $showStudent = $Student->Totalmarks($showstuid, $showclass1, $showacademic_year);
                                        foreach($showStudent as $rowsdata){
                                        $showtotal = $rowsdata['sum'];
                                        $Percentage      = ($showtotal*100) / $totalnumber;
                                        $Percentage = round($Percentage,2);

                                        if($Percentage == intval($Percentage))
                                        {
                                        $Percentage = intval($Percentage);
                                        }

                                        }


                                        ?>

                                        <tr
                                            <?php if ($showStudentDetailsshow['status']== 'active') echo 'style="color: black"' ; if ($showStudentDetailsshow['status']== 'inactive') echo 'style="color: red"' ;?>>
                                            <td><?php  echo $i                ?></td>
                                            <td><?php  echo $showroll_no      ?></td>

                                            <td><?php  echo $showname ?></td>
                                            <td><?php  echo $showgurdian_name ?></td>
                                            <td><?php  echo $showstuid ?></td>
                                            <td>
                                             <?php 
                                             if($Percentage > 40){
                                                echo "pass";
                                                }else{
                                                 echo "Faill";
                                                }   
                                                // echo $Percentage;                                           
                                             ?>
                                            </td>
                                            <td> <a
                                                    href='attendance-report.php?studentid=<?php    echo $showstuid  ?>&class=<?php    echo $showclass1  ?>'>
                                                    <i class="bi bi-eye-fill pe-4"></i>
                                                </a></td>

                                            <td><?php 
                                             $showstu = "pendingfees.ajax.php?feespending=". $showstuid;

                                             $result=$Student-> studentsByFees($showstuid);

                                             foreach ($result as $showrow) {
                                              $showamount          = $showrow['Total'];
                                              $showtotal_amount    = $showrow['total_amount'];
                                              $showdate            = $showrow['date'];

                                              
                                              $pendingamount       = $showtotal_amount - $showamount;

                                              $monthly             = $showtotal_amount / 12;
                                  
                                              
                                              $month               = date("m");
                                  
                                              $monthPending        = $month*$monthly - $showamount;
                                             
                                              if($showamount == $month*$monthly ){

                                                echo '<span class="badge bg-success ps-3 pe-3">Paid</span>'; 
                                
                                                } if($showamount > $month*$monthly ) {
                                
                                                echo '<span class="badge bg-primary">Advanced</span>';
                                
                                                }
                                                if($showamount < $month*$monthly ) {
                                
                                                    echo '<span class="badge bg-warning">Pending</span>';
                                    
                                                    }
                                
                                                // if($showamount == 0 && $showamount != 0) echo '<span class="badge bg-danger">Reject</span>';
                                            
                                               ?>


                                                <i class="bi bi-hourglass-split ps-4" data-bs-toggle="modal"
                                                    data-bs-target="#pendingfeesModal" id="<?php    echo $showstuid  ?>"
                                                    onclick="pendingfees(this.id);"></i>
                                                <!-- Modal -->
                                                <div class="modal fade" id="pendingfeesModal" tabindex="-1"
                                                    aria-labelledby="pendingfeesModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="pendingfeesModalLabel">

                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body pendingfees-modal-body">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal end -->
                                                <?php } ?>

                                                <!-- <span class="badge bg-success">No Data</span> -->

                                            </td>


                                            <td>

                                                <i class="bi bi-eye-fill pe-4" data-bs-toggle="modal"
                                                    data-bs-target="#editstudentclassModal"
                                                    id="<?php    echo $showid  ?>"
                                                    onclick="editstudentclass(this.id);"></i>
                                                <!-- Modal -->
                                                <div class="modal fade" id="editstudentclassModal" tabindex="-1"
                                                    aria-labelledby="editstudentclassModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body editstudentclass-modal-body">

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal end -->
                                                <a
                                                    href='../admin/ajax/sp.action.php?id=<?php    echo $showStudentDetailsshow['id']  ?>'>
                                                    <i class="bi bi-x-lg" data-bs-toggle="modal"
                                                        data-bs-target="#deleteformModal" onclick="return cancel();"
                                                        <?php  if ($showStudentDetailsshow['status']== 'inactive') echo 'style="display: none;"' ;?>>
                                                    </i>
                                                </a>

                                                <a style="color: #35dc59"
                                                    href='../admin/ajax/stuactive.action.php?id=<?php    echo $showStudentDetailsshow['id']  ?>'>
                                                    <i class="bi bi-check-lg " data-bs-toggle="modal"
                                                        data-bs-target="#deleteformModal"
                                                        onclick="return activedonation();"
                                                        <?php if ($showStudentDetailsshow['status']== 'active') echo ' style="display: none;"' ;?>>
                                                    </i>
                                                </a>

                                            </td>

                                            <td><a
                                                    href="marks-report.php?studentclass=<?php    echo $_GET['studenttype']  ?>&studentid=<?php    echo $showstuid  ?>&session=<?php    echo $_GET['session']  ?>&stream=<?php    echo $showstream  ?>"><i
                                                        class="bi bi-file-earmark-arrow-down-fill pe-4"></i>
                                                </a></td>

                                        </tr>

                                        <?php  
                                        $i++;
                                      }   }
                                      ?>

                                    </tbody>

                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php require_once 'require/addfooter.php'; ?>
    <script>
    function cancel() {
        return confirm("Are you sure that you want to cancel the student details contents ?")
    };

    function activedonation() {
        return confirm("Are you sure that you want to active the student details contents ?")
    };
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
    const editstudentclass = (id) => {
        let url = 'ajax/editstudentclass.ajax.php?studentdata=' + id;
        $(".editstudentclass-modal-body").html(
            '<iframe width="99%" height="529px" frameborder="0" allowtransparency="true" src="' + url +
            '"></iframe>')

    }


    const pendingfees = (id) => {
        let url = 'ajax/pendingfees.ajax.php?feespending=' + id;
        $(".pendingfees-modal-body").html(
            '<iframe width="99%" height="409px" frameborder="0" allowtransparency="true" src="' + url +
            '"></iframe>')

    }
    </script>

</body>

</html>