<?php 


class Database
{
    // database information
    private $servername="localhost";
    private $username="root";
    private $password="";
    private $db="cars";

    // helper properties
    private $conn;
    private $successAdd = " Your Record Have Been Added";
    private $updatedSuccess = " Your Record Have Been Updated";
    private $deletedSuccess = " Your Record Have Been Deleted";


    public function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db);
        if(!$this->conn) {
            die("their is an error in connection of db ". mysqli_connect_error());
        }
    }



    //  insert new record

    public function insert($sql)
    {
        if(mysqli_query($this->conn, $sql)) {
            return $this->successAdd;
        } else {
            die("Error : " . mysqli_error($this->conn));
        }
    }
    //  enrypt password

    public function enc_password($password)
    {
        return sha1($password);
    }

    //  read data from db
    public function read($query)
    {
        $result = $this->conn->query($query);
        if (!$result) {
            throw new mysqli_sql_exception($this->conn->error, $this->conn->errno);
        }
    
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $result->free();
    
        return $data;
    }


//     //  get data of specific item

    public function find($table, $id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $sql = "SELECT * FROM $table WHERE `id`='$id' LIMIT 1 ";
        $result = mysqli_query($this->conn, $sql);
        if(mysqli_query($this->conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                return mysqli_fetch_assoc($result);
            } else {
                return false;
            }
        } else {
            return die("Error : ".mysqli_error($this->conn));
        }
    }






    // update data in db
    public function update($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        if(mysqli_query($this->conn, $sql)) {
            return $this->updatedSuccess;
        } else {
            return die("Error : ".mysqli_error($this->conn));
        }
    }



    // update data in db
    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE `id`='$id' ";
        $result = mysqli_query($this->conn, $sql);
        if(mysqli_query($this->conn, $sql)) {
            return $this->deletedSuccess;
        } else {
            return die("Error : ".mysqli_error($this->conn));
        }
    }

};
