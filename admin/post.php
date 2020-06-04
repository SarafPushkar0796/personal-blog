<?php

require('./top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type == 'status'){
		$operation = get_safe_value($con,$_GET['operation']);
		$id = get_safe_value($con,$_GET['id']);
		if($operation == 'active'){
			$status = '1';
		}else{
			$status = '0';
		}
		$update_status_sql = "update post set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type == 'delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from post where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql = "select post.*,topics.topics from post,topics where post.topics_id=topics.id order by post.id desc";
$res = mysqli_query($con,$sql);

?>

<div class="container mt-5">
	   <div class="row">
		  <div class="col-sm-12">
          <h3 class="mb-1">Add Post</h3>
            <a href="manage_post.php" class="btn btn-outline-primary float-right mb-3">Add post</a>
            <table class="table ">
                <thead>
                    <tr>
                        <th class="serial">#</th>
                        <th>ID</th>
                        <th>Topics</th>
                        <th>Post title</th>
                        <!-- <th>Image</th> -->                        
                        <th>Post date</th>
                        <th>Author</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                    ?>
                    <tr>
                        <td class="serial"><?php echo $i?></td>
                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['topics']?></td>
                        <td><?php echo $row['post_title']?></td>
                        <!-- <td><img src="<?php echo './post_imgs/'.$row['image']?>" style="width:25px;height:25px;"/></td> -->
                        <td><?php echo $row['post_date']?></td>
                        <td><?php echo $row['post_author']?></td>
                        <td>
                        <?php
                        if($row['status'] == 1){
                            echo "<span class='badge badge-success p-2'><a class='text-white' href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
                        }else{
                            echo "<span class='badge badge-warning p-2'><a class='text-white' href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
                        }
                        echo "<span class='badge badge-info p-2'><a class='text-white' href='manage_post.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
                        
                        echo "<span class='badge badge-danger p-2'><a class='text-white' href='?type=delete&id=".$row['id']."'>Delete</a></span>";
                        
                        ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
		  </div>
	   </div>
</div>

<?php require('./footer.inc.php'); ?>