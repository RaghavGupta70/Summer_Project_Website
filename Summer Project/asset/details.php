<?php 

	
	include('assets/db_connect.php');
	$email_to_delete='';
	$errors = array("email"=>'');

		if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);
		$email_to_delete = mysqli_real_escape_string($conn,$_POST['email_to_delete']);


		$sql1 ="SELECT * FROM forum_topics where id = $id_to_delete";
		$result1 = mysqli_query($conn,$sql1);

		$topic1  = mysqli_fetch_assoc($result1);

		if($topic1['email'] == $email_to_delete)
		{

			$sql2="DELETE FROM forum_topics WHERE id = $id_to_delete";
			if (mysqli_query($conn,$sql2)) {
				//sucesss
				header('Location:index1.php');
			}
		}	
		else
		{
			header("Location:details.php?id=$id_to_delete");
		}

		
}


	//check get request id param
	if(isset($_GET['id'])){

	$id = mysqli_real_escape_string($conn,$_GET['id']);

	//make sql
	$sql = "SELECT * FROM forum_topics where id = $id";

	//get query result
	$result = mysqli_query($conn,$sql);

	//fetch result in array format
	$topic = mysqli_fetch_assoc($result);

	mysqli_free_result($result);
	mysqli_close($conn);
	}

	


 ?>
 <!DOCTYPE html>
 <html>
 	<?php include("header.php"); ?>

 	<div class="container center grey-text">
 		<?php if($topic): ?>

 			<h4><?php echo htmlspecialchars($topic['title']); ?></h4>
 			<h5>Content:</h5>
 			<p> <?php echo htmlspecialchars($topic['content']);  ?></p>
 			<p>Created by: <?php echo htmlspecialchars($topic['user_name']);  ?>
 			<p><?php echo date($topic['created_at']); ?></p>
 			


 			<!--Delete Form-->
 			<section class="container grey-text">
 			<form action="details.php" method="POST">
 				<input type="hidden" name="id_to_delete" value="<?php echo $topic['id']; ?>" >
 				<label>  Email(For deleting the above blog) :</label>
				<input type="text" name="email_to_delete"  placeholder="Proper email-address" value="<?php echo htmlspecialchars($email_to_delete); ?>">
				
 				<input type="submit" name="delete" value="delete" class="btn brand z-depth-0">
 			</form>
 		</section>
 		<?php else: ?>
 			<h5>No such blog exist</h5>
 		<?php endif; ?>	
 	</div>

 	<?php include 'footer.php'; ?>
 </html>