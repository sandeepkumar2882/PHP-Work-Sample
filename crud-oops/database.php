<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js" defer></script>

<?php

class database
{

    //Initialize connection variables
    private $host;
    private $dbUserName;
    private $dbPassword;
    private $dbName;

    //Database connection configuration
    public function dbConnect()
    {
        $this->host = 'localhost';
        $this->dbUserName = 'root';
        $this->dbPassword = 'abcdF@123';
        $this->dbName = 'food-order';

        //Create Connection
        $connection = new mysqli($this->host, $this->dbUserName, $this->dbPassword, $this->dbName);

        //Check Connection
        if ($connection->connect_error) {
            die('Connection Failed: ' . $connection->connect_error);
        } else {
            return $connection;
        }
    }
}

//database inherit for database connection
class query extends database
{

    /*
        select $field from $table where $condition like $like order by $orderByField $orderByType limit $limit;
        */
    public function fetchData($field = '*', $tableName, $conditionArr = '', $likeArr = '', $orderByField = '', $orderByType = 'desc', $limit = '')
    {
        $sql = "SELECT $field FROM $tableName";

        //Check Where condition
        if ($conditionArr != '') {
            $sql .= ' WHERE ';

            //$i and $count are using for remove and add 'and' if multiple conditions
            $count = count($conditionArr);
            $i = 1;
            foreach ($conditionArr as $key => $value) {
                if ($i == $count) {
                    $sql .= "$key='$value'";
                } else {
                    $sql .= "$key='$value' and ";
                }
                $i++;
            }
        }

        //Check like condition
        if ($likeArr != '') {
            if($conditionArr != ''){
                $sql .= " and (";
            }
            else{
                $sql .= ' WHERE (';
            }

            //$i and $count are using for remove and add 'and' if multiple conditions
            $count = count($likeArr);
            $i = 1;
            foreach ($likeArr as $key => $value) {
                if ($i == $count) {
                    $sql .= "$key LIKE '%$value%'";
                } else {
                    $sql .= "$key LIKE '%$value%' or ";
                }
                $i++;
            }
            $sql .= ")";
        }

        //Check orderby condition
        if ($orderByField != '') {
            $sql .= " order by $orderByField $orderByType ";
        }

        //Check limit of the records
        if ($limit != '') {
            $sql .= " limit $limit ";
        }

        //Execute the query
        $result = $this->dbConnect()->query($sql);

        //Check number of rows (more than one or not)
        if ($result->num_rows > 0) {
            $arr = array();
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return 0;
        }
    }

    /*
        insert into tablename () values ();
        */
    public function insertData($tableName, $conditionArr = '')
    {
        //Check Where condition
        if ($conditionArr != '') {
            foreach ($conditionArr as $key => $value) {
                $keyArr[] = $key;
                $valueArr[] = "'" . $value . "'";;
            }
            $keys = implode(",", $keyArr);
            $values = implode(",", $valueArr);

            //insert query
            $sql = "INSERT INTO $tableName($keys) values($values)";
            //Execute the query
            $result = $this->dbConnect()->query($sql);
        }
    }

    /*
        delete from tablename where condition;
        */
    public function deleteData($tableName, $conditionArr = '')
    {
        //Check Where condition
        if ($conditionArr != '') {

            //insert query
            $sql = "DELETE FROM $tableName WHERE ";

            //$i and $count are using for remove and add 'and' if multiple conditions
            $count = count($conditionArr);
            $i = 1;
            foreach ($conditionArr as $key => $value) {
                if ($i == $count) {
                    $sql .= "$key='$value'";
                } else {
                    $sql .= "$key='$value' and ";
                }
                $i++;
            }
            //Execute the query
            $result = $this->dbConnect()->query($sql);
        }
    }

    public function updateData($tableName, $conditionArr = '', $whereKey, $whereValue)
    {
        //Check Where condition
        if ($conditionArr != '') {

            //insert query
            $sql = "UPDATE $tableName SET ";

            //$i and $count are using for remove and add 'and' if multiple conditions
            $count = count($conditionArr);
            $i = 1;
            foreach ($conditionArr as $key => $value) {
                if ($i == $count) {
                    $sql .= "$key='$value'";
                } else {
                    $sql .= "$key='$value' , ";
                }
                $i++;
            }

            //update query
            $sql .= " WHERE $whereKey='$whereValue'";

            //Execute the query
            $result = $this->dbConnect()->query($sql);
        }
    }

    //Global function for filter string
    public function get_safe_str($str)
    {
        if ($str != '') {
            return mysqli_real_escape_string($this->dbConnect(), $str);
        }
    }
}
