<?php

session_start();

$page = "Revenue";

require_once '../_config/dbconnect.php';

require_once '../classes/admin.class.php';

require_once '../classes/revenue.class.php';

require_once '../classes/utility.class.php';

require_once '../includes/constant.php';

require_once '../classes/vendor.class.php';

require_once '../classes/head_of_accounts.class.php';

require_once '../classes/employee.class.php';

$vendors    = new Vendor();

$Utility    = new Utility();

$Admin      = new Admin();

$revenues   = new Revenue();

$HFA        = new HeadOfAccounts();

$Employee   = new Employee();

$_SESSION['current-url'] = $Utility->currentUrl();

if (!isset($_SESSION['user_name']) && !isset($_SESSION['loggedin']) ) {

  header("Location: login.php");

  exit;

}

$studentday    = $revenues->studentfeesDay();

$studentmonth  = $revenues->studentfeesMonth();

$studentyear   = $revenues->studentfeesYear();

$studenttotal  = $revenues->studentfeesTotal();

$studentfees   = $revenues->revenueStudentdisplay();

$donationday   = $revenues->donationsDay();

$donationmonth = $revenues->donationsMonth();

$donationyear  = $revenues->donationsYear();

$donationtotal = $revenues->donationtotalamount();

$donationdata  = $revenues->donationdataDisplay();

$othersday     = $revenues->othersfeesDay();

$othersmonth   = $revenues->othersfeesMonth();

$othersyear    = $revenues->othersfeesYear();

$otherstotal   = $revenues->otherstotalamount();

$othersdata    = $revenues->revenueothersdisplay();

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Accountant/ Revenue - <?php echo SITE_NAME; ?></title>

    <meta content="" name="description">

    <meta content="" name="keywords">
    <?php require_once 'require/headerLinks.php';?>
    <!-- =======================================================

  * Template Name: NiceAdmin - v2.2.2

  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/

  * Author: BootstrapMade.com

  * License: https://bootstrapmade.com/license/

  ======================================================== -->

    <style>
    .addnewbtncss {

        margin: auto;

        display: flex;

        align-items: center;

        margin-right: 1rem;

        margin-top: -2.6rem;



    }



    @media (min-width:150px) and (max-width:390px) {

        .addnewbtncss {

            margin: 0rem;

            display: flex;

            align-items: center;

            margin-right: 0rem;

            margin-top: -1.2rem;

        }

    }



    .addnewbtncss1 {

        margin: auto;

        display: flex;

        align-items: center;

        margin-right: 1rem;

        margin-top: -2.7rem;



    }



    @media (min-width:150px) and (max-width:405px) {

        .addnewbtncss1 {

            margin: 0rem;

            display: flex;

            align-items: center;

            margin-right: 0rem;

            margin-top: -1rem;

        }

    }
    </style>

</head>



<body>



    <!-- ======= Header ======= -->

    <?php require_once 'require/navigationbar.php'; ?>

    <!-- End Header -->

    <!--======== sidebar ========-->

    <?php require_once 'require/sidebar.php'; ?>

    <!--======== End sidebar ========-->



    <main id="main" class="main">

        <div class="pagetitle">

            <h1>Revenue</h1>

            <nav>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                    <li class="breadcrumb-item">Accountant</li>

                    <li class="breadcrumb-item active">Revenue</li>

                </ol>

            </nav>

        </div>

        <!-- End Page Title -->

        <!-- Student Details  -->

        <!-- Card Div for report -->


        <section class="section dashboard">
            <h5 class="card-title" style="color: #0d6efd;">STUDENT FEES</h5>

            <div class="col-sm-12">

                <div class="row">

                    <!-- Sales Card -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenuestudent-report.php?dayreport=Today <?php echo date("l") ?>">

                                <?php

                           while ($row = $studentday ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Students <span>| Today</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php
                                                //  $rowamount = $row['amount'];
                                                 $row->Total  = number_format($row->Total, 2);
                                              
                                                echo $row->Total ; if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                              endwhile;

                        ?>

                    <!-- sales no-2 -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenuestudent-report.php?monthreport=Month <?php echo date('M') ?>">

                                <?php

                           while ($row = $studentmonth ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Students <span>| Last Month</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                echo $row->Total ; if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                    endwhile;

                        ?>

                    <!-- sales no-3 -->



                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenuestudent-report.php?yearreport=Year <?php echo date('Y') ?>">

                                <?php

                           while ($row = $studentyear ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Students <span>| Last Year</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                 echo $row->Total ; if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                              endwhile;

                        ?>

                    <!-- sales no-4 -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenuestudent-report.php?totalreport=Total">

                                <?php

                           while ($row = $studenttotal ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Students <span>| Total</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                 echo $row->Total ; if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                              endwhile;

                        ?>

                    <!-- date-selector start -->

                    <section>

                        <div class="card p-3 justify-content-center">

                            <div class="container">

                                <div class="row">

                                    <div class="col-lg-4 col-md-4">

                                        <form action="revenuestudent-report.php" method="GET">

                                            <div class="row mb-3 ">

                                                <label for="inputDate">From Date</label>

                                                <div>

                                                    <input type="date" class="form-control" name="searchstudent"
                                                        value="<?php if(isset($_GET['searchstudent'])){echo $_GET['searchstudent']; }?>">

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-lg-4 col-md-4">

                                        <div class="row mb-3 ">

                                            <label for="inputDate">To Date</label>

                                            <div>

                                                <input type="date" class="form-control" name="searchstudents"
                                                    value="<?php if(isset($_GET['searchstudents'])){echo $_GET['searchstudents']; }?>" />

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-md-4 ">

                                        <div class="row mb-3 pt-4">

                                            <button type="text" class="btn btn-primary"
                                                style="margin: auto; display: inline-flex; width: 68%;justify-content: center; ">Find</button>

                                        </div>

                                    </div>

                                </div>

                                </form>

                            </div>

                        </div>

                    </section>

                    <!-- date-selector end -->

                </div>

            </div>

        </section>

        <!-- Card Div for report end -->

        <section class="section dashboard">

            <!-- Recent Sales -->

            <div class="col-12">

                <div class="card recent-sales overflow-auto">

                    <div class="card-body">

                        <h5 class="card-title">Student Fees </h5>

                        <button type="button" class="btn btn-primary mb-4 addnewbtncss" data-bs-toggle="modal"
                            data-bs-target="#revenuestudentModalLabel" onclick="addFeesRevenue();"> Add Student Fees

                        </button>



                        <!-- Modal -->

                        <div class="modal fade" id="revenuestudentModalLabel" tabindex="-1"
                            aria-labelledby="revenuestudentModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-xl">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body revenuestudent-modal-body">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- modal end -->

                        <table class="table table-borderless datatable ">

                            <thead>

                                <tr>

                                    <th scope="col">S.No</th>

                                    <th scope="col">Name</th>

                                    <th scope="col">Roll.No</th>

                                    <th scope="col">class</th>

                                    <th scope="col">Fees</th>

                                    <th scope="col">Date</th>

                                    <th scope="col">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                     $i=1;

                              foreach($studentfees as $row){

                               $showdate =  $row['date'];

                                $datetring = date("d-m-Y", strtotime($showdate));

                                ?>

                                <tr
                                    <?php if ($row['status']== 'active') echo ' style="color: black"' ; if ($row['status']== 'inactive') echo 'style="color: red"' ;?>>

                                    <td><?php    echo $i  ?></td>

                                    <td><?php    echo $row['name']  ?></td>

                                    <td><?php    echo $row['roll_no']  ?></td>

                                    <td><?php    echo $row['class']  ?></td>

                                    <td class="text-primar"><?php 
                                   $rowamount = $row['amount'];
                                    $rowamount  = number_format($rowamount, 2);
                                       echo $rowamount;  ?></td>

                                    <td><?php    echo $datetring  ?></td>

                                    <td>

                                        <i class="bi bi-eye-fill pe-4" data-bs-toggle="modal"
                                            data-bs-target="#feesRevenueModal" id="<?php    echo $row['id']  ?>"
                                            onclick="feesRevenue(this.id);"></i>

                                        <!-- Modal -->

                                        <div class="modal fade" id="feesRevenueModal" tabindex="-1"
                                            aria-labelledby="feesRevenueModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-lg">

                                                <div class="modal-content">

                                                    <div class="modal-header">

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>

                                                    </div>

                                                    <div class="modal-body feesRevenue-modal-body">

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- modal end -->

                                        <a
                                            href='../admin/ajax/revenuefeescancel.action.php?id=<?php    echo $row['id']  ?>'>

                                            <i class="bi bi-x-lg" onclick="return cancel();"
                                                <?php  if ($row['status']== 'inactive') echo 'style="display: none;"' ;?>>

                                            </i>

                                        </a>

                                        <a style="color: #35dc59"
                                            href='../admin/ajax/revenuefeesactive.action.php?id=<?php    echo $row['id']  ?>'>

                                            <i class="bi bi-check-lg " onclick="return activerevenuefees();"
                                                <?php if ($row['status']== 'active') echo ' style="display: none;"' ;?>>

                                            </i>

                                        </a>

                                    </td>

                                </tr>

                                <?php $i++; } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>

        <section class="section dashboard">

            <h5 class="card-title" style="color: #0d6efd;">DONATION</h5>

            <div class="col-sm-12">

                <div class="row">

                    <!-- Sales Card -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenueDonation-report.php?todayreport=Today <?php echo date("l") ?>">

                                <?php

                           while ($row = $donationday ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Donation <span>| Today</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                echo $row->Total ; if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                              endwhile;

                        ?>

                    <!-- sales no-2 -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenueDonation-report.php?monthreport=Month <?php echo date('M') ?>">

                                <?php

                           while ($row = $donationmonth ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Donation <span>| Last Month</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                echo $row->Total ; if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                              endwhile;

                        ?>

                    <!-- sales no-3 -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenueDonation-report.php?yearreport=Year <?php echo date('Y') ?>">

                                <?php

                           while ($row = $donationyear ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Donation <span>| Last Year</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                echo $row->Total ; if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                              endwhile;

                        ?>



                    <!-- sales no-4 -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenueDonation-report.php?totalreport=Total">

                                <?php

                           while ($row = $donationtotal ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Donation <span>| Total</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                echo $row->Total ; if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                              endwhile;

                        ?>

                </div>

            </div>

        </section>

        <!-- date-selector start -->

        <section>

            <div class="card p-3 justify-content-center">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-4 col-md-4 ">

                            <form action="revenueDonation-report.php" method="GET">

                                <div class="row mb-3 ">

                                    <label for="inputDate">From Date</label>

                                    <div>

                                        <input type="date" class="form-control" name="searchdonations"
                                            value="<?php if(isset($_GET['searchdonations'])){echo $_GET['searchdonations']; }?>">

                                    </div>

                                </div>

                        </div>

                        <div class="col-lg-4 col-md-4 ">

                            <div class="row mb-3 ">

                                <label for="inputDate">To Date</label>

                                <div>

                                    <input type="date" class="form-control" name="searchdonation"
                                        value="<?php if(isset($_GET['searchdonation'])){echo $_GET['searchdonation']; }?>" />

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-4 col-md-4 ">

                            <div class="row mb-3 pt-4">

                                <button type="text" class="btn btn-primary"
                                    style="margin: auto; display: inline-flex; width: 68%;justify-content: center; ">Find</button>

                            </div>

                        </div>

                    </div>

                    </form>

                </div>

            </div>

        </section>

        <!-- date-selector end -->


        <section>

            <div class="card p-3 justify-content-center">

                <div class="container">

                    <div class="row">

                        <h5 class="card-title">Details Of Donation</h5>


                        <div class="col-lg-2 col-md-2">

                            <form action="revenueDonation-report.php" method="POST">

                                <div class="row mb-3 ">

                                    <div>

                                        <select class="form-select" aria-label="Default select example"
                                            name="duration_EMP" id="duration_EMP" required>
                                            <option disabled selected value>Select Duration</option>

                                            <option value="<?php echo date("l") ?>">Today
                                            </option>
                                            <option value="<?php echo date('M') ?>">Last Month
                                            </option>
                                            <option value="<?php echo date('Y') ?>">Last Year
                                            </option>
                                            <option value="Total">Total
                                            </option>
                                        </select>

                                    </div>

                                </div>

                        </div>



                        <div class="col-lg-3 col-md-3">

                            <div class="row mb-3 ">

                                <div>

                                    <select class="form-select" aria-label="Default select example"
                                        onclick="getcategoryDonation(this.value)" name="typpe_data" id="typpe_data"
                                        required>
                                        <option disabled selected value>Select Type</option>
                                        <option value="Employee">Employee (Donation Through)</option>
                                        <option value="cancel">Cancel Data</option>
                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-3 col-md-3">

                            <div class="row mb-3 ">

                                <div>

                                    <select class="form-select" aria-label="Default select example"
                                        name="donation_data" id="donation_data" required>
                                        <option disabled selected value>Select Type First</option>

                                    </select>

                                </div>

                            </div>

                        </div>




                        <!-- <div class="col-lg-4 col-md-4">

                            <div class="row mb-3 ">

                                <div>

                                    <select class="form-select" aria-label="Default select example" name="employee"
                                        id="employee" required>
                                        <option disabled selected value>Select Employee</option>

                                        <?php
                             $emps =$Employee->showEmployees();

                             foreach ($emps as $emp) {
                                 $empId   = $emp['user_id'];
                                 $empName = $emp['name'];
                                 echo ' <option value="'.$empName.'">'.$empName.'</option>';
                             }
                            ?>
                                    </select>

                                </div>

                            </div>

                        </div> -->


                        <div class="col-lg-4 col-md-4">

                            <div class="row mb-3">

                                <button type="text" class="btn btn-primary"
                                    style="margin: auto; display: inline-flex; width: 68%;justify-content: center; ">Show</button>



                            </div>

                        </div>

                    </div>

                    </form>

                </div>

            </div>


        </section>

        <!-- date-selector end -->
     
        <section class="section dashboard">

            <!-- Recent Sales -->

            <div class="col-12">

                <div class="card recent-sales overflow-auto">

                    <div class="card-body">

                        <h5 class="card-title">Donation Details </h5>

                        <!-- Button trigger modal -->

                        <button type="button" class="btn btn-primary mb-4 addnewbtncss1" data-bs-toggle="modal"
                            data-bs-target="#donationModalLabel" onclick="revenuedonation();"> Add Donation

                        </button>

                        <!-- Modal -->

                        <div class="modal fade" id="donationModalLabel" tabindex="-1"
                            aria-labelledby="donationModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body donation-modal-body">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- modal end -->

                        <table class="table table-borderless datatable ">

                            <thead>

                                <tr>

                                    <th scope="col">S.No</th>

                                    <th scope="col">Name</th>

                                    <th scope="col">Address</th>

                                    <th scope="col">Description</th>

                                    <th scope="col">Amount</th>

                                    <th scope="col">Date</th>

                                    <th scope="col">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                    $i=1;

                                    foreach($donationdata as $row){ 
                                        $description = $row['description'];
                                        $showdonationdate =  $row['date'];

                                        $donationdatetring = date("d-m-Y", strtotime($showdonationdate));

                                    ?>

                                <tr
                                    <?php if ($row['status']== 'active') echo ' style="color: black"' ; if ($row['status']== 'inactive') echo 'style="color: red"' ;?>>

                                    <td><?php    echo $i  ?></td>

                                    <td><?php    echo $row['name']  ?></td>

                                    <td><?php    echo $row['address']  ?></td>

                                    <td><?php    echo substr("$description",0,18)." ...";  ?></td>

                                    <td><?php   $rowamount = $row['amount'];
                                                $rowamount  = number_format($rowamount, 2);
                                                echo $rowamount;  ?></td>

                                    <td><?php    echo $donationdatetring  ?></td>

                                    <td>

                                        <i class="bi bi-eye-fill pe-4" data-bs-toggle="modal"
                                            data-bs-target="#editdonationModalLabel" id="<?php    echo $row['id']  ?>"
                                            onclick="editrevenuedonation(this.id);"></i>

                                        <!-- Modal -->

                                        <div class="modal fade" id="editdonationModalLabel" tabindex="-1"
                                            aria-labelledby="editdonationModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-lg">

                                                <div class="modal-content">

                                                    <div class="modal-header">

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>

                                                    </div>

                                                    <div class="modal-body editdonation-modal-body">

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- modal end -->

                                        <a href='ajax/donationcancel.action.php?id=<?php    echo $row['id']  ?>'>

                                            <i class="bi bi-x-lg" data-bs-toggle="modal"
                                                data-bs-target="#deleteformModal" onclick="return canceldonation();"
                                                <?php  if ($row['status']== 'inactive') echo 'style="display: none;"' ;?>>

                                            </i>

                                        </a>

                                        <a style="color: #35dc59"
                                            href='../admin/ajax/donationactive.action.php?id=<?php    echo $row['id']  ?>'>

                                            <i class="bi bi-check-lg " data-bs-toggle="modal"
                                                data-bs-target="#deleteformModal" onclick="return activedonation();"
                                                <?php if ($row['status']== 'active') echo ' style="display: none;"' ;?>>

                                            </i>

                                        </a>

                                    </td>

                                </tr>

                                <?php $i++; }  ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>
       
        <section class="section dashboard">

            <h5 class="card-title" style="color: #0d6efd;">OTHER REVENUE</h5>

            <div class="col-sm-12">

                <div class="row">

                    <!-- Sales Card -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenueOthers-report.php?todayreport=Today <?php echo date("l") ?>">

                                <?php

                           while ($row = $othersday ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Others <span>| Today</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                echo $row->Total ;  if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                         endwhile;

                        ?>

                    <!-- sales no-2 -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenueOthers-report.php?monthreport=Month <?php echo date('M') ?>">

                                <?php

                           while ($row = $othersmonth ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Others <span>| Last Month</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                echo $row->Total ;  if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                              endwhile;

                        ?>

                    <!-- sales no-3 -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenueOthers-report.php?yearreport=Year <?php echo date('Y') ?>">

                                <?php

                           while ($row = $othersyear ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Others <span>| Last Year</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                echo $row->Total ;  if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                              endwhile;

                        ?>

                    <!-- sales no-4 -->

                    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-6">

                        <div class="card info-card sales-card">

                            <a href="revenueOthers-report.php?totalreport=Total">

                                <?php

                           while ($row = $otherstotal ->fetch_object()):

                            ?>

                                <div class="card-body pt-2" style="padding: 0 0px 0px 20px;">

                                    <h7 class="card-title">Others <span>| Total</span></h7>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                            <i class="bi bi-cart"></i>

                                        </div>

                                        <div class="ps-3">

                                            <h6 style="font-size: 23px;">₹

                                                <?php  $row->Total  = number_format($row->Total, 2);
                                                echo $row->Total ;  if ($row->Total== 0) echo 0;?></h6>

                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                    <?php

                              endwhile;

                        ?>

                </div>

            </div>

        </section>

        <!-- date-selector start -->

        <section>

            <div class="card p-3 justify-content-center">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-4 col-md-4 ">

                            <form action="revenueOthers-report.php" method="GET">

                                <div class="row mb-3 ">

                                    <label for="inputDate">From Date</label>

                                    <div>

                                        <input type="date" class="form-control" name="searchother"
                                            value="<?php if(isset($_GET['searchother'])){echo $_GET['searchother']; }?>">

                                    </div>

                                </div>

                        </div>

                        <div class="col-lg-4 col-md-4 ">

                            <div class="row mb-3 ">

                                <label for="inputDate">To Date</label>

                                <div>

                                    <input type="date" class="form-control" name="searchothers"
                                        value="<?php if(isset($_GET['searchothers'])){echo $_GET['searchothers']; }?>">

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-4 col-md-4 ">

                            <div class="row mb-3 pt-4">

                                <button type="text" class="btn btn-primary"
                                    style="margin: auto; display: inline-flex; width: 68%;justify-content: center; ">Find</button>

                            </div>

                        </div>

                    </div>

                    </form>

                </div>

            </div>

        </section>

        <!-- date-selector end -->





        <section>

            <div class="card p-3 justify-content-center">

                <div class="container">

                    <div class="row">

                        <h5 class="card-title">Details Of Other Revenue</h5>


                        <div class="col-lg-2 col-md-2">

                            <form action="revenueOthers-report.php" method="POST">

                                <div class="row mb-3 ">

                                    <div>

                                        <select class="form-select" aria-label="Default select example" name="duration"
                                            id="duration" required>
                                            <option disabled selected value>Select Duration</option>

                                            <option value="<?php echo date("l") ?>">Today
                                            </option>
                                            <option value="<?php echo date('M') ?>">Last Month
                                            </option>
                                            <option value="<?php echo date('Y') ?>">Last Year
                                            </option>
                                            <option value="Total">Total
                                            </option>

                                        </select>

                                    </div>

                                </div>

                        </div>


                        <div class="col-lg-3 col-md-3">

                            <div class="row mb-3 ">

                                <div>

                                    <select class="form-select" aria-label="Default select example"
                                        onclick="getcategory(this.value)" name="select_typpe" id="select_typpe"
                                        required>
                                        <option disabled selected value>Select Type</option>

                                        <option value="HFA">Head Of Accounts</option>
                                        <option value="Vendors">Vendors </option>
                                        <option value="Employee">Employee (Other Revenue Through)</option>
                                        <option value="cancel">Cancel Data</option>
                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-3 col-md-3">

                            <div class="row mb-3 ">

                                <div>

                                    <select class="form-select" aria-label="Default select example"
                                        name="head_of_account" id="head_of_account" required>
                                        <option disabled selected value>Select Type First</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-4 col-md-4">

                            <div class="row mb-3">

                                <button type="text" class="btn btn-primary"
                                    style="margin: auto; display: inline-flex; width: 68%;justify-content: center; ">Show</button>



                            </div>

                        </div>

                    </div>

                    </form>

                </div>

            </div>


        </section>


        <!-- Other Revenues Section Start -->

        <section class="section dashboard">

            <!-- Recent Sales -->

            <div class="col-12">

                <div class="card recent-sales overflow-auto">

                    <div class="card-body">

                        <h5 class="card-title">Other Revenues </h5>

                        <!-- Button trigger modal -->

                        <button type="button" class="btn btn-primary mb-4 addnewbtncss1" data-bs-toggle="modal"
                            data-bs-target="#addotherrevenuModal" onclick="addOtherRevenue();">

                            Add Other Revenue

                        </button>

                        <!-- Modal -->

                        <div class="modal fade" id="addotherrevenuModal" tabindex="-1"
                            aria-labelledby="addotherrevenuModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body otherrevenu-modal-body">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- modal end -->

                        <table class="table table-borderless datatable">

                            <thead>

                                <tr>

                                    <th scope="col">S.No</th>

                                    <th scope="col">Head Of Accounts</th>

                                    <th scope="col">Amount</th>

                                    <th scope="col">Date</th>

                                    <th scope="col">Action</th>

                                    <!-- <th>Status</th> -->

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                        $i=1;

                                        foreach($othersdata as $row){

                                            $showothersdate =  $row['date'];

                                            $othersdatetring = date("d-m-Y", strtotime($showothersdate));
                                          
                                        ?>

                                <tr
                                    <?php if ($row['status']== 'active') echo ' style="color: black"' ; if ($row['status']== 'inactive') echo 'style="color: red"' ;?>>

                                    <td><?php    echo $i  ?></td>

                                    <td>
                                        <?php $categorydata =$HFA->categoryById($row['source']);                              
                                        foreach($categorydata as $rows){ 
                                        $category_name   = $rows['category'];
                                        echo $category_name;
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <?php   $rowamount = $row['amount'];
                                                $rowamount  = number_format($rowamount, 2);
                                                echo $rowamount;  ?>
                                    </td>

                                    <td>
                                        <?php    echo $othersdatetring  ?>
                                    </td>

                                    <td>

                                        <i class="bi bi-eye-fill pe-4" data-bs-toggle="modal"
                                            data-bs-target="#editothersModalLabel" id="<?php    echo $row['id']  ?>"
                                            onclick="editOthersRevenue(this.id);"></i>

                                        <!-- Modal -->

                                        <div class="modal fade" id="editothersModalLabel" tabindex="-1"
                                            aria-labelledby="editothersModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-lg">

                                                <div class="modal-content">

                                                    <div class="modal-header">



                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>

                                                    </div>

                                                    <div class="modal-body editothers-modal-body">

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- modal end -->

                                        <!-- </td>

                                                <td> -->

                                        <a href='../admin/ajax/otherscancel.action.php?id=<?php    echo $row['id']  ?>'>

                                            <i class="bi bi-x-lg " data-bs-toggle="modal"
                                                data-bs-target="#deleteformModal" onclick="return cancelothers();"
                                                <?php  if ($row['status']== 'inactive') echo 'style="display: none;"' ;?>>

                                            </i>

                                        </a>

                                        <a style="color: #35dc59"
                                            href='../admin/ajax/othersactive.action.php?id=<?php    echo $row['id']  ?>'>

                                            <i class="bi bi-check-lg " data-bs-toggle="modal"
                                                data-bs-target="#deleteformModal" onclick="return activeOthers();"
                                                <?php if ($row['status']== 'active') echo ' style="display: none;"' ;?>>

                                            </i>

                                        </a>

                                    </td>

                                </tr>

                                <?php

                                        $i++;  }  

                                        ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            </div>

        </section>

        <!-- Other Revenues Section Start -->



        <!-- Donation Details end -->

        <!-- </div>

        </section> -->

        <!-- Donation Details end -->







    </main><!-- End #main -->



    <!-- ======= Footer ======= -->

    <?php require_once 'require/addfooter.php'; ?>





    <!-- Modal -->



    <div class="modal fade" id="revenuestudentModalLabel" tabindex="-1" aria-labelledby="revenuestudentModalLabel"
        aria-hidden="true">



        <div class="modal-dialog modal-lg">



            <div class="modal-content">



                <div class="modal-header">



                    <h5 class="modal-title" id="revenuestudentModalLabel">

                        Forms

                    </h5>



                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>



                </div>



                <div class="modal-body revenuestudent-modal-body">



                </div>



                <div class="modal-footer">



                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        Close

                    </button>



                </div>



            </div>



        </div>



    </div>



    <!-- modal end -->





    <!-- Modal -->

    <div class="modal fade" id="feesRevenueModal" tabindex="-1" aria-labelledby="feesRevenueModalLabel"
        aria-hidden="true">



        <div class="modal-dialog modal-lg">



            <div class="modal-content">



                <div class="modal-header">



                    <h5 class="modal-title" id="feesRevenueModalLabel">

                        Forms

                    </h5>



                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>



                </div>



                <div class="modal-body feesRevenue-modal-body">



                </div>



                <div class="modal-footer">



                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        Close

                    </button>



                </div>



            </div>



        </div>





    </div>



    <!-- modal end -->







    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">

    </script>



    <script>
    function cancel() {



        return confirm("DO YOU REALLY WANT TO CANCEL REVENUE CONTENTS OF THIS STUDENT ?")



    };


    function activerevenuefees() {

        return confirm("DO YOU REALLY WANT TO ACTIVE REVENUE CONTENTS OF THIS STUDENT ?")

    };




    function canceldonation() {



        return confirm("DO YOU REALLY WANT TO CANCEL REVENUE CONTENTS OF THIS DONATION ?")



    };



    function cancelothers() {



        return confirm("DO YOU REALLY WANT TO CANCEL REVENUE CONTENTS OF THIS OTHERS ?")



    };



    function activeOthers() {

        return confirm("DO YOU REALLY WANT TO ACTIVE REVENUE CONTENTS OF THIS OTHERS ?")

    };



    function activedonation() {

        return confirm("DO YOU REALLY WANT TO ACTIVE REVENUE CONTENTS OF THIS DONATION ?")

    };

    // ============ Fees Revenue Functions ============



    const addFeesRevenue = () => {





        let url = 'ajax/revenuestudentfees.ajax.php';



        $(".revenuestudent-modal-body").html(

            '<iframe width="100%" height="645px" frameborder="0" allowtransparency="true" src="' + url +

            '"></iframe>')



    }



    const feesRevenue = (id) => {



        let url = 'ajax/revenuestudentedit.ajax.php?editdata=' + id;

        $(".feesRevenue-modal-body").html(

            '<iframe width="100%" height="600px" frameborder="0" allowtransparency="true" src="' + url +

            '"></iframe>')



    }



    // ============ Donation Revenue Functions ============



    const revenuedonation = () => {



        let url = 'ajax/donation-revenue.ajax.php';

        $(".donation-modal-body").html(

            '<iframe width="100%" height="627px" frameborder="0" allowtransparency="true" src="' + url +

            '"></iframe>')



    }



    const editrevenuedonation = (id) => {



        let url = 'ajax/donation-edit.ajax.php?data=' + id;

        $(".editdonation-modal-body").html(

            '<iframe width="100%" height="600px" frameborder="0" allowtransparency="true" src="' + url +

            '"></iframe>')



    }





    // ============ Others Revenue Functions ============



    const addOtherRevenue = () => {



        let url = 'ajax/others-revenue-add.ajax.php';

        $(".otherrevenu-modal-body").html(

            '<iframe width="100%" height="550px" frameborder="0" allowtransparency="true" src="' + url +

            '"></iframe>')



    }



    const editOthersRevenue = (id) => {



        let url = 'ajax/others-revenue-edit.ajax.php?editothers=' + id;

        $(".editothers-modal-body").html(

            '<iframe width="100%" height="590px" frameborder="0" allowtransparency="true" src="' + url +

            '"></iframe>')



    }



    const getcategory = (value) => {
        subcategoryList = document.getElementById("head_of_account");
        console.log(value);
        // alert(value);
        var xmlhttp = new XMLHttpRequest();
        if (value != "") {

            //==================== SubCategory List ====================
            subcategory = 'ajax/getcategory.ajax.php?category=' + value;
            // alert(url);
            xmlhttp.open("GET", subcategory, false);
            xmlhttp.send(null);
            subcategoryList.innerHTML = xmlhttp.responseText;
            console.log(xmlhttp.responseText);
            // if (xmlhttp.responseText != "") {
            //     subcategoryList.style.display = 'block';
            //     document.getElementById("subdata").style.display = 'block';
            // } else {
            //     subcategoryList.style.display = 'none';
            //     document.getElementById("subdata").style.display = 'none';
            // }
        }

    }



    const getcategoryDonation = (value) => {
        subcategoryList = document.getElementById("donation_data");
        console.log(value);
        var xmlhttp = new XMLHttpRequest();
        if (value != "") {

            //==================== SubCategory List ====================
            subcategory = 'ajax/getcategory.ajax.php?category=' + value;
            // alert(url);
            xmlhttp.open("GET", subcategory, false);
            xmlhttp.send(null);
            subcategoryList.innerHTML = xmlhttp.responseText;
            console.log(xmlhttp.responseText);
          
        }

    }
    </script>



</body>



</html>