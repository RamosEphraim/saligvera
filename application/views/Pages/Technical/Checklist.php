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

	<div class="content">
		<div class="col-md-12">
		<?php
		    if($this->session->flashdata('success')){
		      echo "<div class='alert bg-success' style='border-radius:0px;'><button type='button' class='close' data-dismiss='alert'><span>&times;</span><span class='sr-only'>Close</span></button>".$this->session->flashdata('success') ."</div>";
		    }
		    if($this->session->flashdata('error')){
		      echo "<div class='alert bg-danger' style='border-radius:0px;'><button type='button' class='close' data-dismiss='alert'><span>&times;</span><span class='sr-only'>Close</span></button>".$this->session->flashdata('error') ."</div>";
		    }
		?>
		</div>
	
		<div class="col-md-3">
		<div class="panel panel-flat">
		
			<div class="panel-heading">
				<h5 class="panel-title">Add Check List</h5>
			</div>
			<div class="panel-body">
				<?=form_open('Technical/Checklist/add/'.$edit['project_id'])?>
					<div class="form-group">
						<label>Task:</label>
						<input type="text" class="form-control" value="<?php echo set_value('task'); ?>" name="task">
						<?=form_error('task', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Task Percentage:</label>
						<input type="text" class="form-control" value="<?php echo set_value('percentage'); ?>" name="percentage">
						<?=form_error('percentage', '<small class="text-danger">', '</small>');?>
					</div>

					<button type="submit" name="btn-addCheck" class="btn btn-primary btn-sm pull-right" style="border-radius: 0px;">Submit</button>
				<?=form_close()?>
			</div>
		</div>
		</div>
		<div class="col-md-9">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Check List</h5>
			</div>
			<div class="panel-body">
				<table class="table table-condensed table-striped">
					<thead>
						<tr>
							<th style="width:5px">#</th>
							<th>Task</th>
							<th>%</th>
							<th>Status</th>
							<th>Start</th>
							<th>End</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; foreach ($show as $row): ?>
							<?php 
								switch($row->task_status) { 
									case 0: 
										$status = '<label class="label label-success">Finished</label>';
										$action = ''; 
									break;

									case 1: 
										$status = '<label class="label label-info">On Going</label>'; 
										$action = '<a data-toggle="modal" data-target="#checklist'.$row->check_id.'" class="btn btn-primary btn-sm pull-right" style="border-radius: 0px;">Finish Task</a>'; 
									break;

									case 2: 
										$status = '<label class="label label-warning">Not Started</label>'; 
										$action = '<a data-toggle="modal" data-target="#checklist'.$row->check_id.'" class="btn btn-primary btn-sm pull-right" style="border-radius: 0px;">Start Task</a>'; 
									break;
								} 
							?>
							<tr>
								<td><?=$i++?></td>
								<td><?=$row->task?></td>
								<td><?=$row->percentage?>%</td>
								<td><?=$status?></td>
								<td><?=$row->start == '' ? '' : date('F d Y', strtotime($row->start)) ?></td>
								<td><?=$row->end == '' ? '' : date('F d Y', strtotime($row->end)) ?></td>
								<td><?=$action?></td>
							</tr>

												
					<!-- Modal Check List -->
							<div id="checklist<?=$row->check_id?>" class="modal">
								<div class="modal-dialog modal-xs">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h5 class="modal-title">Confirmation</h5>
										</div>
										<div class="modal-body">
											<?=form_open('Technical/Project/Checklist/update/'.$row->check_id)?>
												<input type="text" name="pincode" class="form-control" placeholder="Please input your pincode." style="border-radius: 0px;">
												<input type="hidden" name="project_id" value="<?=$row->project_id?>">
												<input type="hidden" name="start" value="<?=$row->start?>">
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary btn-sm" style="border-radius: 0px">Save changes</button>
											<?=form_close()?>
										</div>
									</div>
								</div>
							</div>
							<!-- / Modal Check List -->		
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
		</div>
		

		<!-- Footer -->
		<div class="footer text-muted">
			Copyright &copy; 2018 | R.Y.Saligvera Construction and Supply Corporation | Project Management System 
		</div>
		<!-- /footer -->

	</div>
	<!-- /content area -->
</div>