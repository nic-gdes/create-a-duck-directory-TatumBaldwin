<!-- delete button -->
<?php

//connect to db - grabs info from db.php
require('./config/db.php');

//check if we have post data

if (isset($_POST['delete'])) {
    // get id
    $id_to_delete = (int)$_POST['id_to_delete'];

    //delete from database
    $delete_sql = "DELETE FROM ducks WHERE id='$id_to_delete'";

    //state weather the delete was successful or not
    if(mysqli_query($conn, $delete_sql)) {
        echo "Duck Deleted Successfully";
    } else {
        echo "Error deleting Duck: " . mysqli_error($conn);
    }
}

$sql = "SELECT * from ducks";
$result = mysqli_query($conn, $sql);


?>




<?php

$duck_is_live = false;

//Check if the $_GET id parameter is present
if (isset($_GET['id'])) {
    //assign a variable to id
    $id = htmlspecialchars($_GET['id']);

// get duck info from the database

    //create query to select the intended duck from the database
    $sql = "SELECT id, name, favorite_foods, bio, img_src FROM ducks WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    //grab the one duck from the directory
    $duck = mysqli_fetch_assoc($result);

    //close connection
    mysqli_free_result($result);
    mysqli_close($conn);
    
    //check if duck is empty = if it has content, mark duck_is_live as true
    if(isset($duck["id"])) {
        $duck_is_live = true;
        
    }

}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Link to head.php -->
        <?php include('./components/head.php'); ?>

    </head>

    <body>
        <!-- Link to nav.php -->
         <?php include('./components/nav.php'); ?> 

        <main>
            <?php if ($duck_is_live) : ?>
                <section class="duck-container2 profile">
                    <img src="<?php echo $duck["img_src"]; ?>" alt="" class="duckimg2">
                    <div>
                        <h2 class="duck-name"><?php echo $duck["name"] ?></h2>
                        <p><span class="bolded">Favorite Foods:</span><?php echo $duck["favorite_foods"] ?></p>
                        <p><?php echo $duck["bio"] ?></p>

                        <form action="./profile.php" method="POST">

                            <input type="hidden" name="id_to_delete" value="<?php echo $duck['id']; ?>">

                            <input type="submit" name="delete" value="Delete Duck">

                        </form>
                    </div>

                </section>
                <?php else : ?>
                    <section class="no-duck">
                        <h1>Sorry, this duck does not exist</h1>
                    </section>
                <?php endif ?>

        


        



            <!-- Link to footer.php -->
            <?php include('./components/footer.php'); ?>
        </main>
    </body>
</html>