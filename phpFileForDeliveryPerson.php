<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portalForFarmers";//database name


$conn = mysqli_connect($servername, $username, $password, $dbname);//connection established.

if (!$conn) {//if not connected 
    echo "<h3>Database Disconnected</h3>";
    // die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "<br> <h1>DELIVERY PERSON REGISTERATION</h1> ";
    echo " Database Connected <br>";
}



?> <!--end of php-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<div class="container">
        <div class="card">
            <div class="card-header">
                Insert Record
            </div>
            <div class="card-body">
                <h5 class="card-title">Insert Operation</h5>
                <form method="POST"> 
                    <div class="form-group">
                        <label for="dbname">delivery_person_name</label>
                        <input type="text" class="form-control" id="delivery_person_name" name="delivery_person_name" placeholder="delivery_person_name">
                    </div>
                    <div class="form-group">
                        <label for="dbname">delivery_person_phoneno</label>
                        <input type="text" class="form-control" id="delivery_person_phoneno" name="delivery_person_phoneno" placeholder="delivery_person_phoneno">
                    </div>
                    <div class="form-group">
                        <label for="dbname">delivery_person_deliveryaddress</label>
                        <input type="text" class="form-control" id="delivery_person_deliveryaddress" name="delivery_person_deliveryaddress" placeholder="delivery_person_deliveryaddress">
                    </div>
                    <div class="form-group">
                        <label for="dbname">seller_id</label>
                        <input type="text" class="form-control" id="seller_id" name="seller_id" placeholder="seller_id">
                    </div>
                    <input type="submit" name="insert" class="btn btn-primary" value="Insert">
                </form>
                <?php //start of php 
                    if (array_key_exists('delivery_person_name', $_POST) && array_key_exists('delivery_person_phoneno', $_POST) && array_key_exists('delivery_person_deliveryaddress', $_POST) && array_key_exists('seller_id', $_POST)) {//--all must have values
                        $delivery_person_name = $_POST['delivery_person_name'];
                        $delivery_person_phoneno = $_POST['delivery_person_phoneno'];
                        $delivery_person_deliveryaddress = $_POST['delivery_person_deliveryaddress'];
                    
                        $seller_id = $_POST['seller_id'];
                        $sql = "insert into delivery_person_table(delivery_person_name,delivery_person_phoneno,delivery_person_deliveryaddress,seller_id) values ('".$delivery_person_name ."', '". $delivery_person_phoneno."', '".$delivery_person_deliveryaddress."',  '".$seller_id ."' )";
                    
                        if (mysqli_query($conn, $sql)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                ?>
            </div>
        </div>
        <br><br>

        <div class="card">
            <div class="card-header">
                Read Record
            </div>

            <div class="card-body">
                <h5 class="card-title">Read Operation</h5>
                <form method="POST">
                    <div class="form-group">
                        <label for="tablename">Table Name</label>
                        <input type="text" class="form-control" id="name" name="tablename" placeholder="Table Name">
                    </div>
                    <input type="submit" name="read" class="btn btn-primary" value="Read">
                </form>
                <?php
                    if(array_key_exists('tablename', $_POST)){
                        $tablename = $_POST['tablename'];
                        $sql_read = "select delivery_person_name,delivery_person_phoneno,seller_id from ".$tablename;
                        $result_read = mysqli_query($conn, $sql_read);
                        
                        if (mysqli_num_rows($result_read) > 0) {
                            while($row = mysqli_fetch_assoc($result_read)) {
                                echo "<pre> delivery_person_name: ".$row["delivery_person_name"]."   delivery_person_phoneno: " .$row["delivery_person_phoneno"]."    seller_id:  " .$row["seller_id"]."</pre><br>";
                            }
                        } else {
                        echo "0 results";
                        }
                    }
                ?>
            </div>
        </div>
        <br><br>
        <div class="card">
            <div class="card-header">
                Delete Record
            </div>

            <div class="card-body">
                <h5 class="card-title">Delete Operation</h5>
                <form method="POST">
                    <div class="form-group">
                        <label for="delivery_person_namedel"></label>
                        <input type="text" class="form-control" id="delivery_person_name" name="delivery_person_namedel" placeholder="delivery_person_name to remove">
                    </div>
                    <input type="submit" name="delete" class="btn btn-primary" value="Delete">
                </form>
                <?php
                    if(array_key_exists('delivery_person_namedel', $_POST)){
                        
                        $delivery_person_name_del = $_POST['delivery_person_namedel'];
                        $sql_del = "delete from delivery_person_table where delivery_person_name='".$delivery_person_name_del."'";
                        $result_del = mysqli_query($conn, $sql_del);
                        echo "Record Deleted Successfully";

                    }
                ?>
            </div>
        </div>

        <br><br>
        <div class="card">
            <div class="card-header">
                Update Record
            </div>

            <div class="card-body">
                <h5 class="card-title">Update Operation</h5>
                <form method="POST">
                <div class="form-group">
                        <label for="dbname">delivery_person_name</label>
                        <input type="text" class="form-control" id="dbname" name="delivery_person_nameup" placeholder="delivery_person_name">
                    </div>
                   
                    <div class="form-group">
                        <label for="dbname">seller_id</label>
                        <input type="text" class="form-control" id="seller_id" name="seller_idup" placeholder="seller_id">
                    </div>
                    
                    
                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                </form>
                <?php
                    if (array_key_exists('delivery_person_nameup', $_POST)  && array_key_exists('seller_idup', $_POST)) {
                        $delivery_person_nameup = $_POST['delivery_person_nameup'];
                        $seller_idup = $_POST['seller_idup'];
                        $sql = "update delivery_person_table set  seller_id='".$seller_idup."' where delivery_person_name='".$delivery_person_nameup."'";
                    
                        if (mysqli_query($conn, $sql)) {
                            echo "Updated Successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                ?>
            </div>
        </div>

        <br><br>


    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <footer>
        <nav>
            <ul class="nav__links">
                <li><a href="phpFileForFarmer.php">FARMER</a></li>
                <li><a href="phpFileForDealer.php">DEALER</a></li>
                <li><a href="phpFileForSeller.php">SELLER</a></li>
                <li><a href="phpFileForDeliveryPerson.php">DELIVERY PERSON</a></li>
                <li><a href="phpFileForCrop.php">CROP DETAILS</a></li>
                <li><a href="phpFileForCustomer.php">CUSTOMER</a></li>
</ul>
</nav>
                </footer>







</body>

</html>