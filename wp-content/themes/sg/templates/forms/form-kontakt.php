<?php echo $ok; ?>
<?php echo $fehler; ?>

<h2>Schreib uns eine Nachricht.</h2>

<form action="<?php the_permalink(); ?>" method="post" id="form">

	<div class="field">
		<label for="name">Name: <span class="required">*</span></label>
		<input class="valid" type="text" name="name" id="name" value="<?php if(!empty($username)){echo $username;}?>" />
	</div>
		
	<div class="field">
		<label for="email">Email: <span class="required">*</span></label>
		<input class="valid" type="text" name="email" value="<?php if(!empty($useremail)){echo $useremail;}?>" />
	</div>
		
	<div class="field">
		<label for="betreff">Betreff: <span class="required">*</span></label>
		<input class="valid" type="text" name="betreff" value="<?php if(!empty($userbetreff)){echo $userbetreff;}?>" />
	</div>
		
	<div class="field">
		<label for="nachricht">Nachricht: <span class="required">*</span></label>
		<textarea class="valid" cols="50" rows="10" name="nachricht"><?php if(!empty($usernachricht)){echo $usernachricht;}?></textarea>
	</div>
	
	<p class="required">* Pflichtfelder</p>
	
	<div id="capcha">
		<?php require_once('lib/s3Capcha.php'); ?>
	</div>

	<?php 
	$token = 'mFzYr6BvD5';
	$_SESSION['token'] = $token;	
 ?>
 
  <div class="field">
		<input class="button" name="submitted" id="submit" value="Anfrage absenden" type="submit"/>	
	</div>	
	
</form>