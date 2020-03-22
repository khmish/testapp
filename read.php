<?php require_once 'startSession.php' ?>
<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once 'config.php';
    
    // Prepare a select statement
     // Get URL parameter
     $id =  trim($_GET["id"]);
        
     // Prepare a select statement
     $sql = "SELECT * FROM flowerstocks WHERE id = ?";
     if($stmt = mysqli_prepare($link, $sql)){
         // Bind variables to the prepared statement as parameters
         mysqli_stmt_bind_param($stmt, "i", $param_id);
         
         // Set parameters
         $param_id = $id;
         
         // Attempt to execute the prepared statement
         if(mysqli_stmt_execute($stmt)){
             $result = mysqli_stmt_get_result($stmt);
 
             if(mysqli_num_rows($result) == 1){
                 /* Fetch result row as an associative array. Since the result set
                 contains only one row, we don't need to use while loop */
                 $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                 
                 // Retrieve individual field value
                 $name = $row["name"];
                 $quantity = $row["quantity"];
                 $price = $row["price"];
                 $image = "images/".$row["image"];
                 
             } else{
                 // URL doesn't contain valid id. Redirect to error page
                 header("location: error.php");
                 exit();
             }
             
         
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <?php include_once 'style.php'; ?>
</head>
<body>
<?php include_once 'navbar.php'; ?>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>quantity</label>
                        <p class="form-control-static"><?php echo $quantity; ?></p>
                    </div>
                    <div class="form-group">
                        <label>price</label>
                        <p class="form-control-static"><?php echo $price; ?></p>
                    </div>
                    <div class="form-group">
                        <label>image</label>
                        <img class="card-img-top"  src='<?php echo $image;?>' alt="Card image cap">
                    </div>
                    <p><a href="admin.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>