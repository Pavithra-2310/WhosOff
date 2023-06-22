


<div class="container">
  
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">
      <h3>Principal's Section</h3>
    </div>
  </div>
  <?php if(isset($_GET['principal'])) : ?> 
    <div class="row">
      <div class="col-md-6 col-md-offset-3 col-lg-6 no-column-padding">
        <div class="form-group alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Sorry!</strong> Invalid Principal Username or Password.
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6">
      <form class="form-horizontal" id="principalForm" action="modules/principal_verify.php" method="post" data-toggle="validator">
        <div class="form-group">
          <label for="principalUsername" class="control-label">Username</label>
          <input type="text" class="form-control" id="principalUsername" name="name" maxlength="16" placeholder="Username" required>
        </div>
        <div class="form-group">
          <label for="principalPassword" class="control-label">Password</label>
          <input type="password" class="form-control" id="principalPassword" name="pass" maxlength="16" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign in">
        </div>
      </form>
    </div>
  </div>
  <hr class="col-md-offset-3 col-md-6" />
  
  <!-- Dean's Section -->
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
      <form class="form-horizontal" id="deanForm" action="modules/dean_verify.php" method="post" data-toggle="validator">
        <div class="form-group">
          <label for="deanUsername" class="control-label">Username</label>
          <input type="text" class="form-control" id="deanUsername" name="name" maxlength="16" placeholder="Username" required>
        </div>
        <div class="form-group">
          <label for="deanPassword" class="control-label">Password</label>
          <input type="password" class="form-control" id="deanPassword" name="pass" maxlength="16" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-info btn-block" value="Sign in">
        </div>
      </form>
    </div>
  </div>
  <hr class="col-md-offset-3 col-md-6" />
  
  <!-- HOD's Section -->
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">
      <h3>HOD's Section</h3>
    </div>
  </div>
  <?php if(isset($_GET['hod'])) : ?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3 col-lg-6 no-column-padding">
        <div class="form-group alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Sorry!</strong> Invalid HOD Username or Password.
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6">
      <form class="form-horizontal" id="hodForm" action="modules/verifyhod.php" method="post" data-toggle="validator">
        <div class="form-group">
          <label for="hodUsername" class="control-label">Username</label>
          <input type="text" class="form-control" id="hodUsername" name="name" maxlength="16" placeholder="Username" required>
        </div>
        <div class="form-group">
          <label for="hodPassword" class="control-label">Password</label>
          <input type="password" class="form-control" id="hodPassword" name="pass" maxlength="16" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-default btn-block" value="Sign in">
        </div>
      </form>
    </div>
  </div>
  <hr class="col-md-offset-3 col-md-6" />
  
  <!-- Staff Advisor's Section -->
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">
      <h3>Staff Advisor's Section</h3>
    </div>
  </div>
  <?php if(isset($_GET['staffadvisor'])) : ?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3 col-lg-6 no-column-padding">
        <div class="form-group alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Sorry!</strong> Invalid Staff Advisor Username or Password.
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6">
      <form class="form-horizontal" id="staffadvisorForm" action="modules/staffverify.php" method="post" data-toggle="validator">
        <div class="form-group">
          <label for="staffadvisorUsername" class="control-label">Username</label>
          <input type="text" class="form-control" id="staffadvisorUsername" name="name" maxlength="16" placeholder="Username" required>
        </div>
        <div class="form-group">
          <label for="staffadvisorPassword" class="control-label">Password</label>
          <input type="password" class="form-control" id="staffadvisorPassword" name="pass" maxlength="16" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-default btn-block" value="Sign in">
        </div>
      </form>
    </div>
  </div>
  <hr class="col-md-offset-3 col-md-6" />
  
  <!-- Faculty's Section -->

  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">
      <h3>Faculty's Section</h3>
     </div>
  </div>
  <div class="row">
    <?php if(isset($_GET['invalid'])) : ?>
      <div class="col-md-6 col-md-offset-3 col-lg-6 no-column-padding">
        <div class="form-group alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Sorry!</strong> Invalid Username Or Password.
        </div>
      </div>
    <?php endif; ?>

    <div class="col-md-6 col-md-offset-3 col-lg-6">
      <form class="form-horizontal" id="teacherForm" action="modules/verify.php" method="post" data-toggle="validator">
        <div class="form-group">
          <label for="inputEmail3" class="control-label">Username</label>
          <input type="text" class="form-control" id="inputEmail3" name="name" maxlength="16" placeholder="Username" required>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="control-label">Password</label>
          <input type="password" class="form-control" id="inputPassword3" name="pass" maxlength="16" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-info btn-block" value="Sign in">
        </div>
      </form>
    </div>
  </div>
  <hr class="col-md-offset-3 col-md-6" />
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">


  <!-- Student's Section -->


  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">
      <h3>Student's Section</h3>
    </div>
  </div>
  <?php if(isset($_GET['invalid'])) : ?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3 col-lg-6 no-column-padding">
        <div class="form-group alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Sorry!</strong> Invalid Student Reg No or Password.
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6">
      <form class="form-horizontal" action="modules/verifystud.php" method="post" id="studentForm" data-toggle="validator">
        <div class="form-group">
          <label for="RegNo" class="control-label">KTU Registation No.</label>
          <input type="text" class="form-control" id="RegNo"  name="RegNo" placeholder="Reg No." required>
        </div>
<div class="form-group">
          <label for="inputPassword3" class="control-label">Password</label>
          <input type="password" class="form-control" id="studPassword3" name="pass" maxlength="16" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-default btn-block" value="Sign in">
        </div>
      </form>
    </div>
  </div>
</div>
