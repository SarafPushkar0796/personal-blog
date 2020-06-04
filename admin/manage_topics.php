<?php 

require('./top.inc.php'); 
date_default_timezone_set('UTC'); 
$topics='';
$msg = '';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id = get_safe_value($con,$_GET['id']);
	$res = mysqli_query($con,"select * from topics where id='$id'");
	$check = mysqli_num_rows($res);
	if($check>0){
		$row = mysqli_fetch_assoc($res);
		$categories = $row['topics'];
	}else{
		header('location:topics.php');
		die();
	}
}

if(isset($_POST['submit'])){
    if($_POST['topics'] == ''){
        $msg = 'Topic cannot be empty!';
    } else {
        $topics=get_safe_value($con,$_POST['topics']);
        $res=mysqli_query($con,"select * from topics where topics='$topics'");
        $check=mysqli_num_rows($res);
        if($check > 0){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $getData = mysqli_fetch_assoc($res);
                if($id == $getData['id']){
                
                } else {
                    $msg = "Topic exists !";
                }
            } else {
                $msg = "Topic exists !";
            }
        }
    }
	
	if($msg == ''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update topics set topics='$topics' where id='$id'");
		} else {
			mysqli_query($con,"insert into topics(topics,status) values('$topics','1')");
		}
		header('location:topics.php');
		die();
	}
}

?>

<div class="container mt-5">
    <div class="row">
         
        <div class="col-lg-4 col-sm-12 mx-auto">
            <form method="post">
                <fieldset>
                    <h4 class="text-dark pb-2">Add Topic</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="topics" placeholder="Topic name" value="<?php echo $topics; ?>" required>
                    </div>
                    <button type="submit" name=submit class="btn btn-block btn-primary shadow">Add</button>
                </fieldset>
            </form>
            <div class="mt-3 mb-3 text-danger">
                <?php echo $msg;?>
            </div>
        </div>   
         
    </div>
</div>

<?php require('./footer.inc.php'); ?>