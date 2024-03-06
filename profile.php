<?php

$duck_is_live = false;

//Check if the $_GET id parameter is present
if (isset($_GET['id'])) {
    //assign a variable to id
    $id = htmlspecialchars($_GET['id']);

// get duck info from the database
    //connect to db - grabs info from db.php
    require('./config/db.php');

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



//Check if POST request for delete
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