<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// include the database and model   
include_once "../../config/Database.php";
include_once "../../models/Post.php";


// Instantiate Database and connect
$database = new Database();
$db = $database->connect(); //calling the connect method in database class

// Rep blog post object
$post = new Post($db);

// Call the read method in Post class
$result = $post->read();
// Get row count; help count the row in a table
$num = $result->rowCount();

// check if there's post
if($num > 0){
    // Post array
    $post_arr = array();
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row); //extract the values in an array
        $post_item = array(
            'id'=> $id,
            'title'=> $title,
            'body'=> html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        //Push to "data"
        array_push($posts_arr['data'], $post_item);
    }

    //Turn to JSON & output
    echo json_encode($posts_arr);
}else{
    // No post
    echo json_encode(
        array("message"=>"No Posts Found")
    );
}
?>