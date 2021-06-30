<div class="content-wrapper">
	<!-- Page header -->
	<div class="page-header page-header-default">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?=$title?></span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li class="active">You are here</li>
				<?php foreach ($breadcrumbs as $key => $value) { ?>
				<li class="active"> <?=$value?> </li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<!-- /page header -->

	<div class="content">
		<?php
		    if($this->session->flashdata('success')){
		      echo "<div class='alert bg-success' style='border-radius:0px;'><button type='button' class='close' data-dismiss='alert'><span>&times;</span><span class='sr-only'>Close</span></button>".$this->session->flashdata('success') ."</div>";
		    }
		    if($this->session->flashdata('error')){
		      echo "<div class='alert bg-danger' style='border-radius:0px;'><button type='button' class='close' data-dismiss='alert'><span>&times;</span><span class='sr-only'>Close</span></button>".$this->session->flashdata('error') ."</div>";
		    }
		?>
		<!-- Modal Change Picture -->
		<div id="modal_animation" class="modal">
			<div class="modal-dialog modal-xs">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title">Change Picture</h5>
					</div>

					<div class="modal-body">
						<div class="form-group" style="width:100%">
                            <div class="input-group input-group-md">
                                <img  id="preview" class="img-thumbnail img-responsive" style="height:250px; width:100%;" >
                                <input type="file" name="acc_image" class="form-control picture"> 
                            </div>    
                        </div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<!-- / Modal Change Picture -->	
		<!-- Sidebars overview -->
		<div class="panel panel-flat">
			<div class="panel-body">
				<h6 class="content-group text-semibold">Edit Profile</h6>
				<div class="panel-group" id="accordion-styled">
					<div class="panel">
						<a data-toggle="collapse" data-parent="#accordion-styled" href="#generalSettings">
							<div class="panel-heading bg-danger">
								<h6 class="panel-title"><i class="icon-cogs"></i> &nbsp;&nbsp;General Settings</h6>
							</div>
						</a>
						<div id="generalSettings" class="panel-collapse collapse">
							<div class="panel-body">
								<?=form_open('Head/Change/General/update')?>
									<div class="col-md-4">
										<div class="form-group">
											<label>Surname</label>
											<input type="text" class="form-control" value="<?=$edit['surname']?>" name="surname" style="border-radius:0px;">
											<?=form_error('surname', '<small class="text-danger">', '</small>');?>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Firstname</label>
											<input type="text" class="form-control" value="<?=$edit['firstname']?>" name="firstname" style="border-radius:0px;">
											<?=form_error('firstname', '<small class="text-danger">', '</small>');?>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Middlename</label>
											<input type="text" class="form-control" value="<?=$edit['middlename']?>" name="middlename" style="border-radius:0px;">
											<?=form_error('middlename', '<small class="text-danger">', '</small>');?>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Email Address</label>
											<input type="text" class="form-control" value="<?=$edit['email']?>" name="email" style="border-radius:0px;">
											<?=form_error('email', '<small class="text-danger">', '</small>');?>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Contact Number</label>
											<input type="text" class="form-control" value="<?=$edit['contact']?>" name="contact" style="border-radius:0px;">
											<?=form_error('contact', '<small class="text-danger">', '</small>');?>
										</div>
									</div>
									<div class="col-md-12">
									<div class="text-right">
										<button type="submit" class="btn btn-primary btn-sm" name="btn-update" style="border-radius: 0px;">Save Changes <i class="icon-arrow-right14 position-right"></i></button>
									</div>
									</div>
								<?=form_close();?>
							</div>
						</div>
					</div>

					<div class="panel">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#changePassword">
							<div class="panel-heading bg-teal">
								<h6 class="panel-title"><i class="icon-lock2"></i>&nbsp;&nbsp; Change Password </h6>
							</div>
						</a>
						<div id="changePassword" class="panel-collapse collapse">
							<div class="panel-body">
								<?=form_open('Head/Change/Password/update')?>
									<div class="col-md-4">
										<div class="form-group">
											<label>Current Password</label>
											<input type="password" class="form-control" name="current" style="border-radius:0px;">
											<?=form_error('current', '<small class="text-danger">', '</small>');?>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>New Password</label>
											<input type="password" class="form-control" name="newpass" style="border-radius:0px;">
											<?=form_error('newpass', '<small class="text-danger">', '</small>');?>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Re-type Password</label>
											<input type="password" class="form-control" name="confirmpass" style="border-radius:0px;">
											<?=form_error('confirmpass', '<small class="text-danger">', '</small>');?>
										</div>
									</div>
									<div class="col-md-12">
									<div class="text-right">
										<button type="submit" class="btn btn-primary btn-sm" name="btn-update" style="border-radius: 0px;">Change Password <i class="icon-arrow-right14 position-right"></i></button>
									</div>
									</div>
								<?=form_close();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /sidebars overview -->

					
		<!-- Footer -->
		<div class="footer text-muted">
			Copyright &copy; 2018 | R.Y.Saligvera Construction and Supply Corporation | Project Management System 
		</div>
		<!-- /footer -->

	</div>
	<!-- /content area -->
</div>