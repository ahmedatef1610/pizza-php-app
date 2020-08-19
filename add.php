<?php //error_reporting(0) ?>
<?php $pageTitle = 'Add' ?>
<?php require( 'config/connection.php' )?>
<?php require( 'functions/functions.php' )?>
<?php require( 'templates/header.php' )?>
<?php require( 'templates/navbar.php' )?>

<?php
$email = $title = $ingredients = '';
$errors = ['email' => '', 'title' => '', 'ingredients' => ''];
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    if ( isset( $_POST['submit'] ) ) {
        // check email
        if ( empty( $_POST['email'] ) ) {
            $errors['email'] = 'An email is required <br />';
        } else {
            $email = $_POST['email'];
            if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
                $errors['email'] = 'Email must be a valid email address';
            }
        }
        // check title
        if ( empty( $_POST['title'] ) ) {
            $errors['title'] = 'A title is required <br />';
        } else {
            $title = $_POST['title'];
            if ( !preg_match( '/^[a-zA-Z\s]+$/', $title ) ) {
                $errors['title'] = 'Title must be letters and spaces only';
            }
        }
        // check ingredients
        if ( empty( $_POST['ingredients'] ) ) {
            $errors['ingredients'] = 'At least one ingredient is required <br />';
        } else {
            $ingredients = $_POST['ingredients'];
            if ( !preg_match( '/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients ) ) {
                $errors['ingredients'] = 'Ingredients must be a comma separated list';
            }
        }

        if(array_filter($errors)){
            //echo 'errors in form';
		} else {
            //echo 'form is valid';
			// escape sql chars
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
			// create sql
			$sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";
			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
		}
    }
}

?>

<div class='container my-3'>

    <h1 class='text-center'>Add a Pizza <i class='fad fa-pizza'></i></h1>

    <form class='w-50 mx-auto my-5' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
        <div class='form-group'>
            <label for='email'>Your Email:</label>
            <input type='email' class='form-control' id='email' name='email'
                value="<?php echo htmlspecialchars($email) ?>" required>
            <small class='form-text text-muted'><?php echo $errors['email']?></small>
        </div>
        <div class='form-group'>
            <label for='title'>Pizza Title:</label>
            <input type='text' class='form-control' id='title' name='title'
                value="<?php echo htmlspecialchars($title) ?>" required>
            <small class='form-text text-muted'><?php echo $errors['title']?></small>
        </div>
        <div class='form-group'>
            <label for='ingredients'>Ingredients ( comma ( , ) separated )</label>
            <input type='text' class='form-control' id='ingredients' name='ingredients'
                value="<?php echo htmlspecialchars($ingredients) ?>" required>
            <small class='form-text text-muted'><?php echo $errors['ingredients']?></small>
        </div>
        <div class='form-group mt-5'>
            <button type='submit' class='btn btn-primary btn-block' name='submit'>Submit</button>
        </div>
    </form>

</div>

<?php require( 'templates/footer.php' ) ?>