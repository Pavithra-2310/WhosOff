<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .row {
      margin: 20px;
    }

    .col-md-6 {
      width: 50%;
    }

    .text-center {
      text-align: center;
    }

    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
    }

    .alert-danger {
      color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
    }

    .form-horizontal .form-group {
      margin-bottom: 15px;
    }

    .control-label {
      display: inline-block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #555555;
    }

    .form-control {
      display: block;
      width: 100%;
      height: 34px;
      padding: 6px 12px;
      font-size: 14px;
      line-height: 1.42857143;
      color: #555555;
      background-color: #ffffff;
      background-image: none;
      border: 1px solid #cccccc;
      border-radius: 4px;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
      border-color: #337ab7;
      outline: 0;
      box-shadow: 0 0 0 2px rgba(51, 122, 183, 0.25);
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      margin-bottom: 10px;
      font-size: 16px;
      font-weight: bold;
      line-height: 1.42857143;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      cursor: pointer;
      border: none;
      border-radius: 4px;
      transition: all 0.3s ease;
    }

    .btn-primary {
      color: #ffffff;
      background-color: #337ab7;
    }

    .btn-primary:hover {
      background-color: #286090;
    }

    .btn-block {
      display: block;
      width: 100%;
    }

    .col-md-offset-3 {
      margin-left: 25%;
    }

    hr {
      border: none;
      border-top: 1px solid #cccccc;
      margin-top: 30px;
      margin-bottom: 30px;
    }
  </style>
</head>
<body>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">
      <h3>Dean's Section</h3>
    </div>
  </div>
  <?php if(isset($_GET['dean'])) : ?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3 col-lg-6 no-column-padding">
        <div class="form-group alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Sorry!</strong> Invalid Dean Username or Password.
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6">
      <form class="form-horizontal" id="deanForm" action="dean_verify.php" method="post" data-toggle="validator">
        <div class="form-group">
          <label for="deanUsername" class="control-label">Username</label>
          <input type="text" class="form-control" id="deanUsername" name="name" maxlength="16" placeholder="Username" required>
        </div>
        <div class="form-group">
          <label for="deanPassword" class="control-label">Password</label>
          <input type="password" class="form-control" id="deanPassword" name="pass" maxlength="16" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign in">
        </div>
      </form>
    </div>
  </div>
  <hr class="col-md-offset-3 col-md-6" />
</body>
</html>
