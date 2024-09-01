<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Account Created!</title>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="./style.css ?<?php echo time(); ?>">
  <link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>

<body class="welcome-body">
  <div>
    <h1>Account Created! Welcome
      <?php
      echo $_SESSION['session_user'];
      ?>
      
    </h1>
  </div>
  <div>
    <h3>You are now entered into the email subscription. Thank you!</h3>
  </div>
</body>

</html>
<?php
session_destroy();
?>