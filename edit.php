<?php
  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"], 1);
   $conn = mysqli_connect($server, $username, $password, $db);
    
    if(isset($_GET['edit_doit'])){
        $e_id=$_GET['edit_doit'];
    }

    if(isset($_POST['edit_doit'])){
        $edit_doit=$_POST['doit'];
        $edit_details = $_POST['details'];
        $query = "UPDATE doit  
            SET t_title = '$edit_doit'
            ,t_details = '$edit_details' WHERE t_id = $e_id";
        $run = mysqli_query($conn,$query);
        if(!$run){
            die("Failed to edit");
        } else {
            header("Location: index.php?updated");
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
  <div class="container">
  <!-- PAGE 1 -->
  <section class="page-1">
        <h1 class="title ml2" id="title">Let us do things that <br> make us productive and happy</h1>
        <div class="container-fluid pic">
            <img src="https://opendoodles.s3-us-west-1.amazonaws.com/reading.svg" class="image2"/>
        </div>
            <div class="todo">
                <div class="todo-contain">
                    <h5 class="sub-title">View</h5>
                    <form action="" method="POST">
                        <?php
                            $sql = "SELECT * FROM doit where t_id = $e_id";
                            $result = mysqli_query($conn,$sql);
                            $data = mysqli_fetch_array($result);
                        ?>
                        <div class="form-group">
                            <label for="FormControlInput1">Title</label>
                            <input type="text" class="form-control" id="FormControlInput1" name="doit" value="<?php echo $data['t_title']?>">
                        </div>
                        <div class="form-group">
                            <label for="FormControlTextarea1">Description</label>
                            <textarea class="form-control" id="FormControlTextarea1" name= "details" rows="3"><?php echo $data['t_details']?></textarea>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" value="Edit" type="submit" name="edit_doit">
                            <a href="index.php"><input type="button" class="btn btn-secondary" value="Back" name="edit_back"  style="margin-left: 10px;"> </a>
                        </div>
                    </form>
                </div>
            </div>
         
        </section>
  </div>
</main>

<footer class="footer mt-auto py-3">
  <div class="container text-center">
    <span>&copy; Ada Pauline. All Rights Reserved  2020-2021 </span>
  </div>
</footer>
    <script src="resources/js/bootstrap.min.js" type="text/javaScript"></script>
    <script src="resources/js/bootstrap.bundle.min.js" type="text/javaScript"></script>
    <script src="resources/js/main.js" type="text/javaScript"></script>
</body>
</html>