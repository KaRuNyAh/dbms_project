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
    echo "<br> <h1>FARMER REGISTERATION</h1> ";
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
                        <label for="dbname">farmer_name</label>
                        <input type="text" class="form-control" id="farmer_name" name="farmer_name" placeholder="farmer_name">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_phoneno</label>
                        <input type="text" class="form-control" id="farmer_phoneno" name="farmer_phoneno" placeholder="farmer_phoneno">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_address</label>
                        <input type="text" class="form-control" id="farmer_address" name="farmer_address" placeholder="farmer_address">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_age</label>
                        <input type="text" class="form-control" id="farmer_age" name="farmer_age" placeholder="farmer_age">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_bank_details</label>
                        <input type="text" class="form-control" id="farmer_bank_details" name="farmer_bank_details" placeholder="farmer_bank_details">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_rate_estimation</label>
                        <input type="text" class="form-control" id="farmer_rate_estimation" name="farmer_rate_estimation" placeholder="farmer_rate_estimation">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_quantity</label>
                        <input type="text" class="form-control" id="farmer_quantity" name="farmer_quantity" placeholder="farmer_quantity">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_crop_type</label>
                        <input type="text" class="form-control" id="farmer_crop_type" name="farmer_crop_type" placeholder="farmer_crop_type">
                    </div>
                    <input type="submit" name="insert" class="btn btn-primary" value="Insert">
                </form>
                <?php //start of php 
                    if (array_key_exists('farmer_name', $_POST) && array_key_exists('farmer_phoneno', $_POST) && array_key_exists('farmer_address', $_POST) && array_key_exists('farmer_age', $_POST)&& array_key_exists('farmer_bank_details', $_POST)&& array_key_exists('farmer_rate_estimation', $_POST)&& array_key_exists('farmer_quantity', $_POST)&& array_key_exists('farmer_crop_type', $_POST)) {//--all must have values
                        $farmer_name = $_POST['farmer_name'];
                        $farmer_phoneno = $_POST['farmer_phoneno'];
                        $farmer_address = $_POST['farmer_address'];
                        $farmer_age = $_POST['farmer_age'];
                        $farmer_bank_details = $_POST['farmer_bank_details'];
                        $farmer_rate_estimation = $_POST['farmer_rate_estimation'];
                        $farmer_quantity = $_POST['farmer_quantity'];
                        $farmer_crop_type = $_POST['farmer_crop_type'];
                        $sql = "insert into farmer_table(farmer_name,farmer_phoneno,farmer_address,farmer_age,farmer_bank_details,farmer_rate_estimation,farmer_quantity,farmer_crop_type) values ('".$farmer_name ."', '". $farmer_phoneno."', '".$farmer_address."', '".$farmer_age."', '".$farmer_bank_details."', '".$farmer_rate_estimation."', '".$farmer_quantity ."', '".$farmer_crop_type ."' )";
                    
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
                        $sql_read = "select farmer_name,farmer_phoneno,farmer_rate_estimation,farmer_quantity,farmer_crop_type from ".$tablename;
                        $result_read = mysqli_query($conn, $sql_read);
                        
                        if (mysqli_num_rows($result_read) > 0) {
                            while($row = mysqli_fetch_assoc($result_read)) {
                                echo "<pre> FARMER_NAME: ".$row["farmer_name"]."   FARMER_PHONENO: " .$row["farmer_phoneno"]." RATE_ESTIMATE:  " .$row["farmer_quantity"]."  QUANTITY:  " .$row["farmer_crop_type"]."  CROPTYPE:  " .$row["farmer_rate_estimation"]."</pre><br>";
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
                        <label for="farmer_namedel"></label>
                        <input type="text" class="form-control" id="farmer_name" name="farmer_namedel" placeholder="farmer_name to remove">
                    </div>
                    <input type="submit" name="delete" class="btn btn-primary" value="Delete">
                </form>
                <?php
                    if(array_key_exists('farmer_namedel', $_POST)){
                        
                        $farmer_name_del = $_POST['farmer_namedel'];
                        $sql_del = "delete from farmer_table where farmer_name='".$farmer_name_del."'";
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
                        <label for="dbname">farmer_name</label>
                        <input type="text" class="form-control" id="dbname" name="farmer_nameup" placeholder="farmer_name">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_rate_estimation</label>
                        <input type="text" class="form-control" id="farmer_rate_estimation" name="farmer_rate_estimationup" placeholder="farmer_rate_estimation">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_crop_type</label>
                        <input type="text" class="form-control" id="farmer_crop_type" name="farmer_crop_typeup" placeholder="farmer_crop_type">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_quantity</label>
                        <input type="text" class="form-control" id="farmer_quantity" name="farmer_quantityup" placeholder="farmer_quantity">
                    </div>
                    
                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                </form>
                <?php
                    if (array_key_exists('farmer_nameup', $_POST) && array_key_exists('farmer_rate_estimationup', $_POST) && array_key_exists('farmer_crop_typeup', $_POST)) {
                        $farmer_nameup = $_POST['farmer_nameup'];
                        $farmer_rate_estimationup = $_POST['farmer_rate_estimationup'];
                        $farmer_crop_typeup = $_POST['farmer_crop_typeup'];
                        $farmer_quantityup = $_POST['farmer_quantityup'];
                        $sql = "update farmer_table set farmer_rate_estimation='".$farmer_rate_estimationup."', farmer_crop_type='".$farmer_crop_typeup."', farmer_quantity='".$farmer_quantityup."' where farmer_name='".$farmer_nameup."'";
                    
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