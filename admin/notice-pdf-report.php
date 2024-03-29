<?php
session_start();
    $page = "notice-pdf-report";
    require_once '../_config/dbconnect.php';
    require_once '../classes/admin.class.php';
    require_once '../classes/institutedetails.class.php';
    require_once '../classes/employee.class.php';
    require_once '../classes/utility.class.php';
    require_once '../includes/constant.php';
    $Utility    = new Utility();
    $Admin      = new Admin();
    $Pending    = new InstituteDetails();
    $notic      = new Employee();
  
    if(isset ($_GET['id']) ){
    $updatePage=$notic->noticeupdatePage($_GET['id']);
    }

    if(isset ($_GET['staffid']) ){
        $updatePage=$notic->staffMessageupdatePage($_GET['staffid']);
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title> Forum / Notice Report || <?php echo SITE_NAME; ?></title>
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
    <link href="../admin/assets/css/notice-pdf-report.css" rel="stylesheet" />
    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
    th,
    p,
    h4,
    h6,
    div,
    p {
        text-transform: capitalize;
    }
    </style>

</head>

<body>
    <section class="section dashboard">
        <form method="POST" action="pdf.php">
            <?php
        $result=$Pending->instituteShow();
        foreach($result as $row){
            $institute_name         = $row['institute_name'];
            $showinstitute_name     = str_replace('"','\\',$institute_name);
            $abouts                 = $row['about'];
            $showabout              = str_replace('"','\\',$abouts);
            $about                  = str_replace("\r",'<br>',$abouts);
            $addressdata            = $row['address'];
            $showaddress            = str_replace('"','\\',$addressdata);
            $address                = str_replace("\r",'<br>',$addressdata);

        ?>
            <input type="hidden" class="form-control" value="<?php    echo $showinstitute_name  ?>"
                name="institute_name" required>
            <input type="hidden" class="form-control" value="<?php    echo $showabout  ?>" name="about" required>
            <input type="hidden" class="form-control" value="<?php    echo $showaddress  ?>" name="address" required>
            <div class="custom-container">
                <div class="custom-body">
                    <div class="card-body">
                        <div class="row" style="align-items: center;">
                            <div class="col-sm-2">
                                <img src="assets/img/1mg121.jpg" alt="Profile" class="rounded-circle w-100">
                                <!-- <h4 class="ps-4">Marksheet</h4>
                            <h6 class="ps-4">Class / 1</h6>
                            <p class="ps-4">date: 15/05/2022</p> -->
                            </div>
                            <div class="col-sm-10">
                                <h2><?php    echo $institute_name  ?></h2>
                                <p style="font-size: 14px;"><?php    echo $about  ?><br>
                                    <?php    echo $address  ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- <section class="section dashboard" style="
    padding-left: 3rem!important;
    padding-right: 3rem!important;
    padding-bottom: 3rem!important;
    " > -->
                    <?php
                foreach ($updatePage as $shownoticeshow) {
                $showid         = $shownoticeshow['id'];
                $notices        = $shownoticeshow['notice'];
                $shownotice     = str_replace('"','\\',str_replace("\n",'         ',$notices));
                $notice         = str_replace("\r",'<br>',$notices);
                $subjects       = $shownoticeshow['subject'];
                $showsubject    = str_replace('"','\\',$subjects);
                $subject        = str_replace("\r",'<br>',$subjects);
                $showsignature  = $shownoticeshow['signature'];
                $added_by       = $shownoticeshow['added_by'];
                $showadded_by   = str_replace('"','\\',$added_by);
                $img            = "image/".$showsignature;

                 ?>
                    <input type="hidden" class="form-control" value="<?php    echo $showid   ?>" name="id" required>
                    <input type="hidden" class="form-control" value="<?php    echo $shownotice   ?>" name="notice"
                        required>
                    <input type="hidden" class="form-control" value="<?php    echo $showsubject  ?>" name="subject"
                        required>
                    <input type="hidden" class="form-control" value="<?php    echo $showadded_by  ?>" name="added_by"
                        required>
                    <input type="hidden" class="form-control" value="<?php    echo $showsignature  ?>" name="img"
                        required>
                    <div class="col-lg-12">
                        <div class="notice-title-div" style="border-bottom: 2px solid black;">
                            <h2 class="notice-title">NOTICE</h2>
                        </div>
                        <P class="notice-title-div-p text-end"> Date : <?php    echo date('d M, Y'); ?></P>
                        <p class="notice-title-div-subject" style="text-align: left!important;">Subject : <?php    echo $subject  ?></p>
                        <?php if(isset($_GET['staffid'])){ $showname  = $shownoticeshow['name'];?>
                        <input type="hidden" class="form-control" value="<?php    echo $showname  ?>" name="staffname"
                            required>
                        <p class="notice-title-div-p mb-3">To : <?php echo $showname; ?>,<?php } ?></p>
                        
                          <p class="notice-title-div-p"> <?php    echo $notice  ?></p>

                        <p class="notice-title-div-p text-end">Respectfully ,</p>
                        <p class="notice-title-div-p text-end"><?php    echo $added_by;  ?></p>
                        <p class="notice-signature mb-2"> Signature : <img id="theImage" src="<?php    echo $img  ?>"
                                alt="bill-invoice" width="200" height="70" onClick="makeFullScreen()"></p>
                        <p class="notice-title-div-p" style="width: min-content;"> Place : <?php    echo  $row['address'];
                        ?></p>
                        <?php } } ?>
                    </div>
                    <!-- </section> -->




                    <div class="justify-content-center print-sec d-flex my-5">
                   
                        <button class="btn btn-primary shadow mx-2" id="pdf" type="submit" name="datapdf">Download
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script>
    `//get DIV content as clone
    var divContents = $("#DIVNAME").clone();
    //detatch DOM body
    var body = $("body").detach();
    //create new body to hold just the DIV contents
    document.body = document.createElement("body");
    //add DIV content to body
    divContents.appendTo($("body"));
    //print body
    window.print();
    //remove body with DIV content
    $("html body").remove();
    //attach original body
    body.appendTo($("html"));`
    </script>


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




    <script>
    // <!-- image fullscreen -->

    function makeFullScreen() {

        var divObj = document.getElementById("theImage");

        //Use the specification method before using prefixed versions

        if (divObj.requestFullscreen) {

            divObj.requestFullscreen();

        } else if (divObj.msRequestFullscreen) {

            divObj.msRequestFullscreen();

        } else if (divObj.mozRequestFullScreen) {

            divObj.mozRequestFullScreen();

        } else if (divObj.webkitRequestFullscreen) {

            divObj.webkitRequestFullscreen();

        } else {

            console.log("Fullscreen API is not supported");

        }

    }

    // <!-- image fullscreen end -->
    </script>

</body>

</html>