<div class="sidebar sidebar-opposite sidebar-default">
	<div class="sidebar-content">
		
		<?php if ($nav == 'Accounts') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Add New Accounts</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<?=form_open('HR/Account/add')?>
					<div class="form-group">
						<label>Surame:</label>
						<input type="text" class="form-control" value="<?php echo set_value('surname'); ?>" name="surname">
						<?=form_error('surname', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Firstname:</label>
						<input type="text" class="form-control" value="<?php echo set_value('firstname'); ?>" name="firstname">
						<?=form_error('firstname', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Middlename:</label>
						<input type="text" class="form-control" value="<?php echo set_value('middlename'); ?>" name="middlename">
						<?=form_error('middlename', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Contact Number:</label>
						<input type="text" class="form-control" value="<?php echo set_value('contact'); ?>" name="contact">
						<?=form_error('contact', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Email Address:</label>
						<input type="text" class="form-control" value="<?php echo set_value('email'); ?>" name="email">
						<?=form_error('email', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>User Type:</label>
						<select class="form-control" name="role" onchange="typeuser(this.value)" id="xrole">
							<option value="">--Select User Type--</option>
							<option value="1">Accounting Department</option>
							<option value="2">Technical Department</option>
							<option value="3">Purchasing Department</option>
							<option value="4">Engineer/Architect</option>
							<option value="5">Warehouse </option>
						</select>
						<?=form_error('role', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group" id="extra">
						<label>Select Type:</label>
						<select class="form-control" name="type" id="extra">
							<option value="">--Select User Type--</option>
							<option value="1">Engineer</option>
							<option value="2">Architect</option>
						</select>
						<?=form_error('role', '<small class="text-danger">', '</small>');?>
					</div>
					
					<div class="text-right">
						<button type="submit" name="btn-addUser" class="btn btn-primary btn-sm" style="border-radius: 0px;">Submit <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				<?=form_close()?>
			</div>
		</div>
		<?php } elseif ($nav == 'Edit Account') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Add New Accounts</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<?=form_open('HR/Status/update/'.$edit['account_id'])?>
					<div class="form-group">
						<label><b>Name</b><br>
							<small>
								<i class="icon-chevron-right"></i> <?=$edit['surname'].', '.$edit['firstname'].' '.$edit['middlename']?>
							</small>
						</label>
					</div>

					<div class="form-group">
						<label><b>Contact Number</b><br>
							<small>
								<i class="icon-chevron-right"></i> <?=$edit['contact']?>
							</small>
						</label>
					</div>

					<div class="form-group">
						<label><b>Email Address</b><br>
							<small>
								<i class="icon-chevron-right"></i> <?=$edit['email']?>
							</small>
						</label>
					</div>

					<div class="form-group">
						<label><b>User Type</b><br>
							<small>
								<i class="icon-chevron-right"></i> 
							<?php if($edit['role'] == 1){ ?>
							Accounting Department
							<?php } elseif($edit['role'] == 2) { ?>
							Technical Department
							<?php } elseif($edit['role'] == 3) { ?>
							Purchasing  Department
							<?php } elseif($edit['role'] == 4) { ?>
							Engineer/Architect
							<?php } elseif($edit['role'] == 5) { ?>
							Warehouse 
							<?php } ?> 
							</small>
						</label>
					</div>

					<div class="form-group">
						<label>Status:</label>
						<select class="form-control" name="account_status">
							<option value="">--Select Status--</option>
							<option value="1" <?=$edit['account_status'] == 1 ? 'selected' : ''?>>Activated</option>
							<option value="2" <?=$edit['account_status'] == 2 ? 'selected' : ''?>>Deactivated</option>
						</select>
					</div>
					
					<div class="text-right">
						<button type="submit" name="btn-update" class="btn btn-primary btn-sm" style="border-radius: 0px;">Submit <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				<?=form_close()?>
			</div>
		</div>

		<?php } elseif($nav == 'Workers Lists') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>ADD NEW WORKER</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<?=form_open_multipart('HR/Worker/add')?>

                    <div class="form-group">
                        <label>Picture <?=form_error('worker_img', '<label class="text-danger">', '</label>');?></label>
                        <img  id="preview" class="img-thumbnail img-responsive" style="height:200px; width:100%;" >
                        <input type="file" name="worker_img" class="form-control picture">
                    </div>

					<div class="form-group">
						<label>Worker Name:</label>
						<input type="text" class="form-control" value="<?php echo set_value('name'); ?>" name="name">
						<?=form_error('name', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Position</label>
						<select class="form-control" name="position">
							<option value="">--Select Position--</option>
							<option>Carpenter</option>
							<option>Electrician</option>
							<option>Foreman</option>
							<option>Helper</option>
							<option>Lead Man</option>
							<option>Mason</option>
							<option>Mason Carpenter</option>
							<option>Steel Man</option>
							
							
							
							<option>Plumber</option>
						</select>
						<?=form_error('position', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Contact Number</label>
						<input type="text" class="form-control" value="<?php echo set_value('contact'); ?>" name="contact">
						<?=form_error('contact', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" value="<?php echo set_value('address'); ?>" name="address">
						<?=form_error('address', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="text-right">
						<button type="submit" name="btn-addWorker" class="btn btn-primary btn-sm" style="border-radius: 0px;">Submit <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</form>
			</div>
		</div>
		<?php } elseif($nav == 'Edit Worker') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Edit WORKER</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<?=form_open('HR/Record/update/'.$edit['worker_id'])?>
					<div class="form-group">
						<label>Worker Name:</label>
						<input type="text" class="form-control" value="<?=$edit['name']?>" name="name">
						<?=form_error('name', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Position</label>
						<select class="form-control" name="position">
							<option value="">--Select Position--</option>
							<option <?=$edit['position'] == 'Carpenter' ? 'selected' : '' ?> >Carpenter</option>
							<option <?=$edit['position'] == 'Electrician' ? 'selected' : '' ?> >Electrician</option>
							<option <?=$edit['position'] == 'Foreman' ? 'selected' : '' ?> >Foreman</option>
							<option <?=$edit['position'] == 'Helper' ? 'selected' : '' ?> >Helper</option>
							<option <?=$edit['position'] == 'Lead Man' ? 'selected' : '' ?> >Lead Man</option>
							<option <?=$edit['position'] == 'Mason' ? 'selected' : '' ?> >Mason</option>
							<option <?=$edit['position'] == 'Mason Carpenter' ? 'selected' : '' ?> >Mason Carpenter</option>
							<option <?=$edit['position'] == 'Steel Man' ? 'selected' : '' ?> >Steel Man</option>
						
						</select>
						<?=form_error('position', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Contact Number</label>
						<input type="text" class="form-control" value="<?=$edit['contact']?>" name="contact">
						<?=form_error('contact', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" value="<?=$edit['address']?>" name="address">
						<?=form_error('address', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Worker Status</label>
						<select class="form-control" name="worker_status">
							<option value="">--Select Worker Status--</option>
							<option value="1" <?=$edit['worker_status'] == 1 ? 'selected' : '' ?> />Worker Available</option>
							<option value="2" <?=$edit['worker_status'] == 2 ? 'selected' : '' ?> />Worker Not Available</option>
							<option value="3" <?=$edit['worker_status'] == 3 ? 'selected' : '' ?> />Worker Have Project</option>
						</select>
						<?=form_error('worker_status', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="text-right">
						<button type="submit" name="btn-updateWorker" class="btn btn-primary btn-sm" style="border-radius: 0px;">Save Changes <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</form>
			</div>
		</div>
		<?php } ?>

	</div>
</div>
