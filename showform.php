<html>
  <head>
    <title>Dynamic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
  </head>
  <body>
  <?php

    $tablename = base64_decode($_GET['v']);

    $conn = new mysqli('localhost','root','','dynamicform');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SHOW COLUMNS FROM ".$tablename;
    $result = mysqli_query($conn,$sql);

    ?>
    <section class="content">
        <div class="col-md-12" id="assign_subject_div">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> User data fill form</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="studentsave.php?v=<?php echo base64_encode($tablename); ?>" id="assign_subject_form">
                        <!-- <div class="row"> -->
                        <?php
                            $id = 0;
                            while($row = mysqli_fetch_array($result)){
                                if($id++ == 0){
                                    continue;
                                }
                                if($row['Field'] == 'created_at'){
                                    break;
                                }
                                echo '<div class="col-md-4">';
                                echo $row['Field'].': <br>';
                                echo '<input class="form-control" name="'.$row['Field'].'" type="text" required>';
                                echo '</div>';
                                
                            }

                        ?>
                        <br>
                        <!-- </div> -->
                        <input type="submit" name="save" id="savesubject" class="btn btn-primary" value="Submit" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
  </body>
</html>



