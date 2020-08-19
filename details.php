<?php //error_reporting( 0 ) ?>
<?php $pageTitle = 'Details' ?>
<?php require( 'config/connection.php' )?>
<?php require( 'functions/functions.php' )?>
<?php require( 'templates/header.php' )?>
<?php require( 'templates/navbar.php' )?>
<?php

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";
    if(mysqli_query($conn, $sql)){
        header('Location: index.php');
    } else {
        echo 'query error: '. mysqli_error($conn);
    }
}

$pizza = null;

if ( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) {
    // escape sql chars
    $id = mysqli_real_escape_string( $conn, $_GET['id'] );
    // make sql
    $sql = "SELECT * FROM pizzas WHERE id = $id";
    // get the query result
    $result = mysqli_query( $conn, $sql );
    // fetch result in array format
    $pizza = mysqli_fetch_assoc( $result );
    mysqli_free_result( $result );
    mysqli_close( $conn );
}
?>

<h1 class='text-center mt-5'>Pizza</h1>
<div class='container mt-5'>
    <?php if ( $pizza ) : ?>
        <h3><?php echo $pizza['title'] ?></h3>
        <p>Created by <?php echo $pizza['email'] ?></p>
        <p><?php echo $pizza['created_at'] ?></p>
        <h3>Ingredients:</h3>
        <p><?php echo $pizza['ingredients'] ?></p>
        <!-- DELETE FORM -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
        </form>
    <?php else : ?>
        <h5>No such pizza exists.</h5>
    <?php endif ?>
</div>

<?php require( 'templates/footer.php' )?>