
<?php 
  session_start();
  //$_SESSION['name'] = 'mario';
  if($_SERVER['QUERY_STRING'] == 'noname'){
    //unset($_SESSION['name']);
    session_unset();
  }
    // null coalesce
    $name = $_SESSION['name'] ?? 'Guest';
    // get cookie
    $gender = $_COOKIE['gender'] ?? 'Unknown';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php"><img src="upload/icon.png" class="img-fluid" alt="icon" width="40"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto justify-content-between">
                <li class="nav-item <?php echo ($pageTitle=="Home")?"active":""?>">
                    <a class="nav-link" href="index.php">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sandbox.php">Sandbox</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if($name):?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="btn btn-dark">
                                Hello <?php echo htmlspecialchars($name); ?>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="btn btn-dark">
                                <?php echo htmlspecialchars($gender); ?>
                            </span>
                        </a>
                    </li>
                <?php endif ?>

                <li class="nav-item">
                    <a class="nav-link" href="add.php">
                        <span class="btn btn-<?php echo ($pageTitle=="Add")?"success":"primary"?>">
                            <i class='fad fa-pizza'></i> Add a Pizza 
                        </span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>