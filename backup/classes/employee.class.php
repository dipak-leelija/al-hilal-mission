<?php


class Employee extends DatabaseConnection{

    //   inshat dada start
    //rand auto id
    function staffInsert( $name,  $email, $address, $contactno, $gender, $qualification, $experience, $joinin_date, $post_office, $sdo_or_bdo, $police_station, $district, $pin_code, $state, $status, $hash, $hash1){
       
        $code    = rand(1, 99999);
        $user_id = "STA".$code;

        $sql = "INSERT INTO `staff` ( `user_id`,`name`, `email`, `address`, `contactno`, `gender`, `qualification`, `experience`, `joinin_date`, `post_office`,`sdo_or_bdo`, `police_station`, `district`, `pin_code`, `state`, `status`, `Password`, `password1`)
        VALUES ('$user_id', '$name', '$email', '$address', '$contactno', '$gender', '$qualification', '$experience', '$joinin_date', '$post_office', '$sdo_or_bdo', '$police_station', '$district', '$pin_code', '$state', '$status', '$hash', '$hash1')";
       
       $insertEmpQuery = $this->conn->query($sql);

    return $insertEmpQuery;

    // inshat data end
    }








    function staffInsert1( $name,  $email, $address, $contactno, $gender, $qualification, $experience, $date){
        $sql = "INSERT INTO `staff` 
                            (`name`, `email`, `address`, `contactno`, `gender`, `qualification`, `experience`,`date`)
                            VALUES
                            ('$name', '$email', '$address', '$contactno', '$gender', '$qualification', '$experience',  current_timestamp())";
        
        $insertEmpQuery = $this->conn->query($sql);
        return $insertEmpQuery;
    }







 

    // display start
    function showEmployees(){

        $empData = array();
        $sql = "SELECT * FROM `staff`";
        $res = $this->conn->query($sql);
        while($row  = $res->fetch_array()){
            $empData[]	= $row;
        }
        return $empData;
        
    }
    // end display







    // delete start

    function deleteEmp($deleteEmpId){

        $stu_id = $_GET['id'];

        $sqldal = "DELETE FROM `staff_atten` WHERE  `id` = {$stu_id}";

        $result1 = $this->conn->query($sqldal);

        return $result1;
    }

    // end deleteDocCat function







    // update start

    function empUpdate( $id, $name, $address, $contactno, $email, $gender, $qualification, $status){

    $sql = "UPDATE  `staff`
            SET
            `id`            = '$id',
            `name`          = '$name',
            `address`       = '$address',
            `contactno`     = '$contactno',
            `email`         = '$email',
            `gender`        = '$gender',
            `qualification` = '$qualification',
            `status`        = '$status'
            WHERE
            `staff`.`id`    = '{$id}'";

    $res = $this->conn->query($sql);
    return $res;
    }

    //end updateEmp function









    // notice inshat data start w

    function noticeInsert( $notice){

        $sql = "INSERT INTO `forum` ( `notice`) VALUES ( '$notice')";
        
        $insertEmpQuery = $this->conn->query($sql);

    }

    // notice inshat data end






  






    // display start W
    function noticedisplaydata(){

        $data = array();
        $sql = "SELECT * FROM `forum` ORDER BY id DESC LIMIT 2";
        // staff_notice FROM `forum` ORDER BY staff_notice DESC LIMIT 1;
        $empQuery   = $this->conn->query($sql);

        while($row  = $empQuery->fetch_array()){    

        $data[]	= $row;
        }

        return $data;

    }
    // end display





    // notice inshat data start w

    function staff_noticeInsert($name, $notice){

        $sql = "INSERT INTO `forum_staff` ( `name`,`notice`) VALUES ( '$name','$notice')";
        
        $insertEmpQuery = $this->conn->query($sql);

    }

    // notice inshat data e









    // from date to date w

    function shownoticeDetails1($search_expenses1, $search_expenses){

        $sql = "SELECT * FROM `forum` WHERE concat(`date`)  between '$search_expenses1' and '$search_expenses'";

        $studentTypeQuery = $this->conn->query($sql);

        $rows = $studentTypeQuery->num_rows;

        if ($rows == 0) {
            return 0;
            }else{
            while ($result = $studentTypeQuery->fetch_array()) {
            $data[] = $result;
            }
            return $data;
        }
    }

    // end studentDetails function






    function dropdown(){

        $sql = "SELECT name FROM `staff`";

        $result1 = $this->conn->query($sql);

        return $result1;
    }







    function staffnoticeupdatePage($userId){

        $sql = "SELECT * FROM staff WHERE `staff`.`user_id` = '$userId'";

        $result1 = $this->conn->query($sql);

        return $result1;
    }



    // update start w

    function noticeupdate($id, $name, $message){

        $sqledit1 = "UPDATE  `staff` SET `id`= '$_POST{$id}', `message`= '$_POST{$message}', `name`= '{$name}' WHERE `staff`.`id` = '{$id}'";

        $result1 = $this->conn->query($sqledit1);

        return $result1;
    }

    //end updateEmp function








    // update start w

        function staffA($id){

        $sql2 = "UPDATE  `staff` SET `status` = '0' WHERE `staff`.`id` = '{$id}'";

        $result2 = $this->conn->query($sql2);

        return $result2;
    }

    //end updateEmp function







    // update start w

    function noticeupdate1($id, $name, $notice){

        $sqledit1 = "UPDATE  `forum_staff` SET `id`= '{$id}', `notice`= '{$notice}', `name`= '{$name}' WHERE `forum_staff`.`id` = '{$id}'";

        $result1 = $this->conn->query($sqledit1);

        return $result1;
    }
    
    //end updateEmp function




    function passwordchack($hash, $hash1){

        $sql = "SELECT * FROM `staff` WHERE `staff`.`Password` = '$hash' and `staff`.`Password1` = '$hash1'";

        $result = $this->conn->query($sql);

        return $result;
    }






    function staffMessageupdatePage($id){

        $sql = "SELECT * FROM `forum_staff` WHERE `forum_staff`.`id` = '$id'";

        $result1 = $this->conn->query($sql);

        return $result1;
    }



    // ================================================
    
    function empById($empId){

        $data = array();
        $sql = "SELECT * FROM staff WHERE `staff`.`user_id` = '$empId'";
        $res = $this->conn->query($sql);
        if ($res->num_rows > 0 ) {

            while ($result = $res->fetch_array()) {
                $data[] = $result;
            }

        }
        return $data;
    }


        // inshat data start w

        function sendEmpMsg($name, $staff_id, $message){

            $sql = "INSERT INTO `staff_message` ( `name`, `staff_id`, `message`) VALUES ('$name', '$staff_id','$message')";
            $insert = $this->conn->query($sql);
            return $insert;
    
        }
      
        // inshat data end

}
?>