<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
 $conn = mysqli_connect($server, $username, $password, $db);
    $query = "SELECT * FROM doit";
    $result = mysqli_query($conn,$query);
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $query = "SELECT * FROM doit WHERE t_title LIKE '%$search%'";
        $result = mysqli_query($conn,$query);
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
                <li class="nav-item"><a class="nav-link" href="index.php#create">Create</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#list">List</a></li>
                </ul>
            </div>
            </div>
        </nav>
        
        <!-- PAGE 1 -->
        <div class="container" >
        <section class="page-1">
            <h1 class="ml2">Do what you must do</h1>
        </section>
        <div class="d-flex justify-content-center">
            <img src="https://opendoodles.s3-us-west-1.amazonaws.com/clumsy.svg" class="picture" />
        </div>
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
        
                        if(mysqli_num_rows($result)==0){
                                echo "<tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>No result found</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>"; 
                            } else {
                                while($row = mysqli_fetch_assoc($result)){
                                    $t_id = $row['t_id']; 
                                    $t_title = $row['t_title'];
                                    $t_details = $row['t_details'];
                                    $t_date = $row['t_date']; 
                            }
                           
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
         <span id='topper'>&#11165;</span>
        </a> 
    </div>

    <footer class="footer mt-auto">
  <div class="footer-contain">
    <span>&copy; Ada Pauline. All Rights Reserved  2020-2021 </span>
  </div>
</footer>


    <script src="resources/js/bootstrap.min.js" type="text/javaScript"></script>
    <script src="resources/js/bootstrap.bundle.min.js" type="text/javaScript"></script>
    <script src="resources/js/main.js" type="text/javaScript"></script>
</body>
</html>