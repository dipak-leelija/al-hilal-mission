<?php
  require_once '../../_config/dbconnect.php';
    require_once '../../classes/institutedetails.class.php';
    $classes = new  InstituteDetails();
    if(isset ($_POST["Submitdata"])){
       
        $studentmarks = $_POST["marks"];
        $studentIds   = $_POST["student_id"];
       

        for ($i = 0; $i < count($studentIds); $i++)  {

            for ($i = 0; $i < count($studentmarks); $i++)  {

             $student_id = $studentIds[$i];
             $marks      = $studentmarks[$i];
           
            $exam_id         = $_POST["exam_id"];
            $class_id        = $_POST["class_id"];
            $subject_id      = $_POST["subject_id"];
            $session         = $_POST["session"];             

            $result=$classes->marksInsert($marks, $session, $student_id, $class_id, $exam_id, $subject_id);    

            if($result){
               echo "<script>
               window.history.back();
            </script>";
                    }
                    else{
                        echo "<script>
                        window.history.back();

                    </script>";                            
                }
            }
        }
    }

?>

<?php
    // require_once '../class/institutedetails.class.php';
    // $classes = new  institudeDetails();

    // if(isset ($_POST["Submitdata"])){
    
    //     $studentmarks = $_POST["marks"];
    //     $studentIds   = $_POST["student_id"];
       

    //     for ($i = 0; $i < count($studentIds); $i++)  {

    //         for ($i = 0; $i < count($studentmarks); $i++)  {

    //         echo $student_id = $studentIds[$i];
    //         echo $marks      = $studentmarks[$i];
    //         $exam_id         = $_POST["exam_id"];
    //         $class_id        = $_POST["class_id"];
    //         $subject_id      = $_POST["subject_id"];
    //         $session         = $_POST["session"];
           
           
    //         $seletstudent_id = $student_id;
    //         $seletsubject_id = $subject_id;
    //         $seletclass_id = $class_id;

    //         $selet = $classes->seletmark($seletstudent_id, $seletsubject_id, $seletclass_id);
    //          $selectdata = $selet->num_rows;
           
           
            
    //          if ($selectdata == 0) {
             
    //             echo '<script> alert("New data insert"); </script>';
    //          foreach ($selet as $data) {

    //             echo $data["exam_id"];

              

    //          $result=$classes->marksInsert($marks, $session, $student_id, $class_id, $exam_id, $subject_id);    

    //          if($result){
    //                     echo  header('Location: ' . $_SERVER['HTTP_REFERER']);
    //                 }
    //                 else{
    //                     echo  header('Location: ' . $_SERVER['HTTP_REFERER']);
                                  
    //             }
    //       }
    //         }else{

    //                 $result=$classes->marksUpdate($marks);
    //                 if($result){
    //                     echo  header('Location: ' . $_SERVER['HTTP_REFERER']);
    //                 }
    //                 else{
    //                     echo  header('Location: ' . $_SERVER['HTTP_REFERER']);
                                  
    //             }
    //             }
    //         }
    //     }
    // }

      
?>