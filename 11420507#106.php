<?php
interface AjaxCallable {}

class MyClass implements AjaxCallable 
{
    // Your code here
}

$class = $_POST['class'];
$method = $_POST['method'];

if ( class_exists( $class ) && in_array( 'AjaxCallable', class_implements( $class ) ) ) {
    call_user_func( $class, $method );
}
