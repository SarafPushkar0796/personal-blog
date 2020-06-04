<?php require('./top.inc.php'); ?>

<div class="container mb-5" style="margin-top: 20%;">

    <div class="title">
        <h1><strong>Pushkar</strong></h1>
        <h1><strong>Explores.</strong></h1>
    </div>
    <p class="lead text-white mt-4">
        Hey, this is my personal blog where I explore and express on different topics.
    </p>
    
    <h1 class="title mt-5"><strong>Topics</strong></h1>
    <p class="">
        <?php foreach($top_arr as $list){ ?>
            <a href="./topics.php?id=<?php echo $list['id'];?>" class="mr-2 mt-3 badge badge-pill badge-light shadow" style="padding: 12px 22px;font-size: 13px;color:#375abb;"><?php echo $list['topics']?></a>
        <?php } ?>        
    </p>

    <h1 class="title mt-5"><strong>Recent Posts</strong></h1>

    <?php
        // 1 is the limit of items to show
        $get_topic=get_topic($con,1);
        foreach($get_topic as $list){
    ?>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title font-weight-bolder"><?php echo $list['post_title'];?></h5>
            <p class="card-text text-truncate"><?php echo $list['post_body'];?></p>
            <a href="./post.php?id=<?php echo $list['id'];?>" class="card-link">Read more</a>
        </div>
    </div>
    
    <?php }?>
        
</div>

<?php require('./footer.inc.php'); ?>