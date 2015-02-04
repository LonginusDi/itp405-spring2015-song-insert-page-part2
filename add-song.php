<?php

	require __DIR__ . '/vendor/autoload.php';

	use \Itp\Music\ArtistQuery;
	$aQuery = new ArtistQuery();
	$artists = $aQuery->getAll();
	
	use \Itp\Music\GenreQuery;
	$gQuery = new GenreQuery();
	$genres = $gQuery->getAll();
	
	use \Symfony\Component\HttpFoundation\Session\Session;
	$session = new Session();
	$session->start();

	use \Itp\Music\Song;
	$song = new Song();
	if(isset($_GET['submit'])){
		$title = $_GET['title'];
		$artist_id = $_GET['artist'];
		$genre_id = $_GET['genre'];
		$price = $_GET['price'];

		$song->setTitle($title);
		$song->setArtistId($artist_id);
		$song->setGenreId($genre_id);
		$song->setPrice($price);
		$song->save();
		
		$session->getFlashBag()->add('insert-success', 'The song ' . $song->getTitle(). ' with an ID of ' . $song->getId() . ' was inserted successfully!');

		header('Location: add-song.php');
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Song Insert Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action = "add-song.php" method="get" >
		<header>
    		<h2>Song Insert Page</h2>
  		</header>

		<div>Title: &nbsp;&nbsp;&nbsp;<input type="text" name = "title"></div>
		<div>Artist: &nbsp;
		<select name="artist">
			<?php foreach($artists as $artist) : ?>
				<option value= "<?php echo $artist->id ?>">
					<?php echo $artist->artist_name ?>
				</option>
			<?php endforeach ?>
		</select></div>
		<div>Genre: &nbsp;
		<select name="genre">
			<?php foreach($genres as $genre) : ?>
				<option value= "<?php echo $genre->id ?>">
					<?php echo $genre->genre ?>
				</option>
			<?php endforeach ?>
		</select></div>
		<div>Price: &nbsp;&nbsp; <input type="text" name = "price"></div>
		<div><input type="submit" value="Search" name="submit"></div>

		<?php foreach ($session->getFlashBag()->get('insert-success') as $message) : ?>
			<p><?php echo $message ?></p>
		<?php endforeach; ?>

	</form>

</body>
</html>

