<?php 
function get_topic($con,$limit='',$cat_id='',$post_id='',$search_str=''){
	$sql = "select post.*,topics.topics from post,topics where post.status=1 ";
	if($cat_id!=''){
		$sql.=" and post.topics_id=$cat_id ";
	}
	if($post_id!=''){
		$sql.=" and post.id=$post_id ";
	}
	$sql.=" and post.topics_id=topics.id ";
	if($search_str!=''){
		$sql.=" and (post.post_title like '%$search_str%' or post.post_body like '%$search_str%') ";
	}
	$sql.=" order by post.id desc";
	if($limit!=''){
		$sql.=" limit $limit";
	}
	
	$res = mysqli_query($con,$sql);
	$data = array();
	while($row = mysqli_fetch_assoc($res)){
		$data[] = $row;
	}
	return $data;
}
?>
