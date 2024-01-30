<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Link to head.php -->
        <?php include('./assets/components/head.php'); ?>

    </head>

    <body>
        <!-- Link to nav.php -->
        <?php include('./assets/components/nav.php'); ?>


        <!-- Duck layout -->

        <section class="duck-container3">
            <h2>Create a Duck</h2>
            <form action="">
                <div class="flex-col">
                    <label for="name">Name</label>
                    <input type="text" name="name">
                </div>

                <div class="flex-col">
                    <label for="food">Favorite Food (ex. Pasta, Beans, Pork)</label>
                    <input type="text" name="food">
                </div>

                <div class="flex-col">
                    <label for="profile">Profile Image</label>
                    <div>
                     <input type="file" name="file">
                    </div>
                </div>

                <div class="flex-col">
                    <label for="biography">Duck Biography</label>
                    <input type="message" name="biography">
                </div>
                <button type="submit" name="submit" value="submit">
                    Submit
                </button>
            </form>
        </section>


        <!-- Link to footer.php -->
        <?php include('./assets/components/footer.php'); ?>

    </body>
</html>