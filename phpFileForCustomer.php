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
    echo "<br> <h1>CUSTOMER  REGISTERATION</h1> ";
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
                        <label for="dbname">customer_name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="customer_name">
                    </div>
                    <div class="form-group">
                        <label for="dbname">customer_phoneno</label>
                        <input type="text" class="form-control" id="customer_phoneno" name="customer_phoneno" placeholder="customer_phoneno">
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="dbname">customer_bank_details</label>
                        <input type="text" class="form-control" id="customer_bank_details" name="customer_bank_details" placeholder="customer_bank_details">
                    </div>
                
                    <div class="form-group">
                        <label for="dbname">quality_analysis</label>
                        <input type="text" class="form-control" id="quality_analysis" name="quality_analysis" placeholder="quality_analysis">
                    </div>
                
                    <input type="submit" name="insert" class="btn btn-primary" value="Insert">
                </form>
                <?php //start of php 
                    if (array_key_exists('customer_name', $_POST) && array_key_exists('customer_phoneno', $_POST) && array_key_exists('customer_bank_details', $_POST)&& array_key_exists('quality_analysis', $_POST)) {//--all must have values
                        $customer_name = $_POST['customer_name'];
                        $customer_phoneno = $_POST['customer_phoneno'];
                        $customer_bank_details = $_POST['customer_bank_details'];
                        $quality_analysis = $_POST['quality_analysis'];
                        
                        $sql = "insert into customer_table(customer_name,customer_phoneno,customer_bank_details,quality_analysis) values ('".$customer_name ."', '". $customer_phoneno."', '".$customer_bank_details."', '".$quality_analysis."')";
                    
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
                        $sql_read = "select customer_name,customer_phoneno,quality_analysis from ".$tablename;
                        $result_read = mysqli_query($conn, $sql_read);
                        
                        if (mysqli_num_rows($result_read) > 0) {
                            while($row = mysqli_fetch_assoc($result_read)) {
                                echo "<pre> customer_name: ".$row["customer_name"]."   customer_phoneno: " .$row["customer_phoneno"]." quality_analysis:  " .$row["quality_analysis"]."   </pre><br>";
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
                        <label for="customer_namedel"></label>
                        <input type="text" class="form-control" id="customer_name" name="customer_namedel" placeholder="customer_name to remove">
                    </div>
                    <input type="submit" name="delete" class="btn btn-primary" value="Delete">
                </form>
                <?php
                    if(array_key_exists('customer_namedel', $_POST)){
                        
                        $customer_name_del = $_POST['customer_namedel'];
                        $sql_del = "delete from customer_table where customer_name='".$customer_name_del."'";
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
                        <label for="dbname">customer_name</label>
                        <input type="text" class="form-control" id="dbname" name="customer_nameup" placeholder="customer_name">
                    </div>
                    <div class="form-group">
                        <label for="dbname">quality_analysis</label>
                        <input type="text" class="form-control" id="quality_analysis" name="quality_analysisup" placeholder="quality_analysis">
                    </div>
                    
                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                </form>
                <?php
                    if (array_key_exists('customer_nameup', $_POST) && array_key_exists('quality_analysisup', $_POST)) {
                        $customer_nameup = $_POST['customer_nameup'];
                        $quality_analysisup = $_POST['quality_analysisup'];
                        $sql = "update customer_table set quality_analysis='".$quality_analysisup."' where customer_name='".$customer_nameup."'";
                    
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