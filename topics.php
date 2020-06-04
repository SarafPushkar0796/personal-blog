<?php 

require('./page.top.inc.php'); 

if(isset($_GET['id']) && $_GET['id']!=''){
	$cat_id = mysqli_real_escape_string($con,$_GET['id']);
	if($cat_id > 0){
        // echo $cat_id;
        $get_topic = get_topic($con,'',$cat_id);
        $topic_sql = mysqli_query($con,"SELECT topics FROM topics WHERE id='$cat_id'") or die(mysqli_error($con));
        $topic = mysqli_fetch_row($topic_sql);        
	} else {
		?>
		    <script>window.location.href='index.php';</script>
		<?php
	}
} else {
	?>
	    <script>window.location.href='index.php';</script>
	<?php
}

?>


<div class="container mb-5" style="margin-top: 20%;">
    <div class="title">
        <h1 class="text-uppercase"><strong><?php echo $topic[0];?></strong></h1>
        
        <?php
            if(count($get_topic)>0){
            foreach($get_topic as $list){
        ?>
        <div class="card mt-4 shadow">
            <div class="card-body">
                <h5 class="card-title font-weight-bolder"><?php echo $list['post_title'];?></h5>
                <p class="card-text text-truncate"><?php echo $list['post_body'];?></p>
                <a href="./post.php?id=<?php echo $list['id'];?>" class="card-link">Read more</a>
                <p class="card-text font-weight-bold float-right">- <?php echo $list['post_author'];?></p>
            </div>
        </div>
        <?php }}else {?>
        <div class="mt-5 alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>No data!</strong>
        </div>
        <?php } ?>
    </div>
</div>

<?php require('./footer.inc.php'); ?>