<?php //error_reporting(0) ?>
<?php $pageTitle = 'Home' ?>
<?php require( 'config/connection.php' )?>
<?php require( 'functions/functions.php' )?>
<?php require( 'templates/header.php' )?>
<?php require( 'templates/navbar.php' )?>
<?php
	// write query for all pizzas
	$sql = 'SELECT * FROM pizzas ORDER BY created_at';
	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);
	// fetch the resulting rows as an array
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
	// free the $result from memory (good practise)
	mysqli_free_result($result);
	// close connection
    mysqli_close($conn); 
?>


<h1 class='text-center mt-5'>Pizza <i class="fad fa-utensils-alt"></i></h1>
<div class='container mt-5'>
    <div class="row">
        <?php foreach($pizzas as $pizza){ ?>
        <div class="col-md-4 col-sm-6 my-5">
            <div class="card text-center" style="height:100%;">
                <div class="card-img text-center mt-n5">
                    <img src="upload/pizza.svg" class="img-fluid" style="width:30%;">
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <h3 class="card-title text-warning"><?php echo htmlspecialchars($pizza['title']) ?></h3>
                    <p class="card-text">
                        <ul class="list-group">
                            <?php foreach(explode(',', $pizza['ingredients']) as $ing){ ?>
                            <li class="list-group-item"><?php echo htmlspecialchars($ing) ?></li>
                            <?php } ?>
                        </ul>
                    </p>
                    <a href="details.php?id=<?php echo $pizza['id'] ?>" class="btn btn-primary btn-block">more info</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php require( 'templates/footer.php' )?>