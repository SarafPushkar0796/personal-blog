<?php

require('./page.top.inc.php');
$post_id = mysqli_real_escape_string($con, $_GET['id']);
$get_post = get_topic($con,'','',$post_id);

?>

<div class="container" style="margin-top: 20%;">
    <div class="card mt-4 shadow">
        <div class="card-body">
            <h5 class="card-title font-weight-bolder"><?php echo $get_post['0']['post_title'];?></h5>
            <p class="card-text mt-4"><?php echo $get_post['0']['post_body']?></p>
            <p><img src="<?php echo './admin/post_imgs/'.$get_post['0']['post_image']?>" class="mx-auto img-fluid mt-4" alt="Responsive image"></p>
            <p class="card-text mt-5" style="font-size: 12px;">Date: <?php echo $get_post['0']['post_date']?></p>
            <p class="card-text">
                <i class="material-icons share">share</i>
            </p>
            <p class="card-text font-weight-bold float-right">- <?php echo $get_post['0']['post_author']?></p>
        </div>
    </div>
</div>

<?php require('./footer.inc.php')?>