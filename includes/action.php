<?php

include "db.php";

class Dataoperation extends Database {

    // method

    public function insert_record($table,$fields){
      //  "INSERT INTO table_name (, ,) VALUES ('', '')";
      $sql ="";

      $sql .="INSERT INTO ".$table;
      $sql .=" (".implode(",", array_keys($fields)).") VALUES ";
      $sql .= "('".implode("','", array_values($fields))."')";
      // echo sql for testing
      //echo $sql;
      $query = mysqli_query($this->con,$sql);
      if($query){
        return true;
      }
      else{
        echo 'bad'.die(mysqli_error($this->con));
      }
    }

    // fetch data inside dataoperation class

    public function fetch_record($table){
       
      $sql = "SELECT * FROM ".$table;
      $array = array();

      $query = mysqli_query($this->con,$sql);

      while($row=mysqli_fetch_assoc($query)){
        $array[] = $row;
  
      }
      return $array;
    }

    // select data from table
    public function select_record($table,$where){
      $sql ="";
      $condition ="";
      foreach($where as $key => $value){
        // id ='5' and m_name = 'something'
        $condition .= $key . "='" . $value . "' AND "; 

      }

       //echo $condition;

      $condition =substr($condition, 0, -5);

      $sql = "SELECT * FROM ".$table." WHERE ".$condition;
     // echo $sql;
      $query = mysqli_query($this->con,$sql);
      $row = mysqli_fetch_array($query);
      return $row;
    }

      // methood to update the records  
    public function update_record($table,$where,$fields){
       
      $sql = "";
      $condition="";

      foreach($where as $key => $value){
        // id ='5' and m_name = 'something'
        $condition .= $key . "='" . $value . "' AND "; 
 
      }

      $condition =substr($condition, 0, -5);

      foreach($fields as $key => $value){ 
       //UPdate table SET m_name ='', qty ='', WHERE id = ''
       $sql .= $key . "='".$value."', "; 

      }   

      $sql = substr($sql, 0, -2);

      $sql ="UPDATE ".$table." SET ".$sql." WHERE ".$condition;
      
      if($query= mysqli_query($this->con,$sql)){
        return true;
      }else{
        echo 'bad'.die(mysqli_error($this->con));
      }
       
    } 

    public function delete_record($table,$where){
      $sql ="";
      $condition = "";

      foreach( $where as $key => $value){

        $condition .= $key . "='" . $value. "' AND ";

      }

      $condition =substr($condition, 0, -5);

      $sql = "DELETE  FROM ".$table." WHERE ".$condition;

      if($query= mysqli_query($this->con,$sql)){
        return true; 
      }  else{
        echo 'bad'.die(mysqli_error($this->con));
      }

    
    }
 
} 

$obj = new Dataoperation;

if(isset($_POST["submit"])){
    $myArray = array(
     "m_name" => $_POST["m_name"],
     "qty" => $_POST["qty"]
    );
    
    if($obj->insert_record("medicines",$myArray) ){
    
      echo "<script> alert('Drug Inserted!') </script>";
      echo "<script>window.open('../index.php', '_self') </script>";
    }
    

}

if(isset($_POST["edit"])){

  $id = $_POST["id"];
  $where = array("id"=>$id);

  $myArray = array(
    "m_name" => $_POST["m_name"],
    "qty" => $_POST["qty"]
   );
    

   if( $obj->update_record("medicines",$where,$myArray)){
     
    echo "<script> alert('Drug Updated!') </script>";
    echo "<script>window.open('../index.php', '_self') </script>";
   }

}




?>