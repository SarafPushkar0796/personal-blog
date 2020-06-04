<?php  

require('./top.inc.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

} else {
  header('location:index.php');
  die();
}

if(isset($_GET['type']) && $_GET['type']!=''){
	$type = get_safe_value($con,$_GET['type']);
	if($type == 'status'){
		$operation = get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation == 'active'){
			$status = '1';
		} else {
			$status = '0';
		}
		$update_status_sql = "update topics set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type == 'delete'){
		$id = get_safe_value($con,$_GET['id']);
		$delete_sql = "delete from topics where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select * from topics order by topics asc";
$res=mysqli_query($con,$sql);

?>

<div class="container mt-5 content">
        <div class="row">
            <div class="col-sm-12">
            <h3 class="mb-1">Topics</h3>
            <a href="manage_topics.php" class="btn btn-outline-primary float-right mb-3">Add topic</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col serial">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Topics</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php 
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){?>
                        <tr>
                          <td class="serial"><?php echo $i?></td>
                          <td><?php echo $row['id']?></td>
                          <td><?php echo $row['topics']?></td>
                          <td>
                          <?php
                            if($row['status'] == 1){
                                echo "<span class='badge badge-success p-2'><a class='text-white' href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
                            }else{
                                echo "<span class='badge badge-warning p-2'><a class='text-white' href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
                            }
                            echo "<span class='badge badge-info p-2'><a class='text-white' href='manage_topics.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
                            echo "<span class='badge badge-danger p-2 mt-3'><a class='text-white' href='?type=delete&id=".$row['id']."'>Delete</a></span>";
                          ?>
                          </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table> 
            </div>
        </div>
</div>

<?php  require('./footer.inc.php');?>