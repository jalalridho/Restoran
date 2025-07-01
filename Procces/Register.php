<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Restaurant | Add User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
      *{font-family: verdana;}
      form{border-radius: 40px 40px; background-color: #F2F3F4; padding: 30px;}
    </style>
</head>
<body>
    <div class="container" style="padding: 50px 50px 50px 50px;">
      <div class="row">
        <h2>User Register</h2>
      </div>

      <form action="Register2.php" method="post">

      <fieldset>
        <div class="form-group">
          <label>Nama User :</label>
          <input class="form-control" type="text" name="nama" required>
        </div>
        <div class="form-group">
          <label>Username :</label>
          <input class="form-control" type="text" name="username" required>
        </div>
        <div class="form-group">
          <label>Password :</label>
          <input type="text" class="form-control" name="password" required>
        </div>
        <div class="form-group">
          <label>Level :</label>
          <select name="level" style="width: 100%">
            <option>admin</option>
            <option>waiter</option>
            <option>kasir</option>
            <option>owner</option>
          </select>
        </div>

        <input class="btn btn-primary btn-block" name="register" type="submit" value="ADD">

      </fieldset>
      </form>
    </div>
  </body>
</html>
