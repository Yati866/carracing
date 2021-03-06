<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
      <link href="https://fonts.googleapis.com/css2?family=Anton&family=Fredoka+One&family=Henny+Penny&display=swap" rel="stylesheet">
	<style type="text/css">
		body{
			background-image: url('gg.jpg');
			background-size: cover;
		}
		.container{
			background-image: url('car.jpg');
		}
            h1{
                  font-weight: bolder;
                  font-family: 'Fredoka One', cursive;
                  color: black;
            }
            h2{
                  font-weight: bold;
                  font-family: 'Fredoka One', cursive;
                  color: black;
            }
            label{
                  font-family:  'Fredoka One', cursive;
                  color: DodgerBlue;
            }

	</style>
</head>
<body>
      <div class="container">
      	<h1 class="text-center"> CAR RUSH </h1>
      	<div class="container-1">
      		<div class="row">
      			<div class="col-lg-6">
      				<h2> Login </h2>
      				<form action="validation.php" method="post">
      					<div class="form-group">
      						<label>USERNAME</label>
      						<input type="text" name="user" class="form-control">
      					</div>
      					<div class="form-group">
      						<label>PASSWORD</label>
      						<input type="Password" name="password" class="form-control">
      					</div>
      					<button type="submit" class="btn btn-danger">Login</button>
      				</form>
      			</div>
      			<div class="col-lg-6">
      				<h2> Signin </h2>
      				<form action="registration.php" method="post">
      					<div class="form-group">
      						<label>USERNAME</label>
      						<input type="text" name="user" class="form-control">
      					</div>
      					<div class="form-group">
      						<label>PASSWORD</label>
      						<input type="Password" name="password" class="form-control">
      					</div>
      					<button type="submit" class="btn btn-danger">Signin</button>
      				</form>
      			</div>
      		</div>
      	</div>
      </div>
</body>
</html>
