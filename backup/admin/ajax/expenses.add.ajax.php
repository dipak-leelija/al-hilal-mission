<?php
 session_start();
 $page ="add-new-staff";

 require_once '../../_config/dbconnect.php';
 require_once '../../classes/admin.class.php';
 require_once '../../classes/utility.class.php';
 require_once '../../classes/expenses.class.php';
 require_once '../../classes/employee.class.php';
 

 $Employee   = new Employee();
 $Expenses   = new Expenses();
 $Utility    = new Utility();
 $Admin      = new Admin();

 $_SESSION['current-url'] = $Utility->currentUrl();
  
if (!isset($_SESSION['user_name']) && !isset($_SESSION['loggedin']) ) {
  header("Location: login.php");
  exit;
}
//  $expensesQuery=false;

  if(isset ($_POST["submit"])){
 // if($_SERVER['REQUEST METHOD'] == 'POST'){
    $purpose        = $_POST["purpose"];
    $bill_no        = $_POST["bill_no"];
    $amount         = $_POST["amount"];
    $payment_type   = $_POST["payment_type"];
    $description    = $_POST["description"];
    $date           = $_POST["date"];
    $added_by       = $_POST["added_by"];
    
    $payment_id     = $_POST["payment_id"];
    $paidBySelect   = $_POST["paid-by-select"];
    $others_paid    = $_POST["others_paid"];
    $status         = 1;

    if ($paidBySelect == 'Others') {
        $paidBy = $others_paid; 
    }
    
    if ($others_paid == '') {
        $paidBy = $paidBySelect; 
    }
    
    //image uplod 
      $image            = $_FILES[ 'upload_bill' ][ 'name' ];
      $image_size       = $_FILES[ 'upload_bill' ][ 'size' ];
      $image_tmp_name   = $_FILES[ 'upload_bill' ][ 'tmp_name' ];
      $image_folter     = '../image/'.$image;
    //   echo $image_tmp_name; exit;

        move_uploaded_file( $image_tmp_name, $image_folter );

        $added = $Expenses->expensesInsert($purpose, $bill_no, $amount, $payment_type, $description, $date ,$image, $status,$added_by,$payment_id, $paidBy);
      
        if($added){

            echo "<script> alert('Sucessfull');document.location='https://alhilalmission.in/admin/ajax/expenses.add.ajax.php' </script>";

         }else{

            echo "<script> alert('Expenses Data Insertion Failed');document.location='https://alhilalmission.in/admin/ajax/expenses.add.ajax.php' </script>";
       
        }
     }
      
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body style="background:white">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"
        class="row needs-validation  m-0" novalidate>

        <div class="card m-0 px-0 mb-0" style="box-shadow: none">
            <div class="card-body p-3 pt-0">
                <h5 class="card-title d-flex justify-content-center p-0 mt-0 mb-3">
                    Add Expenses
                </h5>
                <input type="hidden" value="<?php echo $_SESSION['user_name'] ?>" name="added_by" required>

                <div class="row mb-3 m-0 p-0">

                    <label for="inputaddress" class="col-sm-2 col-form-label">Bill No :</label>
                    <div class="col-sm-10">
                        <input type="address" class="form-control" name="bill_no" required />
                    </div>
                </div>


                <div class="row mb-3 m-0 p-0">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Amount :</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="amount" required />
                    </div>
                </div>

                <div class="row mb-3 m-0 p-0">
                    <label for="inputText" class="col-sm-2 col-form-label ">Payment :</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="form-selectdata" name="payment_type" onclick="selectPayment()"
                            required>
                            <option disabled selected value>Select Payment Type</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit">Credit</option>
                            <option value="UPI">UPI</option>
                            <option value="Credit-Card">Credit-Card</option>
                            <option value="Debit-Card">Debit-Card</option>
                            <option value="Internet-Banking">Internet-Banking</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <label for="inputText" class="col-sm-2 col-form-label" id="onlien" style="display: none;">Payment Id
                        :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="payment_id" id="onliens" style="display: none;">
                    </div>
                </div>


                <div class="row mb-3 m-0 p-0">
                    <label class="col-sm-2 col-form-label">Paid By :</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="form-select" aria-label="Default select example"
                            onclick="selectothers()" name="paid-by-select" required>
                            <option disabled selected value>Select Name</option>
                            <option value="Others" style="color: blue;">Others</option>

                            <?php
                                $emps =$Employee->showEmployees();

                                foreach ($emps as $emp) {
                                    $empId   = $emp['id'];
                                    $empName = $emp['name'];
                                    echo ' <option value="'.$empId.'">'.$empName.'</option>';
                                }
                        ?>

                        </select>
                    </div>

                    <label for="inputText" class="col-sm-2 col-form-label" id="other" style="display: none;">Others
                        :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="others_paid" id="others" style="display: none;">
                    </div>
                </div>


                <div class="row mb-3 m-0 p-0">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Upload Bill :</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="file" id="formFile" name="upload_bill" accept="image/*"
                            required />
                    </div>
                    <!-- </div>
            <div class="row mb-3 m-0 p-0"> -->
                    <label for="inputDate" class="col-sm-2 col-form-label ">Date :</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="date" required>
                    </div>
                </div>

                <div class="row mb-3 m-0 p-0">
                    <label for="inputText" class="col-sm-2 col-form-label">Purpose :</label>
                    <div class="col-sm-10">
                        <!-- <input type="text" class="form-control" name="purpore" required /> -->
                        <textarea class="form-control" id="" rows="3" name="purpose" required></textarea>
                    </div>
                </div>

                <div class="row mb-3 m-0 p-0">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description :</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" style="height: 58px" name="description" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <!-- <label class="col-sm-3 col-form-label">Confirm Payment</label> -->
                    <div class="col-sm-12 d-flex m-auto justify-content-center">
                        <button type="submit" class="btn btn-primary" style="width: 105px" name="submit">
                            Upload
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->


    <script>
    // console.log("hi");
    function selectothers() {
        var demo_two = document.getElementById('other');
        var demo = document.getElementById('form-select');
        if (demo.value == 'Others') {
            demo_two.style.display = "block";
        } else {
            demo_two.style.display = "none";
        }
        var demo_two = document.getElementById('others');
        var demo = document.getElementById('form-select');
        if (demo.value == 'Others') {
            demo_two.style.display = "block";
        } else {
            demo_two.style.display = "none";
        }
    }
    </script>


    <script>
    function selectPayment() {
        var demo_two = document.getElementById('onlien');
        var demo = document.getElementById('form-selectdata');
        if (demo.value == 'Credit' || demo.value == 'UPI' || demo.value == 'Credit-Card' || demo.value ==
            'Debit-Card' || demo.value == 'Internet-Banking' || demo.value == 'Others') {
            demo_two.style.display = "block";
        } else {
            demo_two.style.display = "none";
        }
        var demo_two = document.getElementById('onliens');
        var demo = document.getElementById('form-selectdata');
        if (demo.value == 'Credit' || demo.value == 'UPI' || demo.value == 'Credit-Card' || demo.value ==
            'Debit-Card' || demo.value == 'Internet-Banking' || demo.value == 'Others') {
            demo_two.style.display = "block";
        } else {
            demo_two.style.display = "none";
        }
    }
    </script>


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



</body>

</html>