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
    echo "<br> <h1>CROP DETAILS REGISTERATION</h1> ";
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
                        <label for="dbname">amount_in_rupees</label>
                        <input type="text" class="form-control" id="amount_in_rupees" name="amount_in_rupees" placeholder="amount_in_rupees">
                    </div>
                    <div class="form-group">
                        <label for="dbname">quantity_in_kg</label>
                        <input type="text" class="form-control" id="quantity_in_kg" name="quantity_in_kg" placeholder="quantity_in_kg">
                    </div>
                    <input type="submit" name="insert" class="btn btn-primary" value="Insert">
                </form>
                <?php //start of php 
                    if (array_key_exists('amount_in_rupees', $_POST) && array_key_exists('quantity_in_kg', $_POST) ) {//--all must have values
                        $amount_in_rupees = $_POST['amount_in_rupees'];
                        $quantity_in_kg = $_POST['quantity_in_kg'];
                        
                        $sql = "insert into crop_table(amount_in_rupees,quantity_in_kg) values ('".$amount_in_rupees ."', '". $quantity_in_kg."')";
                    
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
                        $sql_read = "select amount_in_rupees,quantity_in_kg from ".$tablename;
                        $result_read = mysqli_query($conn, $sql_read);
                        
                        if (mysqli_num_rows($result_read) > 0) {
                            while($row = mysqli_fetch_assoc($result_read)) {
                                echo "<pre> amount_in_rupees: ".$row["amount_in_rupees"]."   quantity_in_kg: " .$row["quantity_in_kg"]."    </pre><br>";
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
                        <label for="amount_in_rupeesdel"></label>
                        <input type="text" class="form-control" id="amount_in_rupees" name="amount_in_rupeesdel" placeholder="amount_in_rupees to remove">
                    </div>
                    <input type="submit" name="delete" class="btn btn-primary" value="Delete">
                </form>
                <?php
                    if(array_key_exists('amount_in_rupeesdel', $_POST)){
                        
                        $amount_in_rupees_del = $_POST['amount_in_rupeesdel'];
                        $sql_del = "delete from crop_table where amount_in_rupees='".$amount_in_rupees_del."'";
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
                        <label for="dbname">amount_in_rupees</label>
                        <input type="text" class="form-control" id="dbname" name="amount_in_rupeesup" placeholder="amount_in_rupees">
                    </div>
                   
                    <div class="form-group">
                        <label for="dbname">quantity_in_kg</label>
                        <input type="text" class="form-control" id="quantity_in_kg" name="quantity_in_kgup" placeholder="quantity_in_kg">
                    </div>
                    
                    
                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                </form>
                <?php
                    if (array_key_exists('amount_in_rupeesup', $_POST)  && array_key_exists('quantity_in_kgup', $_POST)) {
                        $amount_in_rupeesup = $_POST['amount_in_rupeesup'];
                        $quantity_in_kgup = $_POST['quantity_in_kgup'];
                        $sql = "update crop_table set  quantity_in_kg='".$quantity_in_kgup."' where amount_in_rupees='".$amount_in_rupeesup."'";
                    
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