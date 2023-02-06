<?php
session_start();
$page = "Staff Notice";

require_once '../_config/dbconnect.php';
require_once '../classes/admin.class.php';
require_once '../classes/employee.class.php';
require_once '../classes/notice.class.php';
require_once '../classes/utility.class.php';
require_once '../includes/constant.php';
$Utility    = new Utility();
$Admin      = new Admin();
$emp        = new Employee();
$Notice     = new Notice();
$_SESSION['current-url'] = $Utility->currentUrl();
if (!isset($_SESSION['user_name']) && !isset($_SESSION['loggedin']) ) {
  header("Location: login.php");
  exit;
}

$insertEmpQuery=false;

if(isset ($_POST["submit"])){

$name   = $_POST["name"];
$notices = $_POST["notice"];
$subject = $_POST["subject"];
$staff_id = $_POST["staff_id"];
$oldsignature = $_POST["oldsignature"];

$image            = $_FILES[ 'signature' ][ 'name' ];
$image_size       = $_FILES[ 'signature' ][ 'size' ];
$image_tmp_name   = $_FILES[ 'signature' ][ 'tmp_name' ];
$image_folter     = 'image/'.$image;


if($image != ''){
    $c_image = $image;
 }else{
    $c_image = $oldsignature;
 }


$result = $emp->staff_noticeInsert($name, $notices, $subject, $c_image, $staff_id);

if($insertEmpQuery){

    echo "<script> alert('Notice Published Sucessfully! ');document.location='staffnotice.php' </script>";

 }else{

    echo "<script> alert('Notice Publishing Sucessfully!');document.location='staffnotice.php' </script>";

}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Forum/ Staff Notice || <?php echo SITE_NAME; ?></title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <?php require_once 'require/headerLinks.php';?>
    <style>
    .minecsssearch {
        margin-left: .6rem;
        width: 14rem;
    }

    @media (min-width:150px) and (max-width:320px) {
        .minecsssearch {
            margin-left: 0.6rem;
            width: 10rem;
        }
    }

    @media (min-width:150px) and (max-width:665px) {
        .database {
            width: 60% !important;
            overflow: hidden
        }
    }

    /* @media (max-width: 576px){
        .data {
            margin-left: 0.6rem;
            width: 10rem;
        }
    } */
    .arrow-up {
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        display: none;
        border-bottom: 5px solid #6c757d;
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
            <h1>Forum</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Forum</li>
                    <li class="breadcrumb-item active">Staff Notice</li>
                </ol>
            </nav>
        </div>


        <!-- textbox section start -->
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Sales Card -->
                        <div class="col-xxl-12 col-md-12">
                            <div class="card info-card sales-card p-4">

                                <?php
                        if(!$insertEmpQuery){
                        ?>

                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                                    enctype="multipart/form-data">
                                    <input type="hidden" class="form-control" name="staff_id" id="staff_id" required>
                                    <div class="row mb-3">
                                        <input class=" form-control  minecsssearch" list="datalistOptions" id='user_id'
                                            placeholder="Type to search..." autocomplete="off" name="name"
                                            onkeyup="getDetail(this.value)">

                                    </div>
                                    <div class="arrow-up" id="tabledata"></div>
                                    <div class="database row mb-3" style=" 
                               width: 20%;
                             max-height: 150px;
                             overflow: auto;                           
                             text-align: center;    
                             box-shadow: 0 0.4rem 1rem rgb(0 1 1 / 31%);      
                             cursor: pointer;   
                             position: absolute;                         
                             border-radius: 4.5px;
                             background-color: #c2dbf1;
                             z-index: 8;                      
                            " id="table-datas">
                                    </div>

                                    <div class="row mb-3">
                                        <input class=" form-control  minecsssearch" list="datalistOptions" id='subject'
                                            placeholder="Subject..." name="subject">
                                    </div>

                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" placeholder="Leave a comment here"
                                            id="floatingTextarea2" style="height: 200px " name="notice"></textarea>
                                        <label for="floatingTextarea2">Comments</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="upload-signature" class="form-label"> Upload previous signature of
                                            In-Charge:
                                        </label>

                                        <select class="form-select" id="form-select" aria-label="Default select example"
                                            name="oldsignature">
                                            <option selected disabled>Select Image</option>
                                            <?php
                                            $updatePage=$emp->showimage();
                                            foreach ($updatePage as $showstaffnoticeshow) {
                                                $showsignature  = $showstaffnoticeshow['signature'];
                                                $img            = "../image/".$showsignature;
                                            echo '<option value="'.$img.'">'.$img.'</option>';

                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="mb-3">
                                        <label for="upload-signature" class="form-label">Upload the signature of
                                            In-Charge:
                                        </label>
                                        <input class="form-control" id="formFile" type="file" name="signature"
                                            accept="image/png">
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <!-- <div class="col-sm-10"> -->
                                        <button type="submit" class="btn btn-primary " style="width: 14rem;"
                                            name="submit">Update</button>

                                        <!-- </div> -->
                                    </div>
                            </div>
                        </div>
                        </form>
                        <?php
                    }
                    ?>

                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>

        <!-- textbox section End-->
        <!-- card section start -->
        <section class="section dashboard">
            <div class="row">

                <?php
            $showNotice = $Notice->showEmpNotice();
            if (count($showNotice) > 0) {

                foreach($showNotice as $row){
                $showdate = $row['date'];
                $datetring = date("d-m-Y", strtotime($showdate));
                $showid = $row['id'];
                $shownotice = $row['notice'];
                $showname = $row['name'];
                echo' <div class="col-xxl-4 col-md-4 col-sm-4">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href=ajax/stanotice-dalete.ajax.php?id='.$showid.' onclick="return deleteNOTICE();" >Delete</a></li>
                                        <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#staffnoticeModalLabel" id="'.$showid.'" onclick="staffnotice(this.id);" href="#">Modify</a></li>
                                    </ul>
                            </div>
                            <a href="./notice-pdf-report.php?staffid='.$showid.'">
                        <div class="card-body">
                        <h5 class="card-title">'.$datetring.'</h5>
                        <h5 class="card-title">'.$showname.'</h5>
                        <p>'.$shownotice.'</p> 
                        </a>
                    </div>
                </div>
                </div><!-- End Sales Card --> 
                ';
            }
        }else{
            echo '<div class="w-50 m-auto border bg-light py-3">
                    <p class="m-auto text-center text-danger">No Notice Avilable</p>
                </div>';
        }

        
        ?>
                <!-- card section end -->
            </div>
        </section>


        <!-- table End -->
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php require_once 'require/addfooter.php'; ?>


    <!-- Modal -->
    <div class="modal fade" id="staffnoticeModalLabel" tabindex="-1" aria-labelledby="staffnoticeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body staffnotice-modal-body">

                </div>
            </div>
        </div>
    </div>

    <!-- modal end -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script>
    const staffnotice = (id) => {
        let url = 'ajax/staffnoticeedit.ajax.php?staffnoticedata=' + id;
        $(".staffnotice-modal-body").html(
            '<iframe width="99%" height="412px" frameborder="0" allowtransparency="true" src="' + url +
            '"></iframe>')

    }



    function deleteNOTICE() {

        return confirm("Aru you sure want to delete this record ?")

    };
    </script>

    <script type="text/javascript">
    function getDetail(searchFor) {

        var searchword = $('#user_id').val();

        $.ajax({

            url: "ajax/staff-list.ajax.php",

            type: "POST",

            data: {

                search: searchFor

            },

            success: function(data) {

                $("#table-datas").html(data);

            }

        });

        if (searchword.length == 0) {

            document.getElementById("table-datas").style.display = "none";

        } else {

            document.getElementById("table-datas").style.display = "block";

        }

        if (searchword.length == 0) {

            document.getElementById("tabledata").style.display = "none";

        } else {

            document.getElementById("tabledata").style.display = "block";

        }

    };
    </script>



    <script>
    const selectdatas = (t) => {

        let name = document.getElementById(t.id).childNodes[1];

        let staff_id = document.getElementById(t.id).childNodes[3];

        if (window.getComputedStyle(staff_id).visibility === "hidden") {

            staff_id.style.visibility = "visible";

        }

        document.getElementById("user_id").value = name.innerText;

        document.getElementById("staff_id").value = staff_id.innerText;

        document.getElementById("table-datas").style.display = "none";

        document.getElementById("table-datas").style.display = "none";
        document.getElementById("tabledata").style.display = "none";
    }


    function deletunit() {

        return confirm("Aru you sure want to delete this record ?");

    };
    </script>



</body>

</html>