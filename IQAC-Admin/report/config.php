<?php

error_reporting(0);

class db{
    var $con;
    function __construct(){
        $this->con = mysqli_connect("localhost","root","", "erp");
    }

    public function getRecords(){
        $query = "SELECT * FROM fdp";
        $result = mysqli_query($this->con, $query);
        return $result;
    }

    public function getFilteredRecords($department, $approval, $fromDate, $toDate){
        $query = "SELECT * FROM fdp WHERE 1=1";

        if (!empty($department)) {
            $query .= " AND department = '$department'";
        }

        if (!empty($approval)) {
            $query .= " AND hod_approval = '$approval'";
        }

        if (!empty($fromDate)) {
            $query .= " AND submitted_time >= '$fromDate'";
        }

        if (!empty($toDate)) {
            $query .= " AND submitted_time <= '$toDate'";
        }

        $result = mysqli_query($this->con, $query);
        return $result;
    }

    public function closeCon(){
        mysqli_close($this->con);
    }
}
?>

?>