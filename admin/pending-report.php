<?php
$page = "Expenses";



require_once '../_config/dbconnect.php';



require_once '../classes/pending.class.php';



$Pendings = new  Pending();





if(isset ($_GET['dayreport']) ){



    $pendingbox=$Pendings->pendingchartday($_GET['dayreport']);



    $totalresult=$Pendings->pendingDayamount();



    }





    if(isset ($_GET['monthreport']) ){



        $pendingbox=$Pendings->pendingchartmonth($_GET['monthreport']);

    

        $totalresult=$Pendings->pendingMonthamount();

    

        }





        if(isset ($_GET['yearreport']) ){



            $pendingbox=$Pendings->pendingchartyear($_GET['yearreport']);

        

            $totalresult=$Pendings->pendingYearamount();

        

            }

    









    require_once '../classes/institutedetails.class.php';



    $Pending = new  InstituteDetails();



    $result=$Pending->instituteShow();



    

    ?>



    <!DOCTYPE html>



    <html lang="en">

    

    <head>



        <meta charset="utf-8" />



        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    

        <title>Accountant/ Expenses - NiceAdmin Bootstrap Template</title>



        <meta content="" name="description" />



        <meta content="" name="keywords" />

    

        <!-- Favicons -->



        <link href="../admin/assets/img/favicon.png" rel="icon" />



        <link href="../admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />



        <link href="path/to/file/interface.css" rel="stylesheet" type="text/css">

    

        <!-- Google Fonts -->



        <link href="https://fonts.gstatic.com" rel="preconnect" />



        <link

            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"

            rel="stylesheet" />

    

        <!-- Vendor CSS Files -->



        <link href="../admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />



        <link href="../admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />



        <link href="../admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />



        <link href="../admin/assets/vendor/quill/quill.snow.css" rel="stylesheet" />



        <link href="../admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet" />



        <link href="../admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet" />



        <link href="../admin/assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    

        <!-- Template Main CSS File -->



        <link href="../admin/assets/css/expenses.report.css" rel="stylesheet" />

    

        <!-- =======================================================

      * Template Name: NiceAdmin - v2.2.2

      * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/

      * Author: BootstrapMade.com

      * License: https://bootstrapmade.com/license/

      ======================================================== -->

        <style>
        th,p,h4,h6{
        text-transform: capitalize;
        }
        </style>

    </head>

    



    <body>

    

    

        <section>



            <?php



            foreach($result as $row){

    

            ?>

    

            <div class="custom-container">



                <div class="custom-body ">



                    <div class="card-body ">



                        <div class="row">



                            <div class="col-sm-9">



                                <h2><?php    echo $row['institute_name']  ?></h2>



                                <p style="font-size: 14px;"><?php    echo $row['about']  ?><br>



                                    <?php    echo $row['address']  ?> <br>



                                </p>



                            </div>



                            <div class="col-sm-3 border-start border-dark " style="line-height: 0.5rem;">



                                <h4 class="ps-4">Pending Report</h4>



                                <h6 class="ps-4">Pending Fees / <?php if(isset($_GET['dayreport'])){echo $_GET['dayreport'];}; 



                                                         if(isset($_GET['monthreport'])){echo $_GET['monthreport'];};



                                                         if(isset($_GET['yearreport'])){echo $_GET['yearreport'];}; 



                                                         ?>



                                </h6>



                            </div>



                        </div>



                    </div>



                    <!-- <h3 class=" d-flex align-item-center justify-content-center mb-2 fs-4 mt-0">Expenses Report

                    </h3> -->

    

                    <!-- 

                    <div class="row  mt-5"> -->

                    <!-- <div class="col-lg-8 m-auto mt-2">

                            <div class="card">

                                <div class="card-body" style="padding-bottom: 0rem;">

                                   

                                    <div id="barChart" style="min-height: 400px;" class="echart"></div>

    

                                    <script>

                                    document.addEventListener("DOMContentLoaded", () => {

                                        echarts.init(document.querySelector("#barChart")).setOption({

                                            xAxis: {

                                                type: 'category',

                                                data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']

                                            },

                                            yAxis: {

                                                type: 'value'

                                            },

                                            series: [{

                                                data: [120, 200, 150, 80, 70, 110, 130],

                                                type: 'bar'

                                            }]

                                        });

                                    });

                                    </script>

                                    End Bar Chart

    

                                </div>

                            </div>

                        </div>

                         -->

                    <!-- </div> -->

    

                    <?php 



                    if ($pendingbox == 0) {



                    echo "<h2>No Data Avilable.</h2>";



                    }



                    else



                    {

    

                        while ($row = $totalresult ->fetch_object()):



                          $pen_amount = $row->Total;

                    ?>

    

                    <table class="table table-sm table-bordered mt-3">



                        <thead>

    



                            <tr>



                                <th>Name</th>

                                <th>Total Fees</th>

                                <th>Tolat Paid</th>

                                <th>Tolat Due</th>

                                <th>Roll No</th>

                                <th>Class</th>

                                <th>Date</th>    

                            </tr>



                        </thead>



                        <tbody>



                            <?php 



                       foreach ($pendingbox as $showStudentDetailsshow) {



                        $showname     = $showStudentDetailsshow['name'];

                        $showclass     = $showStudentDetailsshow['class'];

                        $showstudentid   = $showStudentDetailsshow['student_id'];

                        $showamount   = $showStudentDetailsshow['last_paid'];



                        $showtotal    = $showStudentDetailsshow['total_due'];

                        $showtotals   = number_format($showtotal, 2);

                        $showadded_by = $showStudentDetailsshow['added_by'];  
                        
                        $showdate     = $showStudentDetailsshow['date'];



                        $datetring    = date("d-m-Y", strtotime($showdate));


                        $pendingfees=$Pendings->pen_studentfees($showstudentid);
                        
                        foreach ($pendingfees as $showStudentfees) {
                            // $showstudentids   = $showStudentfees['student_id'];
                            $showtotal_amounts   = $showStudentfees['total_amount'];
                            $showroll_no         = $showStudentfees['roll_no'];
                            $totalpaids          = $showtotal_amounts - $showtotal;
                            $totalpaid           = number_format($totalpaids, 2);
                            $showtotal_amount    = number_format($showtotal_amounts, 2);

                               echo '<tr>

                      <td>'.$showname.'</td>

                      <td>'.$showtotal_amount.'</td>  
                      
                      <td>'.$totalpaid.'</td>

                      <td>'.$showtotals.'</td>

                      <td>'.$showroll_no.'</td>

                      <td>'.$showclass.'</td>

                      <td>'.$datetring.'</td>

                      </tr>';

    

                       } 
                    }
                       ?>

    

                        </tbody>



    

                        <tr>



                            <th></th>

                            <th></th>

                            <th> Total Pending </th>                        

                            <th style="color: red;">₹ <?php echo $pen_amount; ?></th>                         

                            <th></th>

                            <th></th>

                        </tr>

    

                        </thead>

    

                    </table>

                    <p class="ps-4">date: <?php echo date("d.m.y");?></p>

                </div>



            </div>



            <?php

                                 

                               

                            endwhile;

                          

                            }

                            }

                                



                            ?>



    

        </section>

    

    

        <div class="justify-content-center print-sec d-flex my-5">



            <button class="btn btn-primary shadow mx-2" onclick="history.back()">Go Back</button>



            <button class="btn btn-primary shadow mx-2" onclick="window.print()">Print </button>



        </div>

    

        <!-- Vendor JS Files -->



        <script src="../admin/assets/vendor/apexcharts/apexcharts.min.js"></script>



        <script src="../admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        

        <script src="../admin/assets/vendor/chart.js/chart.min.js"></script>



        <script src="../admin/assets/vendor/echarts/echarts.min.js"></script>



        <script src="../admin/assets/vendor/quill/quill.min.js"></script>



        <script src="../admin/assets/vendor/simple-datatables/simple-datatables.js"></script>



        <script src="../admin/assets/vendor/tinymce/tinymce.min.js"></script>



        <script src="../admin/assets/vendor/php-email-form/validate.js"></script>



        <script src="../admin/assets/js/main.js"></script>

    

    

    

    </body>

    

    </html>