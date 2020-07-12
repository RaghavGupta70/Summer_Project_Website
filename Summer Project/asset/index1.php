<?php  

include('assets/db_connect.php');

//write query for all pizzas
$sql = 'SELECT title, id FROM forum_topics ORDER BY id';

//make query and get result
$result = mysqli_query($conn,$sql);

//fetch the resulting rows as arrray
$topics= mysqli_fetch_all($result , MYSQLI_ASSOC);


mysqli_free_result($result);

mysqli_close($conn);


//print_r($pizzas);

//print_r (explode(',', $pizzas[0]['ingredients']));


















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
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?id=<?php echo $topic['id']?>">MORE INFO
							</a>
						</div>
					</div>
				</div>


				
			<?php endforeach ?>
		</div>
	</div>



<?php include 'footer.php' ?>
</html>