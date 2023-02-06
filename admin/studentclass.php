<?php
session_start();
$page = "Student Details";

require_once '../_config/dbconnect.php';
require_once '../classes/studdetails.class.php';
require_once '../classes/student.class.php';
require_once '../classes/admin.class.php';
require_once '../classes/exam.class.php';
require_once '../classes/studdetails.class.php';
require_once '../classes/fees-accounts.class.php';
require_once '../classes/utility.class.php';



$Utility   = new Utility(); 

$Admin          = new Admin();
$Student        = new Student();
$Examination    = new Examination();
$StudentDetails = new StudentDetails();
$FeesAccount                  = new FeesAccount();

$showStudentDetails   = $Student->studentByClass($_GET['studenttype']);
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

    <title>Components / List Group - NiceAdmin Bootstrap Template</title>
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

                            <form method="POST" action="ajax/stuSummary.action.php?class=<?php   echo $_GET['studenttype']  ?>">

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.No</th>
                                            <th scope="col">Roll Number</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Guardian's Name</th>
                                            <th scope="col">Student Id</th>
                                            <th scope="col">exam status</th>
                                            <th scope="col">class name</th>
                                            <th scope="col">Fees Status</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Marksheet</th>

                                            <th scope="col">New class-Fees</th>



                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i=1;
                 if ($showStudentDetails == 0) {
                  echo "No data Type Avilable.";
                 }else{
               foreach ($showStudentDetails as $showStudentDetailsshow) {

               $showclass1           = $showStudentDetailsshow['class'];
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
              
            //    }
               
            //    }
                         ?>

                                        <tr
                                            <?php if ($showStudentDetailsshow['status']== 'active') echo 'style="color: black"' ; if ($showStudentDetailsshow['status']== 'inactive') echo 'style="color: red"' ;?>>
                                            <td>

                                            <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showstuid;  ?>" name="student_id[]" id="id">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showclass1;  ?>" name="class" id="class">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showroll_no;  ?>" name="roll_no[]"
                                                    id="roll_no">


                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showaddress;  ?>" name="address[]"
                                                    id="address">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showcontact_no;  ?>" name="contact[]"
                                                    id="roll_no">

                                                                                          
                                            <?php  echo $i                ?>
                                           </td>
                                            <td>
                                                

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showname;  ?>" name="name[]" id="name">

                                                <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $showpost_office;  ?>" name="post_office[]"
                                                    id="post_office">

                                                    <input type="hidden" class="form-control form_data"
                                                    value="<?php  echo  $_GET['session'];  ?>" name="session"
                                                    id="session">
                                            
                                            
                                            <?php  echo $showroll_no      ?>
                                           </td>

                                            <td>
                                                
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
                                            
                                            <?php  echo $showname ?>
                                            </td>
                                            <td>
                                                
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
                                            
                                            <?php  echo $showgurdian_name ?>
                                           </td>
                                            <td>
                                                
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
                                            
                                            <?php  echo $showstuid ?>
                                            </td>
                                            <td>
                                                
                                            <input type="hidden" class="form-control form_data"
                                                    value="<?php   if($Percentage > 40){
                                                echo "pass";
                                                }else{
                                                 echo "Faill";
                                                }  ?>" name="exam_status[]"
                                                    id="exam_status">

                                                    <input type="hidden" class="form-control form_data"
                                                    value="<?php   if($Percentage > 40){
                                                echo $showclass1 + "1";
                                                }else{
                                                 echo $showclass1;
                                                }  ?>" name="newclass[]"
                                                    id="newclass">
                                                
                                                <?php 
                                             if($Percentage > 40){
                                                echo "pass";
                                                }else{
                                                 echo "Faill";
                                                }
                                                echo $Percentage;
                                           ?></td>

                                            <td><?php 
                                             if($Percentage > 40){
                                                echo $showclass1 + "1";
                                                }else{
                                                 echo $showclass1;
                                                }
                                                // echo $Percentage;
                                           ?></td>

                                            <td><?php 
                                             $showstu = "pendingfees.ajax.php?feespending=". $showstuid;

                                             $result=$Student-> studentsByFees($showstuid);

                                             foreach ($result as $showrow) {
                                              $showamount       = $showrow['Total'];
                                              $showtotal_amount = $showrow['total_amount'];
                                              $showdate         = $showrow['date'];

                                              
                                              $pendingamount      = $showtotal_amount - $showamount;

                                              $monthly            = $showtotal_amount / 12;
                                  
                                              
                                              $month              = date("m");
                                  
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
                                                <?php }
                                                } 
                                                // }
                 
                                                ?>

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
                                                                <h5 class="modal-title" id="editstudentclassModalLabel">
                                                                    Forms
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body editstudentclass-modal-body">

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
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

                                            <td><a
                                                    href="classupdate.php?class=<?php    echo $_GET['studenttype']  ?>&session=<?php    echo $_GET['session']  ?>&studentid=<?php    echo $showstuid  ?>"><i
                                                        class="bi bi-file-earmark-arrow-down-fill pe-4"></i>
                                                </a>


                                            </td>

                                        </tr>

                                        <?php  
                                        $i++;
                                      }   }
                                      ?>

                                    </tbody>

                                </table>



                                <div class=" d-flex justify-content-center align-items-center">
                                <button name="Submitdata" type="submit" style="margin-top: -2rem;"
                                    class="btn btn-primary d-flex justify-content-end ms-auto">
                                    All Submit
                                </button>
                           
                            </div>
                            </form>



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
        return confirm("Aru you sure want to Absent this record ?")
    };

    function activedonation() {
        return confirm("Aru you sure want to Active this record ?")
    };
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
    const editstudentclass = (id) => {
        let url = 'ajax/editstudentclass.ajax.php?studentdata=' + id;
        $(".editstudentclass-modal-body").html(
            '<iframe width="99%" height="354px" frameborder="0" allowtransparency="true" src="' + url +
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