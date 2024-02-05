<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Link to head.php -->
        <?php include('./components/head.php'); ?>

    </head>

    <body>
        <!-- Link to nav.php -->
        <?php include('./components/nav.php'); ?>


        <!-- Duck layout -->

        <section class="duck-container3">
            <h2>Create a Duck</h2>
            <form action="create-duck.php" method="POST">
                <div class="flex-col">
                    <label for="name">Name</label>
                    <input id="name" for="name" type="text" name="name">
                </div>

                <div class="flex-col">
                    <label for="food">Favorite Food (ex. Pasta, Beans, Pork)</label>
                    <input type="text" name="food" for="food">
                </div>

                <div class="flex-col">
                    <label for="profile">Profile Image</label>
                    <div>
                     <input type="file" name="file">
                    </div>
                </div>

                <div class="flex-col">
                    <label for="biography">Duck Biography</label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" name="submit" value="submit">Submit</button>
            </form>

            <div class="results">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $name = htmlspecialchars($_POST['name']);
                        $message = htmlspecialchars($_POST['message']);
                        $file = htmlspecialchars($_POST['file']);
                        $food = htmlspecialchars($_POST['food']);

                        echo $name . ", " . $food . ", " . $file . ", " . $message;
                    }

                ?>
            </div>
            
        </section>


        <!-- Link to footer.php -->
        <?php include('./components/footer.php'); ?>

    </body>
</html>