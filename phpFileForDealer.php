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
    echo "<br> <h1>DEALER REGISTERATION</h1> ";
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
                        <label for="dbname">dealer_name</label>
                        <input type="text" class="form-control" id="dealer_name" name="dealer_name" placeholder="dealer_name">
                    </div>
                    <div class="form-group">
                        <label for="dbname">dealer_phoneno</label>
                        <input type="text" class="form-control" id="dealer_phoneno" name="dealer_phoneno" placeholder="dealer_phoneno">
                    </div>
                    
                   
                    <div class="form-group">
                        <label for="dbname">dealer_bank_details</label>
                        <input type="text" class="form-control" id="dealer_bank_details" name="dealer_bank_details" placeholder="dealer_bank_details">
                    </div>
                
                    <div class="form-group">
                        <label for="dbname">dealer_quantity_analysis</label>
                        <input type="text" class="form-control" id="dealer_quantity_analysis" name="dealer_quantity_analysis" placeholder="dealer_quantity_analysis">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_id</label>
                        <input type="text" class="form-control" id="farmer_id" name="farmer_id" placeholder="farmer_id">
                    </div>
                    <input type="submit" name="insert" class="btn btn-primary" value="Insert">
                </form>
                <?php //start of php 
                    if (array_key_exists('dealer_name', $_POST) && array_key_exists('dealer_phoneno', $_POST)  && array_key_exists('dealer_bank_details', $_POST)&& array_key_exists('dealer_quantity_analysis', $_POST)&& array_key_exists('farmer_id', $_POST)) {//--all must have values
                        $dealer_name = $_POST['dealer_name'];
                        $dealer_phoneno = $_POST['dealer_phoneno'];
                        $dealer_bank_details = $_POST['dealer_bank_details'];
                        $dealer_quantity_analysis = $_POST['dealer_quantity_analysis'];
                        $farmer_id = $_POST['farmer_id'];
                        $sql = "insert into dealer_table(dealer_name,dealer_phoneno,dealer_bank_details,dealer_quantity_analysis,farmer_id) values ('".$dealer_name ."', '". $dealer_phoneno."',  '".$dealer_bank_details."', '".$dealer_quantity_analysis ."', '".$farmer_id ."' )";
                    
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
                        $sql_read = "select dealer_name,dealer_phoneno,dealer_quantity_analysis,farmer_id,dealer_bank_details from ".$tablename;
                        $result_read = mysqli_query($conn, $sql_read);
                        
                        if (mysqli_num_rows($result_read) > 0) {
                            while($row = mysqli_fetch_assoc($result_read)) {
                                echo "<pre> dealer_name: ".$row["dealer_name"]."   dealer_phoneno: " .$row["dealer_phoneno"]." QUANTITY ANALYSIS OF DEALER:  " .$row["dealer_quantity_analysis"]."  FARMERID:  " .$row["farmer_id"]."  BANK DETAILS OF DEALER:  " .$row["dealer_bank_details"]." </pre><br>";
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
                        <label for="dealer_namedel"></label>
                        <input type="text" class="form-control" id="dealer_name" name="dealer_namedel" placeholder="dealer_name to remove">
                    </div>
                    <input type="submit" name="delete" class="btn btn-primary" value="Delete">
                </form>
                <?php
                    if(array_key_exists('dealer_namedel', $_POST)){
                        
                        $dealer_name_del = $_POST['dealer_namedel'];
                        $sql_del = "delete from dealer_table where dealer_name='".$dealer_name_del."'";
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
                        <label for="dbname">dealer_name</label>
                        <input type="text" class="form-control" id="dbname" name="dealer_nameup" placeholder="dealer_name">
                    </div>
                    <div class="form-group">
                        <label for="dbname">farmer_id</label>
                        <input type="text" class="form-control" id="farmer_id" name="farmer_idup" placeholder="farmer_id">
                    </div>
                    <div class="form-group">
                        <label for="dbname">dealer_quantity_analysis</label>
                        <input type="text" class="form-control" id="dealer_quantity_analysis" name="dealer_quantity_analysisup" placeholder="dealer_quantity_analysis">
                    </div>
                    
                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                </form>
                <?php
                    if (array_key_exists('dealer_nameup', $_POST) && array_key_exists('farmer_idup', $_POST) &&array_key_exists('dealer_quantity_analysisup', $_POST)) {
                        $dealer_nameup = $_POST['dealer_nameup'];
                        $farmer_idup = $_POST['farmer_idup'];
                        $dealer_quantity_analysisup = $_POST['dealer_quantity_analysisup'];
                        $sql = "update dealer_table set farmer_id='".$farmer_idup."', dealer_quantity_analysis='".$dealer_quantity_analysisup."' where dealer_name='".$dealer_nameup."'";
                    
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