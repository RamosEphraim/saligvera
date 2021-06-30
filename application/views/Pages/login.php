<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url()?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <title>R.Y.Saligvera Construction and Supply Corporation</title>
    <link href="<?=base_url()?>assets/uploads/icon.png" rel="icon" type="text/css">
</head>

<body class="login-container">

    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content pb-20">
                    <center>
                        <img src="<?=base_url()?>assets/uploads/icon.png" class="img-responsive">
                    </center>
                    <br>
                    <?=form_open('login/submit');?>
                        <div class="panel panel-body login-form">
                            <?php
                                if($this->session->flashdata('success')){
                                  echo "<div class='alert alert-success'>".$this->session->flashdata('success') ."</div>";
                                }
                                if($this->session->flashdata('error')){
                                  echo "<div class='alert alert-danger'>".$this->session->flashdata('error') ."</div>";
                                }
                            ?>
                            <div class="text-center">
                                <h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="text" class="form-control" placeholder="Username" name="username">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn bg-blue btn-block" style="border-radius: 0px;">Login <i class="icon-arrow-right14 position-right"></i></button>
                            </div>

                            <div class="content-divider text-muted form-group"><span><i class="icon-construction"></i></span></div>
                           
                            <span class="help-block text-center no-margin">Project Management System <br><a href="#">Copyright &copy; 2018</a></span>
                        </div>
                    <?=form_close()?>
                    <!-- /advanced login -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

</body>
<script type="text/javascript" src="<?=base_url()?>assets//js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets//js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets//js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets//js/plugins/loaders/blockui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets//js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets//js/core/app.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets//js/pages/login.js"></script>
</html>
