<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Link to head.php -->
        <?php include('./components/head.php'); ?>

    </head>

    <body>
        <!-- Link to nav.php -->
        <?php include('./components/nav.php'); ?>

        <div class="results">
                
                <!-- PHP FOR FORM COLLECTION -->
        
                <?php 
                
                    //check for POST
                    if(isset($_POST['submit'])) {
        
                        //Create an error array
                        $errors = array(
                            "name" => "",
                            "message" => "",
                            "food"=> "",
                        );
                    // check post data
                        $name = htmlspecialchars($_POST["name"]);
                        $food = htmlspecialchars($_POST["food"]);
                        $message = htmlspecialchars($_POST["message"]);
        
        
                        // check if name exists
                        if(empty($name)) {
        
                            //if it doesn't, name is required
                            $errors['name'] = "A name is required.";
        
                        } else {
                            // if it does, check against regex
                            if(!preg_match('/^[a-z\s]+$/i', $name)) {
                                $errors["name"] = "The name has illegal characters";
                            } 
                        }
        
                        //check if favorite food exists
                        if(empty($food)) {
        
                            //if it doesn't, name is required
                            $errors['food'] = "A Favorite Food is required.";
        
                        } else {
                            // if it does, check against regex
                            if(!preg_match('/^[a-z,\s]+$/i', $food)) {
                                $errors["food"] = "The Favorite Food must be seperated by a comma";
                            } 
                        }
        
                        //check if bio is empty
                        if(empty($bio)) {
                            // error if so
                            $errors["bio"] = "A Bio is required.";
        
                        }
        
                        if(!array_filter($errors)) {
                            // if everything is good
                            header("Location: ./index.php");
                        } else {
                            // if not, run error
        
                        }
                    }
        
                    // Print results onto the page
                    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // $name = htmlspecialchars($_POST['name']);
                        // $message = htmlspecialchars($_POST['message']);
                        // $file = htmlspecialchars($_POST['file']);
                        // $food = htmlspecialchars($_POST['food']);
        
                        // echo $name . ", " . $food . ", " . $file . ", " . $message;
                    // }
                
                
                ?>
                    </div>

        <!-- Duck layout -->

        <section class="duck-container3">
            <h2>Create a Duck</h2>
            <form action="./create-duck.php" method="POST">
                <div class="flex-col">
                    <label for="name">Name</label>
                    <?php 
                    if (isset($errors['name'])) { 
                        echo "<div class='error'>" . $errors["name"] . "</div>";
                        } 
                        
                        ?>
                    <input id="name" for="name" type="text" name="name" value="<?php if(isset($name)) { echo $name; } ?>" required placeholder="John Doe">
                </div>

                <div class="flex-col">
                    <label for="food">Favorite Food (ex. Pasta, Beans, Pork)</label>
                    <?php if (isset($errors['food'])) { 
                        echo "<div class='error'>" . $errors["food"] . "</div>";
                        } 
                        
                        ?>
                    <input type="text" name="food" for="food" placeholder="beans, pasta, grapes" required>
                </div>

                <div class="flex-col">
                    <label for="profile">Profile Image</label>
                    <div>
                     <input type="file" name="file">
                    </div>
                </div>

                <div class="flex-col">
                    <label for="biography">Duck Biography</label>
                    <?php if (isset($errors['message'])) { 
                        echo "<div class='error'>" . $errors["message"] . "</div>";
                        } 
                        
                        ?>
                    <textarea name="message" id="message" cols="30" rows="10" required placeholder="Talk about your duck...">
                    </textarea>
                </div>
                <button type="submit" name="submit" value="submit">Submit</button>
            </form>

        
            
        </section>


        <!-- Link to footer.php -->
        <?php include('./components/footer.php'); ?>

    </body>
</html>