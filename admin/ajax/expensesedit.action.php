<?php



require_once '../../_config/dbconnect.php';

require_once '../../classes/expenses.class.php';



$Expenses = new Expenses();





 if(isset($_POST['update'])){



   $id             = $_POST["id"];

   $bill_no        = $_POST["bill_no"];

   $amount         = $_POST["amount"];

   $payment_type   = $_POST["payment_type"];

   $description    = $_POST["description"];

   $accountsSelect = $_POST["accounts-select"];

   $status         = $_POST["status"];

   if (isset($_POST["sub-accounts-select"])) {

       $subcategory    = $_POST["sub-accounts-select"];

   }else{
       $subcategory    = $accountsSelect;
   }



   $payment_id = '';



   if ($payment_type != 'Cash') {

      $payment_id    = $_POST["payment_id"];

      

   }



   $paid_by       = $_POST["paid-by-select"];

   if ($paid_by == 'Others') {

      $paid_by   = $_POST['others_paid'];

   }


   $paid_to       = $_POST["paid-to-select"];

   if ($paid_to == 'Others') {

      $paid_to  = $_POST['others_paid_to'];

   }

   $date          = $_POST["date"];



   $new_image     = $_FILES['upload_bill']['name'];

   $img_tmp_name  =$_FILES['upload_bill']['tmp_name'];

   $image_folter  = '../image/'.$_FILES['upload_bill']['name'];







   if($new_image != ''){

      $c_image = '../image/'.$_FILES['upload_bill']['name'];

   }else{
      $old_img       = $_POST['updateimg'];
      $c_image = $old_img;

   }





   move_uploaded_file( $img_tmp_name, $image_folter );



   $update = $Expenses->expensesupdate($id, $bill_no, $amount, $payment_type, $date, $c_image, $payment_id, $paid_by, $paid_to, $description, $subcategory, $status);



   if($update){



      echo "<h1>Expenses Details Updated!<br><h1>";

  

   }else{

      echo "<h1>Expenses Details Updated!<br><h1>";

   }

 }









    ?>