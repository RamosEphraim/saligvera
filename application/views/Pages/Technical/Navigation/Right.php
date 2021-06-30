<div class="sidebar sidebar-opposite sidebar-default">
	<div class="sidebar-content">
		
		
		<?php if ($nav == 'Projects Lists') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Add New Project</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				
				<div class="form-group">
					<label>Project Type:</label>
					<select class="form-control" name="type" id="type" onchange="projectType(this.value)" required>
						<option value="">--Select Project Type--</option>
						<option value="1">Public</option>
						<option value="2">Private</option>
					</select>
				</div>
				<?=form_open('Technical/Project/Public/add')?>
				<input type="hidden" class="form-control" value="1" name="type">
				<div id="public">
					<div class="form-group">
						<label>Project Name:</label>
						<input type="text" class="form-control" value="<?php echo set_value('project_name'); ?>" name="project_name">
						<?=form_error('project_name', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Project Engineer #1:</label>
						<select class="form-control" name="first_ea">
							<option value="a">--Select Engineer--</option>
							<?php foreach ($engr as $row): ?>
								<option value="<?=$row->account_id?>">Engr.<?=$row->firstname.' '.$row->surname?></option>
							<?php endforeach ?>
						</select>
						<?=form_error('first_ea', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Project Engineer #2:</label>
						<select class="form-control" name="second_ea">
							<option value="b">--Select Engineer--</option>
							<?php foreach ($engr as $row): ?>
								<option value="<?=$row->account_id?>">Engr.<?=$row->firstname.' '.$row->surname?></option>
							<?php endforeach ?>
						</select>
						<?=form_error('second_ea', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Project Engineer #3:</label>
						<select class="form-control" name="third_ea">
							<option value="c">--Select Engineer--</option>
							<?php foreach ($engr as $row): ?>
								<option value="<?=$row->account_id?>">Engr.<?=$row->firstname.' '.$row->surname?></option>
							<?php endforeach ?>
						</select>
						<?=form_error('third_ea', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Budget for Site:</label>
						<input type="text" class="form-control" value="<?php echo set_value('budget'); ?>" name="budget">
						<?=form_error('budget', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Start Date:</label>
						<input type="date" class="form-control" value="<?php echo set_value('start_date'); ?>" name="start_date">
						<?=form_error('start_date', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>End Date:</label>
						<input type="date" class="form-control" value="<?php echo set_value('end_date'); ?>" name="end_date">
						<?=form_error('end_date', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="text-right">
						<button type="submit" name="btn-addProject" class="btn btn-primary btn-sm" style="border-radius: 0px;">Submit <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</div>
				<?=form_close()?>
				<?=form_open('Technical/Project/Private/add')?>
				<input type="hidden" class="form-control" value="1" name="type">
				<div id="private">
					<div class="form-group">
						<label>Project Name:</label>
						<input type="text" class="form-control" value="<?php echo set_value('xproject_name'); ?>" name="xproject_name">
						<?=form_error('xproject_name', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Project Architect #1:</label>
						<select class="form-control" name="xfirst_ea">
							<option value="a">--Select Architect--</option>
							<?php foreach ($arch as $row): ?>	
								<option value="<?=$row->account_id?>">Arch.<?=$row->firstname.' '.$row->surname?></option>	
							<?php endforeach ?>	
						</select>
						<?=form_error('xfirst_ea', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Project Architect #2:</label>
						<select class="form-control" name="xsecond_ea">
							<option value="b">--Select Architect--</option>
							<?php foreach ($arch as $row): ?>	
								<option value="<?=$row->account_id?>">Arch.<?=$row->firstname.' '.$row->surname?></option>	
							<?php endforeach ?>									
						</select>
						<?=form_error('xsecond_ea', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Project Architect #3:</label>
						<select class="form-control" name="xthird_ea">
							<option value="c">--Select Architect--</option>
							<?php foreach ($arch as $row): ?>	
								<option value="<?=$row->account_id?>">Arch.<?=$row->firstname.' '.$row->surname?></option>	
							<?php endforeach ?>	
						</select>
						<?=form_error('xthird_ea', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Budget for Site:</label>
						<input type="text" class="form-control" value="<?php echo set_value('xbudget'); ?>" name="xbudget">
						<?=form_error('xbudget', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Start Date:</label>
						<input type="date" class="form-control" value="<?php echo set_value('xstart_date'); ?>" name="xstart_date">
						<?=form_error('xstart_date', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="text-right">
						<button type="submit" name="btn-addproject" class="btn btn-primary btn-sm" style="border-radius: 0px;">Submit <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				<?=form_close()?>
			</div>
		</div>

		<?php } elseif($nav == 'Edit Public Project') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Edit Project</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<!--  if ($end_date != "") { -->
				<?=form_open('Technical/Project/Update')?>
					<div class="form-group">
						<label>Project Name:</label>
						<input type="hidden" name="project_id" value="<?=$edit['project_id']?>">
						<input type="text" name="project_name" value="<?=$edit['project_name']?>" required class="form-control">
						<?=form_error('project_name', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Project Budget:</label>
						<input type="text" name="project_budget" value="<?=$edit['project_budget']?>" required class="form-control">
						<?=form_error('project_budget', '<small class="text-danger">', '</small>');?>
					</div>
					<div class="form-group">
						<label>Project Engineer #1:</label>
						<select class="form-control" name="first_ea">
							<option value="a">--Select Engineer--</option>
							<?php foreach ($engr as $row): ?>
								<option value="<?=$row->account_id?>" <?=$edit['first_ea'] == $row->account_id ? 'selected' : ''?>>Engr.<?=$row->firstname.' '.$row->surname?></option>
							<?php endforeach ?>
						</select>
						<?=form_error('first_ea', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Project Engineer #2:</label>
						<select class="form-control" name="second_ea">
							<option value="b">--Select Engineer--</option>
							<?php foreach ($engr as $row): ?>
								<option value="<?=$row->account_id?>" <?=$edit['second_ea'] == $row->account_id ? 'selected' : ''?>>Engr.<?=$row->firstname.' '.$row->surname?></option>
							<?php endforeach ?>
						</select>
						<?=form_error('second_ea', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Project Engineer #3:</label>
						<select class="form-control" name="third_ea">
							<option value="b">--Select Engineer--</option>
							<?php foreach ($engr as $row): ?>
								<option value="<?=$row->account_id?>" <?=$edit['third_ea'] == $row->account_id ? 'selected' : ''?>>Engr.<?=$row->firstname.' '.$row->surname?></option>
							<?php endforeach ?>
						</select>
						<?=form_error('third_ea', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Start Date:</label>
						<input type="date" class="form-control" name="start_date" id="start_date" value="2018-09-20" required>
					</div>

					<div class="form-group">
						<label>End Date:</label>
						<input type="date" class="form-control" name="end_date" id="end_date" value="2025-09-20" required>
					</div>

					<div class="text-right">
						<button type="submit" name="btn-addSupply" class="btn btn-primary btn-sm" style="border-radius: 0px;">Save Changes <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				<?=form_close()?>
			</div>
		</div>
		<?php } elseif($nav == 'Checklist') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Project Details</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<!--  if ($end_date != "") { -->
				<div class="form-group">
					<label>Project Name: <br><b><?=$edit['project_name']?></b></label><br><hr>
					<label>Project Budget: <br><b>&#8369;<?=number_format($edit['project_budget'], 2) ?></b></label><br><hr>
					<label>Project Start Date: <br><b><?=$edit['project_startdate']?></b></label><br><hr>
					<label>Project End Date: <br><b><?=$edit['project_enddate'] == "" ? 'No End Date' : $edit['project_enddate']?></b></label><br><hr>
					
					<label>Project progress:  </label>
					<div class="progress content-group-sm" id="h-center-nonpercentage-basic">
						<div class="progress-bar progress-bar-success" style="width:<?=!isset($progress)? 0 : $progress?>%">
							<span><?=$progress;?>%</span>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<?php } ?>

	</div>
</div>
