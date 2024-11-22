<?php
//require('../model/database.php');     Commented so it doesn't throw an error. Uncomment after database.php is finished
//require('../model/product_db.php');   Commented for reference. If you want a primary key, you need to make a php file for it (Assignment 1)


//Consider using a similar structure as Assignment 1 by using $action variables to control site functions. Index functions as a hub for
//the actions. 'list_flights' is the default page instead of index.

/*
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
} */

//Kept for reference. This is how you do actions. Go to Assignment 1's Project Manager for further references.

/*
if ($action == 'list_products') {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $products = get_products_by_category($category_id);
    include('product_list.php');
} */ 

?>