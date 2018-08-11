
<!DOCTYPE html>
<meta charset="utf-8">

<html>
<head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

	<title></title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

	
<div>
  <h1>Entrance Demonstration</h1>
    <img id="bg" src="{{ url_for('video_feed') }}" width="500" height="400">
</div>

<div>
  <h1>Exit Demonstration</h1>
    <img id="bg" src="{{ url_for('exit_video_feed')}}" width="500" height="400">
</div>

</body>
</html>