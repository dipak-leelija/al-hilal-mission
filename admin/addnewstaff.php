<?php

 session_start();

 $page ="add-new-staff";

 

 require_once '../_config/dbconnect.php';

 require_once '../classes/admin.class.php';

 require_once '../classes/utility.class.php';

 require_once '../classes/stadetails.class.php';

 require_once '../includes/constant.php';

 $Utility   = new Utility();

 $Admin     = new Admin();

 $empRole   = new institute();

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



    <title>Staff Management / Add new Staff - <?php echo SITE_NAME; ?></title>

    <meta content="" name="description">

    <meta content="" name="keywords">

    <?php require_once 'require/headerLinks.php';?>



    <style>
    .genderingrow {

        margin: auto;

        display: inline-flex;

        justify-content: space-evenly;

    }



    @media (min-width:100px) and (max-width:359px) {



        .genderingrow {

            display: inline;

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

            <h1>Add New Staff</h1>

            <nav>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                    <li class="breadcrumb-item">Staff Management</li>

                    <li class="breadcrumb-item active">Add New Staff</li>

                </ol>

            </nav>

        </div>

        <!-- End Page Title -->



        <section class="section">

            <div class="container p-0">

                <div class="card">

                    <div class="card-body  pt-0" style="padding: 0.4rem!important;">

                        <h5 class="card-title"></h5>

                        <!-- staffform -->

                        <form method="POST" action="ajax/addnewstaff.acction.php" enctype="multipart/form-data"
                            class="row needs-validation m-0" novalidate>

                            <input type="hidden" class="form-control" value="1" name="status" required />

                            <div class="row mb-3 m-0 p-0">
                                <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Profile Image :</label>
                                <div class="col-sm-10">
                                    <img src="#" width=110 height=105 alt="" onerror="this.src='assets/img/user.jpg';"
                                        width=100 height=100 class="rounded-circle" id="output">
                                </div>
                            </div>

                            <div class="row  m-0 p-0">

                                <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Image Upload :</label>
                                <div class="col-xl-4 col-lg-4 mb-3">
                                    <input class="form-control" id="formFile" type="file" name="image" accept="image/*"
                                        onchange="loadFile(event)" required>
                                </div>

                                <label class="col-xl-2 col-lg-2 col-form-label">Designation :</label>
                                <div class="col-xl-4 col-lg-4 mb-3">
                                    <select class="form-select" id="form-select" onclick="Func_a()"
                                        aria-label="Default select example" name="rolename" required>
                                        <option disabled selected value>Select Your Designation</option>
                                        <?php
                                         $RoleList = $empRole->RoleList();
                                         foreach ($RoleList as $Role) {
                                            echo '<option value="'.$Role['designation_id'].'">'.$Role['designation_name'].'</option>';

                                         }
                                        ?>
                                    </select>

                                </div>


                                <div class="row mb-3 m-0 p-0">

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Name :</label>

                                    <div class="col-xl-10 col-lg-10">

                                        <input type="text" maxlength="80" class="form-control" name="name" required>

                                    </div>

                                </div>



                                <div class="row  m-0 p-0">

                                    <label for="inputEmail" class="col-xl-2 col-lg-2 col-form-label">Email Id :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <input type="email" class="form-control" name="email" required>

                                    </div>

                                    <label for="inputNumber" class="col-xl-2 col-lg-2 col-form-label"> Contact No
                                        :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <input type="text" maxlength="10" class="form-control" name="contactno"
                                            required>

                                    </div>

                                </div>





                                <fieldset class="row mb-3 m-0 p-0">

                                    <legend class="col-form-label col-xl-2 col-lg-2 pt-1">Gender :</legend>

                                    <div class="col-xl-4 col-lg-4 genderingrow">

                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios1"
                                                value="Male" required>

                                            <label class="form-check-label" for="gridRadios1">

                                                Male

                                            </label>

                                        </div>

                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2"
                                                value="Female">

                                            <label class="form-check-label" for="gridRadios2">

                                                Female

                                            </label>

                                        </div>

                                        <div class="form-check">

                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2"
                                                value="Female">

                                            <label class="form-check-label" for="gridRadios2">

                                                Transgender

                                            </label>

                                        </div>

                                    </div>

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Qualification
                                        :</label>

                                    <div class="col-xl-4 col-lg-4">

                                        <input type="text" maxlength="80" class="form-control" name="qualification"
                                            required>

                                    </div>



                                </fieldset>







                                <div class="row  m-0 p-0">

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Experience :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <!-- <input type="text" maxlength="80" class="form-control" > -->

                                        <select class="form-select" aria-label="Default select example"
                                            name="experience" required>

                                            <option selected disabled>Select Experience</option>

                                            <option value="0">Fresher</option>

                                            <option value="1">1 Year</option>

                                            <option value="2">2 Years</option>

                                            <option value="3">3 Years</option>

                                            <option value="4">4 Years</option>

                                            <option value="5">5 Years</option>

                                            <option value="6">6 Years</option>

                                            <option value="7">7 Years</option>

                                            <option value="8">8 Years</option>

                                            <option value="9">9 Years</option>

                                            <option value="10+">10+ Years</option>

                                        </select>

                                    </div>

                                    <label for="inputDate" class="col-xl-2 col-lg-2 col-form-label">Joining Date
                                        :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <input type="date" class="form-control" name="joinin_date" required>

                                    </div>

                                </div>

                                <div class="row mb-3 m-0 p-0">

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Address :</label>

                                    <div class="col-xl-10 col-lg-10">

                                        <textarea class="form-control" maxlength="355" style="height: 70px"
                                            name="address" required></textarea>

                                    </div>

                                </div>







                                <div class="row  m-0 p-0">

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Post Office
                                        :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <input type="text" maxlength="80" class="form-control" name="post_office"
                                            required>

                                    </div>

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">SDO/BDO :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <input type="text" maxlength="80" class="form-control" name="sdo_or_bdo"
                                            required>

                                    </div>

                                </div>

                                <div class="row  m-0 p-0">

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Police Station
                                        :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <input type="text" maxlength="80" class="form-control" name="police_station"
                                            required>

                                    </div>

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">District :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <input type="text" maxlength="80" class="form-control" name="district" required>

                                    </div>

                                </div>

                                <div class="row  m-0 p-0">

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Pin Code :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <input type="number"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            type="number" maxlength="6" class="form-control" name="pin_code" required>

                                    </div>

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">State :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <input type="text" maxlength="80" class="form-control" name="state" required>

                                    </div>

                                </div>

                                <div class="row  m-0 p-0">

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Password :</label>

                                    <div class="col-xl-4 mb-3 col-lg-4">

                                        <input type="Password" maxlength="80" class="form-control" name="password"
                                            id="password" onkeyup='check();' onChange="onChange()" required>

                                    </div>

                                    <label for="inputText" class="col-xl-2 col-lg-2 col-form-label">Verify Password

                                        :</label>

                                    <div class="col-xl-4 col-lg-4 mb-3">

                                        <input type="Password" maxlength="80" class="form-control"
                                            name="confirm_password" id="confirm_password" onkeyup='check();' onChange="onChange()" required>
                                        <span id='message'></span>

                                    </div>

                                </div>

                                <div class="row mb-3 m-0 p-0">

                                    <div class="col-xl-12  d-flex justify-content-center align-items-center">

                                        <button type="submit" class="btn btn-primary" name="submit">Submit Form
                                        </button>

                                    </div>

                                </div>

                        </form>

                        <!-- End staffform -->

                    </div>

                </div>

            </div>

        </section>

    </main>

    <!-- End #main -->





    <!-- ======= Footer ======= -->

    <?php require_once 'require/addfooter.php'; ?>



    <script>
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

    })()
    </script>

    <!-- preview-image- runat="server"-onchange="loadFile(event)-->
    <script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    </script>
    <!-- preview-image-end -->



    <script>
    // var password = document.getElementById('password').value;
    // comsole.log(password);
    // function check(elem){
    //     if(elem.value.length > 0){
    //         if(elem.value != password)
    //         {
    //             document.getElementById('alert').innerText = "confrim password does match";
    //         }
    //     }
    // }



    var check = function() {
        var password = document.getElementById('password').value;
        var confirm_password = document.getElementById('confirm_password').value;
        if (password == confirm_password) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Passwords matching';
        }else{
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Passwords do not match';
        }
    }



    function onChange() {
        const password = document.querySelector('input[name=password]');
        const confirm = document.querySelector('input[name=confirm_password]');
        if (confirm.value === password.value) {
            confirm.setCustomValidity('');
        } else {
            confirm.setCustomValidity('Passwords do not match');
        }
    }
    </script>



</body>



</html>