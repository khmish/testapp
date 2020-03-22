<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <?php include_once 'style.php'; ?> 

    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Follower Store</h2>
                        <?php
                            if(isset($_SESSION["loggedin"]) && isset($_SESSION['userType']))
                            echo '<a href="create.php" class="btn btn-success pull-right m-4">Add Item</a>';
                        ?>
                        
                    </div>
                    <?php
                    // Include config file
                    require_once 'config.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM flowerstocks";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            
                            echo '<div class="row mx-2">';
                               
                                while($row = mysqli_fetch_array($result)){
                                    $imageUrl=$row["image"];
                                    $tempName=$row['name'];
                                    $tempPrice=$row['price'];
                                    $tempQuantity=$row['quantity'];
                                    echo '<div class="col-4 p-2">';
                                    echo '<div class="card " style="width: 18rem;">';
                                    echo '<img class="card-img-top" height="300" src="images/'.$imageUrl.'" alt="Card image cap">';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="card-title">'.$tempName.'</h5>';
                                    echo '<p class="card-text">price <i class="fas fa-money-bill-wave">'.$tempPrice.'</i></p>';
                                    echo '<p class="card-text">quantity <i class="fas fa-hashtag">'.$tempQuantity.'</i></p>';
                                    if(isset($_SESSION["loggedin"]) && isset($_SESSION['userType']))
                                       {
                                        if( $_SESSION["loggedin"] == true){

                                                echo "<a class='col' href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><i class='fas fa-eye'>read </i></a>";
                                                echo "<a class='col' href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><i class='fas fa-edit'>update </i></a>";
                                                echo ($_SESSION['userType']=='1')?"<a class='col' href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='fas fa-trash-alt'>delete</i></a>":'';
                                        }
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                echo '</div>';
                                
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>