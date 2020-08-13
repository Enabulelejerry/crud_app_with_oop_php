<?php
include ('includes/action.php'); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="jumbotron text-center">
            <h1>Medicine Stock <small>Jcode Tutorial</small></h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: lightblue !important; color: white !important;">
                        Enter Medicine Details
                    </div>
                    <div class="card-body">
                    <?php
                    if(isset($_GET["update"])){
                        // php 7
                        $id = $_GET["id"] ?? null;
                        //"key" => "12", "name"=> "king
                        $where = array("id"=>$id);
                        $row =  $obj->select_record("medicines", $where); 

                        ?>

                        <form action="includes/action.php" method="post">
                            <table class="table table-hover">
                            <tr>
                                    
                                    <td><input type="hidden" name="id"
                                    value=" <?php echo $id; ?>"  ></td>
                                </tr>
                                
                                <tr>
                                    <td>Medicine Name</td>
                                    <td><input type="text" name="m_name" placeholder="Enter Medicine name"
                                          value=" <?php echo $row["m_name"]; ?>"  class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td><input type="text" name="qty" placeholder="Enter Quantity" class="form-control"  value=" <?php echo $row["qty"]; ?>">
                                    </td>
                                </tr>
                                <tr style="background-color: transparent !important;">

                                    <td class="colspan=2" align="center"><input type="submit" name="edit"
                                            placeholder="Store" class=" btn btn-primary" value="Edit"
                                            style="background-color: lightblue !important; color: white !important; border: 1px solid lightblue !important; ">
                                    </td>
                                </tr>
                            </table>
                        </form>

                        <?php

                    }else{

                        ?>
                        <form action="includes/action.php" method="post">
                            <table class="table table-hover">
                                <tr>
                                    <td>Medicine Name</td>
                                    <td><input type="text" name="name" placeholder="Enter Medicine name"
                                            class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td><input type="text" name="qty" placeholder="Enter Quantity" class="form-control">
                                    </td>
                                </tr>
                                <tr style="background-color: transparent !important;">

                                    <td class="colspan=2" align="center"><input type="submit" name="submit"
                                            placeholder="Store" class=" btn btn-primary"
                                            style="background-color: lightblue !important; color: white !important; border: 1px solid lightblue !important; ">
                                    </td>
                                </tr>
                            </table>
                        </form>

                        <?php 

                    }


                       ?>

                        
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-2"> </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Medicine Name</th>
                        <th>Available Stock</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                      <?php

                      $myrow = $obj->fetch_record("medicines");
                      foreach($myrow as $row){
                          // breaking point

                        ?> 

                        <?php

                        if(isset($_GET['delete'])){
                             $id = $_GET["id"] ?? null;
                             $where = array("id"=>$id);
                             if($obj->delete_record("medicines",$where)){
                                echo "<script> alert('Drug Deleted!') </script>";
                                echo "<script>window.open('index.php', '_self') </script>";

                             }
                             
                        }
                        ?> 
                        <tr>
                        <td><?php  echo $row["id"]; ?></td>
                        <td><?php  echo $row["m_name"]; ?></td>
                        <td><b><?php  echo $row["qty"]; ?></b> </td>
                        <td> <a href="index.php?update=1&id=<?php echo $row["id"]  ?>" class="btn btn-info">Edit</a> </td>
                        <td><a href="index.php?delete=1&id=<?php echo $row["id"]  ?>" class="btn btn-danger"> Delete</a</td> 
                       </tr>

                        <?php
                      }

                       ?>

                     
                    </table> 
                </div> 
                <div
                                   
                class="col-md-2">
            </div>


        </div>




        <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>