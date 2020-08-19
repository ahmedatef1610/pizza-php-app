<?php
// connect to the database
$conn = mysqli_connect( '127.0.0.1:3325', 'root', '', 'pizza' );
// check connection
if ( !$conn ) {
    echo 'Connection Error: '. mysqli_connect_error();
    exit();
}
?>