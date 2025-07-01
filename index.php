<!DOCTYPE html>
<html>
<head>
	<title>Restoran | Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    *{font-family: verdana;}
    .btn{background-color: #28B463; color: #ffff;}
  </style>
</head>
<body>
  <div class="jumbotron text-left"style="background-color:#239B56; padding: 2px; color: #F7F9F9;"><h4 style="padding-left: 20px;">Restaurant Website!</h4></div>
  <div class="container-fluid" style="padding:100px;">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-6"><img src="Digital.png" class="img-responsive margin" style="width:100%; height: auto;" alt="Image"></div>
      <div class="col-sm-4">
        <form action="Procces/Login.php" method="post">
          <fieldset>
            <legend align="center">LOGIN</legend>
            <div class="form-group">
              <label>Username :</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Password :</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
              <input type="submit" name="login" class="btn btn-block" value="Login">
            </div>
            <div>
              <div><label>Create Account? <a href="Procces/Register.php">Click Here</a></label></div>
            </div>
          </fieldset>
        </form>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div>
</body>
</html>
