<?php

class Examination extends DatabaseConnection{

    
    

    //addExam start
    function addExam($class_name, $exam_name, $description, $year, $max_marks){

        $sql = "INSERT INTO `exam` (`class_name`, `exam_name`, `description`, `year`, `max_marks`)
                            VALUES 
                            ('$class_name', '$exam_name', '$description', '$year', '$max_marks')";
        $insertEmpQuery = $this->conn->query($sql);
        return $insertEmpQuery;
        
    }//eof


    //showExams start
    function showExams(){

        $empData = array();
        $sql = "SELECT * FROM `exam`";
        $empQuery   = $this->conn->query($sql);
        while($row  = $empQuery->fetch_array()){
            $empData[]	= $row;
        }
        return $empData;

    }//eof


    
    //updateExam start
    function examById($Id){

        $sql = "SELECT * FROM exam WHERE `exam`.`id` = '$Id'";
        $res = $this->conn->query($sql);
        return $res;

    }//eof




    //examupdate update start

    function examupdate($exam_name, $description, $class_name, $id){

        $sqledit = "UPDATE  `exam` SET `exam_name` = '$exam_name', `description`= '$description', `class_name` = '$class_name' WHERE `exam`.`id` = '$id'";

        $result1 = $this->conn->query($sqledit);

        return $result1;

    }//end examupdate
    


        function examByClassName($className, $year){

            $data = array();
            $sql = "SELECT * FROM `exam` WHERE `class_name` = '$className' and `year` = '$year' ORDER BY class_name";
            $res   = $this->conn->query($sql);
            if ($res->num_rows != 0 ) {   
                while($row  = $res->fetch_array()){    
                    
                    $data[]	= $row;
                }
            }
            return $data;
            
        }
        // SELECT * FROM `exam` WHERE `class_name` = '4' and `year` = '2022-2023' ORDER BY class_name


        function deleteExam($examId){

            $sql = "DELETE FROM `exam` WHERE  `id` = '$examId'";
            $res = $this->conn->query($sql);
            return $res;


        }
        
        

        



}


?>