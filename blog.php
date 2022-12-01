<?php
// define("ENABLED_PAGE", true);
$pwedeMabisita = true;
$blog = true; //trigger para sa highlight sa button
include 'header.php';
if(!isset($_SESSION['logged_in'])){
    header("location: login.php");
}

//sending data to database
if (isset($_POST['post'])) {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['p_title'];
    $content = $_POST['p_content'];

    //inserting to table blog
    $insert = $conn->prepare("INSERT INTO blog (blog_title, blog_content, user_id) VALUE (?, ?, ?)");
    //binding
    $insert->execute([
        $title,
        $content,
        $user_id
    ]);
    //array(), []

    $msg = "Post Created!";

    // echo '
    // <script>
    //     alert("Post Created!");
    // </script>
    // ';

}

//if update button is clicked
if (isset($_POST['update'])) {
    $id = $_POST['p_id'];
    $title = $_POST['p_title'];
    $content = $_POST['p_content'];

    //query
    $update = $conn->prepare("UPDATE blog set blog_title = ?, blog_content = ? WHERE blog_id = ?");
    //binding
    $update->execute([
        $title,
        $content,
        $id
    ]);

    $msg = "Post Updated!";
}

//delete data to database
if (isset($_GET['delete'])) {
    $id = $_GET['p_id'];

    $delete = $conn->prepare("DELETE FROM blog WHERE blog_id = ?");
    //bind data
    $delete->execute([$id]);

    $warning_msg = "Post deleted!";
}


?>

<div class="container">
    <div class="row mt-4">
        <div class="col-4">
            <div class="shadow p-4 fixed">
                <?php
                if (isset($_GET['update'])) { ?>
                    <form method="POST" action="blog.php">
                        <?php
                        $p_id = $_GET['p_id'];
                        $rows = $conn->prepare("SELECT * FROM blog WHERE blog_id = ?");
                        $rows->execute(array($p_id));
                        foreach ($rows as $row) { ?>

                            <input type="hidden" name="p_id" value="<?= $row['blog_id'] ?>">
                            <div class="mb-3">
                                <label for="title" class="form-label">Edit Your Title</label>
                                <input type="text" value="<?= $row['blog_title'] ?>" name="p_title" class="form-control" id="title" placeholder="Your title here . . .">
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Edit Your Content</label>
                                <textarea name="p_content" class="form-control" id="content" placeholder="Your content here . . ."><?= $row['blog_content'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <a href="blog.php"><button class="btn btn-secondary">Cancel</button></a>
                                <button class="btn btn-success" name="update">Update Post</button>
                            </div>
                        <?php  } ?>
                    </form>
                <?php  } else { ?>
                    <div class="mb-3 mt-4">
                            <?php
                            if (isset($msg)) {
                                echo '
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>' . $msg . '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                            ';
                            } elseif (isset($warning_msg)) {
                                echo '
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>' . $warning_msg . '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                            ';
                            }
                            ?>
                        </div>
                    <form method="POST" action="blog.php">                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Your Title</label>
                            <input type="text" name="p_title" class="form-control" id="title" placeholder="Your title here . . ." required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Your Content</label>
                            <textarea name="p_content" class="form-control" id="content" placeholder="Your content here . . ." required></textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" name="post">Create Post</button>
                        </div>
                    </form>
                <?php  } ?>
            </div>
        </div>
        <div class="col-7 ms-4">
            <div class="table-responsive mb-4 shadow p-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    $count = 1;
                    $user_id = $_SESSION['user_id'];
                    $get_data = $conn->prepare("SELECT * FROM blog WHERE user_id = ?");
                    $get_data->execute([
                        $user_id
                    ]);
                    foreach ($get_data as $value) { ?>

                        <!-- //     echo '
                //     <tbody>
                //     <tr>
                //         <th>'. $count++ .'</th>
                //         <td>'. $value['blog_title'] .'</td>
                //         <td>'. $value['blog_content'] .'</td>
                //     </tr>
                // </tbody>
                //     ';                 -->

                        <tbody>
                            <!-- <tr> -->
                                <th><?= $count++ ?></th>
                                <td><?= $value['blog_title'] ?></td>
                                <td><?= $value['blog_content'] ?></td>
                                <td class="mx-auto">
                                    <a href="blog.php?update&p_id=<?= $value['blog_id'] ?>" class="text-decoration-none">✏</a> <a href="blog.php?delete&p_id=<?= $value['blog_id'] ?>" class="text-decoration-none">❌</a>
                                </td>
                            <!-- </tr> -->
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.title = "Blogs";
</script>
</body>

</html>