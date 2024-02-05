

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Link to head.php -->
        <?php include('./components/head.php'); ?>

    </head>

    <body>
        <!-- Link to nav.php -->
        <?php include('./components/nav.php'); ?>


        <!--  PHP CODE -->

        <section class="white-result">

            <?php


                // include database connection

                include('./config/db.php');

                // create SQL Query
                $sql = "SELECT name,favorite_foods,img_src FROM ducks";

                // Query the DB and add the result to a php array

                $result = mysqli_query($conn, $sql);
                $ducks = mysqli_fetch_all( $result, MYSQLI_ASSOC );


                // free result from memory and close SQL connectin

                mysqli_free_result($result);
                mysqli_close($conn);

            ?>
        </section>
        <!-- Welcome Section -->

        <section>
            <h1>Welcome to Your Ducks</h1>
            <p class="welcome"> Design your own ducks using our personalized form. Go to profile to start your ducktastic journey!</p>
        </section>

        <!-- Duck layout -->
        <section class="duck-container1">


             <!-- duck 1 -->
                <?php foreach($ducks as $duck) : ?>
                <div class="ducks">

                    <img class="duckimg1" src="<?php echo $duck["img_src"]; ?>" alt="Duck 1">

                    <h2><?php echo $duck["name"]; ?></h2>

                    <h4>Favorite Foods</h4>
                    <?php 
                    $food_list = explode(", ", $duck["favorite_foods"]);
                     ?>

                    <ol class="foods">
                
                    <!-- break ducks foods into three seperate items -->

                    <?php foreach($food_list as $food) :?>
                        <li><?php echo $food ?></li>
                        <?php  endforeach ?>
                    </ol>
                </div>

                <?php endforeach ?>
                
        </section>

        <!-- Link to footer.php -->
        <?php include('./components/footer.php'); ?>

    </body>
</html>