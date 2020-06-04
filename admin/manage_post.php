<?php 

require('./top.inc.php'); 
date_default_timezone_set('UTC'); 

$topics = '';
$topics_id = '';
$post_title = '';
$post_body = '';
$post_date = '';
$post_author = '';
$image = '';
$image_required = 'required';
$msg = '';

if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required = '';
	$id = get_safe_value($con,$_GET['id']);
	$res = mysqli_query($con,"select * from post where id='$id'");
	$check = mysqli_num_rows($res);
	if($check > 0){
		$row = mysqli_fetch_assoc($res);
		$categories_id = $row['topics_id'];
		$post_title = $row['post_title'];
        $post_body = $row['post_body'];
        $post_date = $row['post_date'];
        $post_author = $row['post_author'];
	} else {
		header('location:post.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$topics_id = get_safe_value($con,$_POST['topics_id']);
	$post_title = get_safe_value($con,$_POST['post_title']);
    $post_body = get_safe_value($con,$_POST['post_body']);
    $post_date = get_safe_value($con,$_POST['post_date']);
    $post_author = get_safe_value($con,$_POST['post_author']);
	
	$res = mysqli_query($con,"select * from post where post_title='$post_title'");
	$check = mysqli_num_rows($res);
	if($check > 0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData = mysqli_fetch_assoc($res);
			if($id == $getData['id']){
			
			} else {
				$msg="Post already exists.";
			}
		} else {
			$msg="Post already exists.";
		}
	}
	
	if($_GET['id'] == 0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg = "Please select only png/jpg/jpeg image format.";
		}
	} else {
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg = "Please select only png/jpg/jpeg image format.";
			}
		}
	}
	
	if($msg == ''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],'./post_imgs/'.$image);				
				mysqli_query($con,"update post set topics_id='$topics_id',post_title='$post_title',post_body='$post_body',post_image='$image',post_date='$post_date',post_author='$post_author' where id='$id'")or die(mysqli_error($con));				
			} else {				
				mysqli_query($con,"update post set topics_id='$topics_id',post_title='$post_title',post_body='$post_body',post_image='$image',post_date='$post_date',post_author='$post_author' where id='$id'")or die(mysqli_error($con));				
			}			
			// mysqli_query($con,$update_sql);
		} else {
			$image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],'./post_imgs/'.$image);
            mysqli_query($con,"insert into post(topics_id,post_title,post_body,post_image,post_date,post_author,status) values('$topics_id','$post_title','$post_body','$image','$post_date','$post_author',1)");
		}
		header('location:post.php');
		die();
	}
}

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-3"></div>   
        <div class="col-lg-6">

            <!-- Because we are uploading image -->
            <form method="post" enctype="multipart/form-data">
                <h4 class="text-dark pb-2">Add Post</h4>

                <div class="form-group">
                    <select class="form-control" name="topics_id">
                        <option>Select Topics</option>
                        <?php
                            $res=mysqli_query($con,"select id,topics from topics order by topics asc");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['id'] == $topics_id){
                                    echo "<option selected value=".$row['id'].">".$row['topics']."</option>";
                                }else{
                                    echo "<option value=".$row['id'].">".$row['topics']."</option>";
                                }
                                
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" name="post_title" placeholder="Enter post title" class="form-control" required value="<?php echo $post_title?>">
                </div>

                <div class="form-group">
                    <textarea name="post_body" placeholder="Enter post body" class="form-control"><?php echo $post_body?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="categories" class=" form-control-label">Add post image</label>
                    <input type="file" name="image" class="form-control" <?php echo  $image_required?>>
                </div>

                <div class="form-group">
                    <input type="text" name="post_date" placeholder="Post date" class="form-control" required >
                </div>

                <div class="form-group">
                    <input type="text" name="post_author" placeholder="Author name" class="form-control" required value="<?php echo $post_author?>">
                </div>               

                <button type="submit" name="submit" class="btn btn-block btn-primary">Add</button>

            </form>
            <div class="mt-3 mb-3 text-danger">
                <?php echo $msg;?>
            </div>
        </div>   
        <div class="col-lg-3"></div>   
    </div>
</div>

<?php require('./footer.inc.php'); ?>