<?php
session_start();

$page ="Classes";


require_once '../_config/dbconnect.php';

require_once '../classes/admin.class.php';

require_once '../classes/institutedetails.class.php';

require_once '../classes/classes.class.php';

require_once '../classes/utility.class.php';

require_once '../includes/constant.php';




$InstituteDetails   = new InstituteDetails();

$Admin              = new Admin();

$Classes            = new Classes();

$Utility            = new Utility();





$_SESSION['current-url'] = $Utility->currentUrl();



if (!isset($_SESSION['user_name']) && !isset($_SESSION['loggedin']) ) {

  header("Location: login.php");

  exit;

}



$insertEmpQuery=false;



$updateEmpQuery=false;







if(isset ($_POST["Updateyear"])){







     $session = $_POST["session"];







        $result = $InstituteDetails->updateSession($session);







        if($result){



         echo "Academic Session Has Been Updated!<br>";



         }



        else{



          echo "Failed to update Session.<br>";



       



        }



     }







?>



<!DOCTYPE html>



<html lang="en">







<head>



    <meta charset="utf-8">



    <meta content="width=device-width, initial-scale=1.0" name="viewport">







    <title>Institute Management / Classes - <?php echo SITE_NAME; ?></title>



    <meta content="" name="description">



    <meta content="" name="keywords">







    <?php require_once 'require/headerLinks.php';?>







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



            <h1>Classes</h1>



            <nav>



                <ol class="breadcrumb">



                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>



                    <li class="breadcrumb-item">Institute Management</li>



                    <li class="breadcrumb-item active">Classes</li>



                </ol>



            </nav>



        </div><!-- End Page Title -->







        <section class="section dashboard" style="min-height: 62vh;">

            <div class="row">

                <div class="col-lg-6 ">

                    <div class="card recent-sales overflow-auto">

                        <div class="card-body">

                            <h5 class="card-title mb-0 mt-0">Classes </h5>

                            <table class="table datatable">

                                <thead>

                                    <tr>

                                        <th scope="col">S.NO</th>

                                        <th scope="col">Class Image</th>

                                        <th scope="col">Class Name</th>

                                        <th scope="col">Description</th>

                                        <th scope="col">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php
                                       $i=1;
                              $revenueresult = $Classes->classesList();

                              foreach($revenueresult as $row){
                                $description    = $row['description'];
                                $class_image    = $row['image'];
                                $img            = "image/".$class_image;
                            ?>

                                    <tr>

                                        <th scope="row"><?php    echo $i ?></th>

                                        <td><img src="<?php    echo $img;  ?>" width=40 height=40 alt=""
                                                onerror="this.src='assets/img/user.jpg';" width=40 height=40
                                                class="rounded-circle"></td>

                                        <td><?php    echo $row['classname']  ?></td>

                                        <td><?php    echo substr("$description",0,18)." ...";  ?></td>

                                        <td>

                                            <i class="bi bi-eye-fill pe-4" data-bs-toggle="modal"
                                                data-bs-target="#classFormModal" id="<?php echo $row['id']; ?>"
                                                onclick="classView(this.id);"></i>

                                            <a
                                                href='ajax/classdelete.ajax.php?id=<?php    echo $row['id']  ?>&img=<?php    echo $class_image  ?>'>

                                                <i class="bi bi-trash" data-bs-toggle="modal"
                                                    data-bs-target="#deleteclassFormModal"
                                                    onclick="return deleteClass();"></i>

                                            </a>

                                        </td>

                                    </tr>

                                    <?php
                                        $i++; 
                                            } ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="col-lg-6 ">

                    <div class="row">

                        <div class="col-lg-12 col-md-12">

                            <div class="card">

                                <div class="card-body">

                                    <h5 class="card-title">Add Class</h5>

                                    <!-- Class Addition Form -->

                                    <form method="POST" action="./ajax/class.acction.php"
                                        class="row needs-validation m-0" enctype="multipart/form-data" novalidate>

                                        <div class="row mb-3">

                                            <label for="inputText" class="col-sm-4 col-form-label">Class :</label>

                                            <div class="col-sm-8">

                                                <input type="number" maxlength="55" class="form-control" name="id"
                                                    required>

                                            </div>

                                        </div>


                                        <div class="row mb-3">

                                            <label for="inputText" class="col-sm-4 col-form-label">Class Name
                                                :</label>

                                            <div class="col-sm-8">

                                                <input type="text" maxlength="55" class="form-control" name="classname"
                                                    required>

                                            </div>

                                        </div>



                                        <div class="row mb-3">

                                            <label for="inputText" class="col-sm-4 col-form-label">Class Image
                                                :</label>

                                            <div class="col-sm-8">

                                                <input type="file" class="form-control" name="upload_image"
                                                    accept="image/*" required>

                                            </div>

                                        </div>

                                        <div class="row mb-3">

                                            <label for="inputAddress" class="col-sm-4 col-form-label">Description

                                                :</label>

                                            <div class="col-sm-8">

                                                <textarea class="form-control" style="height: 100px" name="description"
                                                    id="description" required></textarea>

                                            </div>

                                        </div>

                                        <div class="row mb-3">

                                            <div class="col-sm-12  d-flex justify-content-center align-items-center">

                                                <button type="submit" name="submitdata" class="btn btn-primary"
                                                    onclick="return checkWordCount()">Submit

                                                </button>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-12 col-md-12">

                            <div class="card">

                                <div class="card-body">

                                    <h5 class="card-title"></h5>

                                    <!-- Session -->

                                    <?php

                                $result=$InstituteDetails->instituteShow();

                                foreach($result as $row){   

                                ?>

                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                        <div class="row mb-3">

                                            <label for="inputText" class="col-sm-4 col-form-label">Academic

                                                Session</label>

                                            <div class="col-sm-8">

                                                <input type="text" maxlength="55" class="form-control"
                                                    value="<?php echo $row['session']  ?>" name="session" required>

                                            </div>

                                        </div>

                                        <div class="row mb-3">

                                            <div class="col-sm-12  d-flex justify-content-center align-items-center">

                                                <button class="btn btn-primary me-md-2" name="Updateyear"
                                                    type="submit">Update</button>

                                            </div>

                                        </div>

                                    </form>

                                    <!-- End Session -->

                                    <?php

                                    }            

                                    ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>



    </main><!-- End #main -->







    <!-- ======= Footer ======= -->



    <?php require_once 'require/addfooter.php'; ?>







    <!-- Modal -->



    <div class="modal fade" id="classFormModal" tabindex="-1" aria-labelledby="classFormModalLabel" aria-hidden="true">



        <div class="modal-dialog modal-lg">



            <div class="modal-content">



                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>



                </div>



                <div class="modal-body classForm-modal-body">







                </div>

            </div>



        </div>



    </div>



    <!-- modal end -->











    <script>
    function deleteClass() {



        return confirm("ARE YOU SURE TO DELETE THIS CLASS CONTENTS ?")



    };
    </script>















    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>



    <script>
    const classView = (id) => {



        let url = 'ajax/classform.ajax.php?classtype=' + id;



        $(".classForm-modal-body").html(



            '<iframe width="99%" height="360px" frameborder="0" allowtransparency="true" src="' + url +



            '"></iframe>')







    }





    // Example starter JavaScript for disabling form submissions if there are invalid fields

    (function() {

        'use strict'



        // Fetch all the forms we want to apply custom Bootstrap validation styles to

        var forms = document.querySelectorAll('.needs-validation')



        // Loop over them and prevent submission

        Array.prototype.slice.call(forms)

            .forEach(function(form) {

                form.addEventListener('submit', function(event) {

                    if (!form.checkValidity()) {

                        event.preventDefault()

                        event.stopPropagation()

                    }



                    form.classList.add('was-validated')

                }, false)

            })

    })();
    </script>

    <script>
    function checkWordCount() {
        s = document.getElementById("description").value;
        s = s.replace(/(^\s*)|(\s*$)/gi, "");
        s = s.replace(/[ ]{2,}/gi, " ");
        s = s.replace(/\n /, "\n");
        if (s.split(' ').length <= 100) {
            alert("OOPS! Class Description needs Minimum 100 words .....");
            return false;
        }
        if (s.length > 1555) {
            alert("OOPS! Class Description Should be maximum 1555 characters.");
            return false;
        }
    }
    </script>


</body>



</html>