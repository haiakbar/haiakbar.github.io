

<div class="col-md-4">


                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <div class="well">
                    <?php 
                    if(isset($_SESSION['username'])){
                        echo "<h4>Logged in as {$_SESSION['username']}<h4>";
                        echo "<h5><a href='admin/logout.php'>Logout</a></h5>";
                    } else { ?>
                    <h4>User Login</h4>
                    <form action="login.php" method="post">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="sumbit" name="login">
                            Login</button>
                        </span>
                    </div>
                    </form>
                    <h5><a href="registration">Register</a><br><a href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password</a></h5>
                    <?php } ?>
                </div>
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php 
                                $query = "SELECT * FROM categories";
                                $select_all_categories = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($select_all_categories)){
                                    $cat_id = $row['cat_id'];
                                    $categories = $row['cat_name'];
                                    echo "<li><a href='categories.php?cat_id={$cat_id}'>{$categories}</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>