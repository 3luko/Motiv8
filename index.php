<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Motiv8</title>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="./style.css ?<?php echo time(); ?>" />
  <link rel="icon" href="./favicon.ico" type="image/x-icon" />
  <link rel="icon" href="./favicon.ico" type="image/x-icon" />
</head>

<body>
  <main>
    <div class="loginBox">
      <h3>Sign in to Motiv8</h3>
      <!-- FORM DATA********************************************************** -->
      <!--EMAIL-->
      <form name="login-form" method="post" action="login.php">
        <div class="email-box">
          <label for="login-email">
            <h6>Email:</h6>
          </label>
          <input autocomplete="off" class="input-box" type="text" name="login-email" value="" />
        </div>
        <!--USERNAME-->
        <div class="username-box">
          <label for="login-username">
            <h6>Username:</h6>
          </label>
          <input autocomplete="off" class="input-box" type="text" name="login-username" value="" id="login-user"/>
        </div>
        <!-- PASSWORD -->
        <div class="pwd-box">
          <label for="login-pwd">
            <h6>Password:</h6>
          </label>
          <input class="input-box" type="password" name="login-pwd" value="" />
        </div>
        <!--SUBMIT BUTTON -->
        <div class="submit-button-box">
          <input
            type="submit"
            name="submit-button"
            value="Sign in"
            class="btn btn-success btn-block signin-btn" />
        </div>
      </form>
    </div>
  </main>
  <script src="index.js"></script>
</body>

</html>