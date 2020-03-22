<?php require_once 'startSession.php' ?>
<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$name = $quantity = $price =$image= "";
$name_err = $quantity_err = $price_err = $image_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    }  else{
        $name = $input_name;
    }
    
    // Validate quantity
    $input_quantity = trim($_POST["quantity"]);
    if(empty($input_quantity)){
        $quantity_err = 'Please enter an quantity.';     
    } else{
        $quantity = $input_quantity;
    }
    
    // Validate price
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price amount.";     
    } elseif(!ctype_digit($input_price)){
        $price_err = 'Please enter a positive integer value.';
    } else{
        $price = $input_price;
    }

    
    if(isset($_FILES['image'])){
        // $errors= array();
        $image = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
        
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
           $image_err="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 2097152){
           $image_err+='File size must be excately 2 MB';
        }
        
        if(empty($image_err)==true){
           move_uploaded_file($file_tmp,"images/".$image);
        //    echo "Success";
        }else{
        //    print_r($image_err);
        }
     }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($quantity_err) && empty($price_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO flowerstocks (name, quantity, price, image) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_quantity, $param_price,$param_image);
            
            // Set parameters
            $image=($image=='')?"flowerDefault.jpg":$image;
            $param_name = $name;
            $param_quantity = $quantity;
            $param_price = $price;
            $param_image = $image;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
   <?php include_once 'style.php'; ?> 
</head>
<body>
<?php include_once 'navbar.php'; ?>
    <div class="wrapper">
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype = "multipart/form-data">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($quantity_err)) ? 'has-error' : ''; ?>">
                            <label>quantity</label>
                            <textarea name="quantity" class="form-control"><?php echo $quantity; ?></textarea>
                            <span class="help-block"><?php echo $quantity_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $price_err;?></span>
                        </div>
                     

                       
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">image</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"  name="image" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                <span class="help-block"><?php echo $image_err;?></span>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="admin.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>