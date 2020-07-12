<?php  

include('assets/db_connect.php');

	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

		$sql="DELETE FROM forum_topics WHERE id = $id_to_delete";

		if (mysqli_query($conn,$sql)) {
			//sucesss
			header('Location:deleete_a_blog.php');
		}{
			echo 'query error: ' .mysqli_error($conn);
		}

	}





//write query for all blogs
$sql = 'SELECT title, id FROM forum_topics ORDER BY id';

//make query and get result
$result = mysqli_query($conn,$sql);

//fetch the resulting rows as arrray
$topics= mysqli_fetch_all($result , MYSQLI_ASSOC);


mysqli_free_result($result);

mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<?php include("header.php"); ?>


	<div class="container">
		<a href="add.php"class="btn" style="float: right;margin-right: 0;margin-top: 0;">Add a Blog</a>
		<h4 class="center grey-text"> Blogs</h4>
		
		<div class="row">
			
			<?php foreach($topics as $topic) : ?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
						<img src="assets/logo.png" class="pizza">
						
						<div class="card-content center">
							
							<h6><?php echo htmlspecialchars($topic['title']); ?></h6>
							
						</div>
						<div class="card-action ">
							<div class="right-align">
								<a class="brand-text" href="details.php?id=<?php echo $topic['id']?>">MORE INFO</a>
							</div>
						</div>		
								
 						<!--Delete Form-->
 								<form action="delete_a_blog.php" method="POST" class="pizza1" >
 									<input type="hidden" name="id_to_delete" value="<?php echo $topic['id']; ?>" >
 									<input type="submit" name="delete" value="delete" class="btn z-depth-0">
 								</form>	
						
					</div>
				</div>


				
			<?php endforeach ?>
		</div>
	</div>



<?php include 'footer.php' ?>
</html>