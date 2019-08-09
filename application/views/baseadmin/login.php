<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin login</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/home/images/favicon.ico">

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/dash/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/dash/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/dash/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>assets/dash/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/dash/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <img src="<?php echo base_url();?>assets/uploads/profil/logo.jpeg" style="height: 110px;" >
            <form method="POST" action="<?php echo base_url();?>login/masuk">
             <h1>Rumah Hijab</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" id="username" name="username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" id="password" name="password" />
              </div>
              <div>
                <input type="submit" class="btn btn-default submit" value="Log in">
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <br />
                <div>
                </div>
              </div> 
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
