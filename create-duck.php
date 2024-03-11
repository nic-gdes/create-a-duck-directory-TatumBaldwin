<?php 
                
                
                //check for POST
                if(isset($_POST['submit'])) {

                    //Create an error array
                    $errors = array(
                        "name" => "",
                        "message" => "",
                        "food"=> "",
                        "img_src" => ""
                    );
                    // check post data
                    $name = htmlspecialchars($_POST["name"]);
                    $food = htmlspecialchars($_POST["food"]);
                    $message = htmlspecialchars($_POST["message"]);
                    $img_src = $_FILES["img_src"]["name"];
    
                    echo $name . $food . $message;
    
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
                    if(empty($message)) {
                        // error if so
                        $errors["message"] = "A Bio is required.";
    
                    }

                    //Handle fule upload target directory
                    $target_dir = "./assets/images/";

                    //Target uploaded image file
                    $image_file = $target_dir . basename($_FILES["img_src"]["name"]);

                    // Get uploaded file extension so we can test to make sure it is an image
                    $image_file_type = strtolower(pathinfo($image_file,PATHINFO_EXTENSION));

                    // Test image for errors
                        // images exist
                            if(empty($img_src)) {
                                // error if so
                                $errors["file"] = "An image is required";
                            } else {

                                // Check that image file is an actual image
                                $size_check = @getimagesize($_FILES["img_src"]["tmp_name"]);
                                $file_size = $_FILES["img_src"]["size"];
                                
                                if(!$size_check) {
                                    $errors["img_src"] = "File is not an image";
                                } else if ($file_size > 500000) {
                                    $errors["img_src"] = "Filesize cannot be larger than 500kb.";
                                } else if ($image_file_type != "jpg" 
                                && $image_file_type != "png"
                                 && $image_file_type != "jpeg" 
                                 && $image_file_type != "gif" 
                                 && $image_file_type != "webp") {
                                    $errors["img_src"] = "Sorry, only JPG, JPEG, PNG, GIF or WEBP files allowed";
                                } else if (move_uploaded_file($_FILES["img_src"]["tmp_name"], $image_file)) {
                                    //file uploaded successfully
                                } else {
                                    $errors["img_src"] = "Sorry, there was an error uploading your file";
                                }
                            }
    
                        if(!array_filter($errors)) {
                            // if everything is good and form is valid

                            //Connect to database
                            require('./config/db.php');

                            //build SQL query
                            $sql = "INSERT INTO ducks (name, favorite_foods, bio, img_src) VALUES ('$name', '$food', '$message', '$image_file')";

                            // echo $sql;
                            // //Execute query in SQL
                            mysqli_query($conn,$sql);
                            // //load hompage
                            echo "Query is successful. Added " . $name . " to database.";

                            // header("location:./index.php");
                        } else {
                            // if not, run error
                            print_r($errors);
        
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
        
              
        </div>

        <!-- Duck layout -->

        <section class="duck-container3">
            <h2>Create a Duck</h2>
            <form action="./profile.php" method="POST" enctype="multipart/form-data">
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
                    <input type="text" name="food" placeholder="beans, pasta, grapes" id="food" required>
                </div>

                <div class="flex-col">
                    <label for="duck_image" >Profile Image</label>
                    <?php if (isset($errors['img_src'])) { 
                        echo "<div class='error'>" . $errors["img_src"] . "</div>";
                        } 
                        
                        ?>
                    <div>
                     <input type="file" name="img_src" accept="image/*">
                    </div>
                </div>

                <div class="flex-col">
                    <label for="biography">Duck Biography</label>
                    <?php if (isset($errors['message'])) { 
                        echo "<div class='error'>" . $errors["message"] . "</div>";
                        } 
                        
                    ?>
                    <textarea name="message" id="message" cols="30" rows="10" required placeholder="Talk about your duck..."></textarea>
                </div>
                <button type="submit" name="submit" value="submit">Submit</button>
            </form>

        
            
        </section>


        <!-- Link to footer.php -->
        <?php include('./components/footer.php'); ?>

    </body>
</html>