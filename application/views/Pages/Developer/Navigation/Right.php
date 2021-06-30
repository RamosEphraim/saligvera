<div class="sidebar sidebar-opposite sidebar-default">
	<div class="sidebar-content">
		
		
		<?php if ($nav == 'Accounts Lists') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Add New Accounts</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<?=form_open('Developer/Account/add')?>
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
					
					<div class="text-right">
						<button type="submit" name="btn-addHead" class="btn btn-primary btn-sm" style="border-radius: 0px;">Submit <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</form>
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
				<?=form_open('Developer/Status/update/'.$edit['account_id'])?>
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
				</form>
			</div>
		</div>
		<?php } ?>

	</div>
</div>
