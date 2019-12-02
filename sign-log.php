<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Camagru</title>
  

      <link rel="stylesheet" href="./assets/css/style.css">

  
</head>

<body>
<?php include('footer.php') ?>
        <?php if (isset($_SESSION['id'])) { ?>
        <img class="image" src="img/user.png" height="45px" width="45px" alt="user">
        <p class="user"><?php print_r(htmlspecialchars($_SESSION['username'])) ?></p>
            <?php header("Location: gallery/camera.php") ?>
        <?php } else { ?>

  <div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
    <div class="login-form">
      <form class="sign-in-htm" action="login/login.php" method="POST">
        <div class="group">
          <label for="user" class="label">Username</label>
          <input id="name" name="username" type="text" class="input">
        </div>
        <div class="group">
          <label for="passwd" class="label">Password</label>
          <input id="passwd" name="password" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <input id="check" type="checkbox" class="check" checked>
          <label for="check"><span class="icon"></span> Remember me</label>
        </div>
        <div class="group">
          <button type="submit" class="button" name="SignIn">sign-in</button>>
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <a href="#forgot">Forgot Password?</a>
        </div>
      </form>
      <form class="sign-up-htm" action="signup/register.php" method="POST">
        <div class="group">
          <label for="user" class="label">Username</label>
          <input id="name" name="name" type="text" class="input">
        </div>
        <div class="group">
          <label for="email" class="label">email</label>
          <input id="eamil" name="email" type="email" class="input" data-type="text">
        </div>
        <div class="group">
          <label for="passwd" class="label">Password</label>
          <input id="passwd" type="password" name="passwd" class="input" data-type="password">
        </div>
        <div class="group">
          <button type="submit" class="button" name="SignUp" >sign-up</button>
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <label for="tab-1">Already Member?</a>
        </div>
        <?php
				if ($_SESSION['error']) {
					echo $_SESSION['error'];
				}
              $_SESSION['error'] = null;
            ?>
      </form>
      <?php } ?>
    </div>
  </div>
</div>
  
  

</body>

</html>