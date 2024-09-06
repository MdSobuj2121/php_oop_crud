<?php
class db{
    public $hostname;
    public $username;
    public $password;
    public $db_name;
    public $conn;

    public function __construct($hostname, $username, $password, $db_name){
        $this->hostname = $hostname; // Corrected this line
        $this->username = $username;
        $this->password = $password;
        $this->db_name = $db_name;
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->db_name);
        if(!$this->conn){
            echo mysqli_connect_error();
        }else{
            echo 'Connected! <br>';
        }
    }
    public function create($name, $price){
        $sql = "INSERT INTO category(name, price)
        VALUES('$name', '$price');";
        if(mysqli_query($this->conn, $sql)){
            echo "Inserted!";
        }else{
            echo mysqli_connect_error();
        }
    }
    public function update($name, $price){
        $sql = "UPDATE category SET price = '$price' WHERE name = '$name' ";
        if(mysqli_query($this->conn, $sql)){
            echo "Updated!";
        }else{
            echo mysqli_connect_error();
        }
    }

    public function read(){
        $sql = "SELECT * from category";
        $data = mysqli_query($this->conn, $sql);
        while($row = mysqli_fetch_array($data)){
            $id = $row['id'];
            $name = $row['name'];
            $price = $row['price'];
            echo $id. ' ' .$name. ' '.$price. '<br>';
        }
    }

    public function delete($name){
        $sql = "DELETE FROM category WHERE name = '$name'";
        if(mysqli_query($this->conn, $sql)){
            echo "Deleted!";
        }else{
            echo mysqli_connect_error();
        }
    }

}

$mydb = new db('localhost', 'root', '', 'my_db');
//$mydb->create('Dress', '220');
//$mydb->update('Dress', '290');
//$mydb->read();
$mydb->delete('Dress');
?>
