<?php
//1
function getTitle() {
    global $pageTitle;
    if ( isset( $pageTitle ) ) {
        echo $pageTitle;
    } else {
        echo 'Default';
    }
}
?>