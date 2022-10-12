<?php

    include ('connect.php');
    
    //for insert student Info
    function insertStudentInfo($info_sid, $info_fname, $info_lname, $info_mname, $info_course, $info_yr_lvl,){
        global $conn;
        //insert 
        $sql = "INSERT INTO `dtp_info`(`info_sid`, `info_fname`, `info_lname`, `info_mname`, `info_course`, `info_yr_lvl`) VALUES ('$info_sid','$info_fname','$info_lname','$info_mname','$info_course','$info_yr_lvl')";
        //check for duplicate
        $query = "SELECT * FROM dtp_info WHERE info_sid = $info_sid";

         //check for duplicate
        if ($result = mysqli_query($conn, $query)) {
          while($row = mysqli_fetch_array($result)) {
               if ($row['info_id']){
                  header("Location: http://".$_SERVER['HTTP_HOST']."/DTPattendance/existing.php");
               }
          }
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
    }

    function insertScheduleTimeIn($sched_date, $sched_tin, $sched_entry, $info_sid){
      global $conn;

      $sql = "INSERT INTO `dtp_sched`(`sched_date`, `sched_tin`, `sched_entry`, `info_id`) VALUES ('$sched_date','$sched_tin', 'In', '$info_sid')";
      
        mysqli_query($conn, $sql);

    }

  function insertScheduleTimeOut($sched_date, $sched_tin, $info_sid){
    global $conn;

    $sql = "INSERT INTO `dtp_info`(`sched_date`, `sched_tout`, `info_id`) VALUES ('$sched_date','Out','$info_sid')";
    
    mysqli_query($conn, $sql);
  
  }

  function foreignkeyFinder($foreignKey){
    global $conn;

    $sql = "SELECT * from dtp_info WHERE info_sid = $foreignKey";
    
    if ($result = mysqli_query($conn, $sql)) {
        while($row = mysqli_fetch_array($result)) {
             return $row['info_id']; 
        }
      } 
      else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

  }

  function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
 }



  //for searching

//   <?php
//   include ('db/connect.php');
//    global $conn;

//  if (isset($_POST['schoolID'])){
//    $search = $_POST['schoolID'];
   
//    $sql = "SELECT * from dtp_info WHERE info_sid = $search";

// if ($result = mysqli_query($conn, $sql)) {
//    while($row = mysqli_fetch_array($result)) {
//      if ($row['info_sid']){
//        echo '<input type="text" placeholder="'.$row['info_sid'].'" id="IDschool" name="schoolID" maxlength = "5"  disabled/>';
//        echo '<input type="text" placeholder="'.$row['info_fname'].'" id="IDschool" name="schoolID" maxlength = "5"  disabled/>';
//        echo '<input type="text" placeholder="'.$row['info_lname'].'" id="IDschool" name="schoolID" maxlength = "5"  disabled/>';
//        echo '<input type="text" placeholder="'.$row['info_mname'].'" id="IDschool" name="schoolID" maxlength = "5"  disabled/>';
//        echo '<input type="text" placeholder="'.$row['info_course'].'" id="IDschool" name="schoolID" maxlength = "5"  disabled/>';
//        echo '<input type="text" placeholder="'.$row['info_yr_lvl'].'" id="IDschool" name="schoolID" maxlength = "5"  disabled/>';
//      } 
//    }
//  } 
// } 



?>