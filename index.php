<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
 $conn = mysqli_connect($server, $username, $password, $db);
    
    $query = "SELECT * FROM doit";
    $result = mysqli_query($conn,$query);

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $doit = $_POST['doit'];
        $details = $_POST['details'];
        $date = date('l dS F\, Y');

        if(empty($doit)){
            $error = "Field is empty";
        } else{
            $sql = "INSERT INTO doit(t_title,t_details,t_date) VALUES('$doit','$details','$date');";
            $results = mysqli_query($conn,$sql);
            if(!$results){
                die("Failed to insert");
            } else {
                header("Location: index.php?doit-added");
            }
        }
        
    }   
        

    if(isset($_GET['delete_doit'])){
        $dtl_doit = $_GET['delete_doit'];
        $sqli = "DELETE FROM doit WHERE t_id = $dtl_doit";
        $res = mysqli_query($conn,$sqli);
        if(!$res){
            die("Failed to delete");
        } else {
            header("Location: index.php?doit-deleted");
        }
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="resources/css/custom.css">
    <link rel="icon" href="resources/images/Logo.png">
    <title>Do It!</title>
</head>
<body >
<a name="topmost"></a>  
<a name="create"></a>
         <!--NAVIGATION-->
         <nav id="navbar_top" class="navbar sticky-top navbar-expand-lg navbar-light bg-light" role="navigation">
            <div class="container">
                <span class="nav-title">Do It!</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav">	
                <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#create">Create</a></li>
                <li class="nav-item"><a class="nav-link" href="#list">List</a></li>
                </ul>
            </div>
            </div>
        </nav>
        <div class="container-fluid pic">
                <img src="https://opendoodles.s3-us-west-1.amazonaws.com/sitting-reading.svg" class="image-fluid image"/>                        
        </div>

    <div class="container">
        <!-- PAGE 1 -->
        <section class="page-1">
        <h1 class="title ml2" id="title">Let's do it!</h1>
            <div class="todo">
                <div class="todo-contain">
                    <h5 class="sub-title">Create</h5>
                    <?php
                        if(isset($error)){
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label for="FormControlInput1">Title</label>
                            <input type="text" class="form-control" id="FormControlInput1" name="doit" placeholder="Do yoga">
                        </div>
                        <div class="form-group">
                            <label for="FormControlTextarea1">Description</label>
                            <textarea class="form-control" id="FormControlTextarea1" name= "details" rows="3" placeholder="Exercise for at least 30 mins."></textarea>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" value="Add" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <div class="container">
    <!-- PAGE 2 -->
        <a name="list"></a>
        <section class="page-2">
            <div class="table-contain">
            <div class="col-lg-3 search" >
                <form action="search.php" method="POST">
                    <input type="text" class="form-control" name="search" placeholder="Search">
                </form>
            </div>
                <div class="table-responsive col-lg-12">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Date created</th>
                            <th>View</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <!-- READ  -->
                        <?php
                            while($row = mysqli_fetch_assoc($result)){
                                $t_id = $row['t_id']; 
                                $t_title = $row['t_title'];
                                $t_details = $row['t_details'];
                                $t_date = $row['t_date']; 
                            ?>
                             <tr>
                                <td><?php echo $t_id;?></td>
                                <td><?php echo $t_title;?></td>
                                <td><?php echo $t_date;?></td>
                                <td><a href="edit.php?edit_doit=<?php echo $t_id;?>" class="btn btn-info">View</a></td>
                                <td><a href="index.php?delete_doit=<?php echo $t_id;?>" class="btn btn-danger">Delete</a></td>
                            </tr>

                        <?php    }

                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            &nbsp;&nbsp;
        </section>   
        <a href='#topmost'>
         <span id='topper' >&#11165;</span>
        </a> 
    </div>

    <footer class="footer mt-auto py-3">
  <div class="footer-contain">
    <span>&copy; Ada Pauline. All Rights Reserved  2020-2021 </span>
  </div>
</footer>

    <script src="resources/js/bootstrap.min.js" type="text/javaScript"></script>
    <script src="resources/js/bootstrap.bundle.min.js" type="text/javaScript"></script>
    <script src="resources/js/main.js" type="text/javaScript"></script>
</body>
</html>