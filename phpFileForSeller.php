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
    echo "<br> <h1>SELLER REGISTERATION</h1> ";
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
                        <label for="dbname">seller_name</label>
                        <input type="text" class="form-control" id="seller_name" name="seller_name" placeholder="seller_name">
                    </div>
                    <div class="form-group">
                        <label for="dbname">seller_phoneno</label>
                        <input type="text" class="form-control" id="seller_phoneno" name="seller_phoneno" placeholder="seller_phoneno">
                    </div>
                    <div class="form-group">
                        <label for="dbname">seller_bank_details</label>
                        <input type="text" class="form-control" id="seller_bank_details" name="seller_bank_details" placeholder="seller_bank_details">
                    </div>
                    <div class="form-group">
                        <label for="dbname">seller_quantity_analysis</label>
                        <input type="text" class="form-control" id="seller_quantity_analysis" name="seller_quantity_analysis" placeholder="seller_quantity_analysis">
                    </div>
                    <div class="form-group">
                        <label for="dbname">date_of_expiry</label>
                        <input type="text" class="form-control" id="date_of_expiry" name="date_of_expiry" placeholder="date_of_expiry">
                    </div>
                    <div class="form-group">
                        <label for="dbname">dealer_id</label>
                        <input type="text" class="form-control" id="dealer_id" name="dealer_id" placeholder="dealer_id">
                    </div>
                    <input type="submit" name="insert" class="btn btn-primary" value="Insert">
                </form>
                <?php //start of php 
                    if (array_key_exists('seller_name', $_POST) && array_key_exists('seller_phoneno', $_POST) && array_key_exists('seller_bank_details', $_POST)&& array_key_exists('seller_quantity_analysis', $_POST)&& array_key_exists('date_of_expiry', $_POST)&& array_key_exists('dealer_id', $_POST)) {//--all must have values
                        $seller_name = $_POST['seller_name'];
                        $seller_phoneno = $_POST['seller_phoneno'];
                        $seller_bank_details = $_POST['seller_bank_details'];
                        $seller_quantity_analysis = $_POST['seller_quantity_analysis'];
                        $date_of_expiry = $_POST['date_of_expiry'];
                        $dealer_id= $_POST['dealer_id'];
                        $sql = "insert into seller_table(seller_name,seller_phoneno,seller_bank_details,seller_quantity_analysis,date_of_expiry,dealer_id) values ('".$seller_name ."', '". $seller_phoneno."', '".$seller_bank_details."', '".$seller_quantity_analysis ."', '".$date_of_expiry ."' , '".$dealer_id ."' )";
                    
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
                        $sql_read = "select seller_name,seller_phoneno,seller_quantity_analysis,date_of_expiry from ".$tablename;
                        $result_read = mysqli_query($conn, $sql_read);
                        
                        if (mysqli_num_rows($result_read) > 0) {
                            while($row = mysqli_fetch_assoc($result_read)) {
                                echo "<pre> seller_NAME: ".$row["seller_name"]."   seller_PHONENO: " .$row["seller_phoneno"]."   QUANTITY:  " .$row["seller_quantity_analysis"]."  DATEOFEXPIRY:  " .$row["date_of_expiry"]."</pre><br>";
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
                        <label for="seller_namedel"></label>
                        <input type="text" class="form-control" id="seller_name" name="seller_namedel" placeholder="seller_name to remove">
                    </div>
                    <input type="submit" name="delete" class="btn btn-primary" value="Delete">
                </form>
                <?php
                    if(array_key_exists('seller_namedel', $_POST)){
                        
                        $seller_name_del = $_POST['seller_namedel'];
                        $sql_del = "delete from seller_table where seller_name='".$seller_name_del."'";
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
                        <label for="dbname">seller_name</label>
                        <input type="text" class="form-control" id="dbname" name="seller_nameup" placeholder="seller_name">
                    </div>
                    <div class="form-group">
                        <label for="dbname">date_of_expiry</label>
                        <input type="text" class="form-control" id="date_of_expiry" name="date_of_expiryup" placeholder="date_of_expiry">
                    </div>
                    <div class="form-group">
                        <label for="dbname">seller_quantity_analysis</label>
                        <input type="text" class="form-control" id="seller_quantity_analysis" name="seller_quantity_analysisup" placeholder="seller_quantity_analysis">
                    </div>
                    <div class="form-group">
                        <label for="dbname">dealer_id</label>
                        <input type="text" class="form-control" id="dealer_id" name="dealer_idup" placeholder="dealer_id">
                    </div>
                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                </form>
                <?php
                    if (array_key_exists('seller_nameup', $_POST) && array_key_exists('seller_quantity_analysisup', $_POST) && array_key_exists('date_of_expiryup', $_POST)&& array_key_exists('dealer_idup', $_POST)) {
                        $seller_nameup = $_POST['seller_nameup'];
                        $dealer_idup = $_POST['dealer_idup'];
                        $date_of_expiryup = $_POST['date_of_expiryup'];
                        $seller_quantity_analysisup = $_POST['seller_quantity_analysisup'];
                        $sql = "update seller_table set seller_quantity_analysis='".$seller_quantity_analysisup."', date_of_expiry='".$date_of_expiryup."', dealer_id='".$dealer_idup."' where seller_name='".$seller_nameup."'";
                    
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