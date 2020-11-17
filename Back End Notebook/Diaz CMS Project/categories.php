<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->

<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
    <div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">

    <?php
    if(isset($_GET['cat_id'])){

        $post_by_cat = $_GET['cat_id'];
        if($_SESSION['user_role']=='admin'){
            $query = "SELECT * FROM posts WHERE post_category_id = '{$post_by_cat}' ";
        } else{
            $query = "SELECT * FROM posts WHERE post_category_id = '{$post_by_cat}' AND post_status = 'published' ";
        }
        
        $query .= "ORDER BY post_date DESC";
        $search_query = mysqli_query($connection, $query);

        if(!$search_query){
            die("Search query error" . mysqli_error($connection));
        }
        
        $count = mysqli_num_rows($search_query);

        if($count == 0){
            echo "<h1>NO RESULT!</h1>";
        } else {
            while($row = mysqli_fetch_assoc($search_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

                $author_query = "SELECT * FROM users WHERE user_id = '$post_author'";
                $select_author = mysqli_query($connection, $author_query);
                $raw = mysqli_fetch_assoc($select_author);
                $post_author = $raw['user_firstname'].' '.$raw['user_lastname'];
                ?>
                       

                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            
            <?php } } }?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php include "includes/footer.php"; ?>