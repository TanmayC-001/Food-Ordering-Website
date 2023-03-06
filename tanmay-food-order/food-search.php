
<!-- fOOD sEARCH Section Starts Here -->
    <div class="footer-img2">
        <?php include('partials-front/menu.php'); ?>

        <div class="container food-search2 text-center">
            <?php 

                //Get the Search Keyword
                // previous query was $search = $_POST['search'];
                // (SQL INJECTION)
                $search = mysqli_real_escape_string($conn, $_POST['search']);
                // we use mysqli_real_escape_string to convert search in string
            
            ?>


            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <h2 class ="text-white text-center">Matched Search :</h2>
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-submit">
                
            </form>

        </div>
    </div>



<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">You Searched For <a href="#" >"<?php echo $search; ?>"</a></h2>


        <?php 

            //SQL Query to Get foods based on search keyword

            //to provide security to website(SQL INJECTION)
            //when in search bar if we search for anything using quotes we get a error so it becommes easy for hackers to hack the database 
            //when we get value from search as $search = burger '; DROP database name;  sql dont understand end with ' here
            //so we willprovide whole search as a string // we use mysqli_real_escape_string to convert search in string
            // "SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger%'";
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Check whether food available of not
            if($count>0)
            {
                //Food Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                // Check whether image name is available or not
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php 

                                }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">₹<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href=" <?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-order">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //Food Not Available
                echo "<div class='error'>$search Not Available. Please Try Other Food</div>";
            }
        
        ?>

        

        <div class="clearfix"></div>

        

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>