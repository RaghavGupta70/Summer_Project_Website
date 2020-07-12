<?php  

		include 'assets/db_connect.php';

	$email = $title = $content = $user_name= "";
		$errors = array("email"=>"","title"=>"","content"=>"" ,"user_name"=>"");
	if(isset($_POST["submit"]))
	{
		if(empty($_POST["user_name"]))
		{
			$errors["user_name"] = "A User name is required <br />";
		}
		else
		{
			$user_name=$_POST["user_name"];
		}
		
		if(empty($_POST["email"]))
		{
			$errors["email"] = "An email is required <br />";
		}
		else
		{
			$email=$_POST["email"];
			if (!filter_var($email,FILTER_VALIDATE_EMAIL))
			 {
				$errors["email"] = "Email must be a valid email address";
			}
		}

		if(empty($_POST["title"]))
		{
			$errors["title"] = "An title is required <br />";
		}
		else
		{
			$title = $_POST["title"];
		}
		if(empty($_POST["content"]))
		{
			$errors["content"]= "Content is required <br />";
		}else
		{
			$content = $_POST["content"];
		}
		if(array_filter($errors)){
		//echo "Errors in the form";
		}else{
		//echo "Form is valid";
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$title = mysqli_real_escape_string($conn,$_POST['title']);
		$content = mysqli_real_escape_string($conn,$_POST['content']);
		$user_name = mysqli_real_escape_string($conn,$_POST['user_name']);

		//create sql
		$sql ="INSERT INTO forum_topics(title,email,content,user_name) VALUES('$title','$email','$content','$user_name')";

		//save to db and check
		if (mysqli_query($conn,$sql)) {
			header("Location: index1.php");		
		}else{
			echo 'query error' .mysqli_error($conn);
		}
		
	}
	}
	
	



?>
<!DOCTYPE html>
<html>

<?php include './header.php'; ?>
<section class="container grey-text">
	<h4 class="center">Add a new blog</h4>
	<form class="white" action="add.php" method="POST">
		<label>Your User Name:</label>
		<input type="text" name="user_name" value ="<?php echo htmlspecialchars($user_name) ?>">
		<div class="red-text"><?php echo $errors["user_name"]; ?></div>
		<label>Your Email:</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
		<div class="red-text"><?php echo $errors["email"]; ?></div>
		<label>Blog Title:</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
		<div class="red-text"><?php echo $errors["title"]; ?></div>
		<label>Content:</label>
		<input type="text" name="content" value="<?php echo htmlspecialchars($content); ?>">
		<div class="red-text"><?php echo $errors["content"]; ?></div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn">
		</div>
	</form>
</section>
<?php include "./footer.php"; ?>
</html>