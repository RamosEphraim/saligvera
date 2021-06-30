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
		<!-- Sidebars overview -->
		<div class="col-md-4">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Project Information</h5>
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="collapse"></a></li>
	                		<li><a data-action="reload"></a></li>
	                	</ul>
	            	</div>
				</div>
				<div class="panel-body">
					<label><b>Project Name: </b><br>
						<small>
							<i class="icon-chevron-right"></i> <?=$project['project_name']?>
						</small>
					</label><br>
					
					<label><b>Engineer/Architect: </b><br>
						<small>
							<?php if($project['first_ea'] != 0) { ?>
								&bull; <?=$first['type_role'] == 1 ? 'Engr. ' : 'Arch. '?><?=$first['firstname'].' '.$first['surname']?><br>
							<?php } ?> 
							<?php if($project['second_ea'] != 0) { ?>
								&bull; <?=$second['type_role'] == 1 ? 'Engr. ' : 'Arch. '?><?=$second['firstname'].' '.$second['surname']?><br>
							<?php } ?> 
							<?php if($project['third_ea'] != 0) { ?>
								&bull; <?=$third['type_role'] == 1 ? 'Engr. ' : 'Arch. '?><?=$third['firstname'].' '.$third['surname']?>
							<?php } ?> 
						</small>
					</label><br>
					<label><b>Project Date: </b><br>
						<small>
						<?php if ($project['project_enddate'] == ""){ ?>
							<b>Type:</b> Private Project <br>
							<b>Start Date:</b> <?=date('M d, Y', strtotime($project['project_startdate']))?><br>
						<?php } else { ?>
							<b>Type:</b> Public Project <br>
							<b>Start Date:</b> <?=date('M d, Y', strtotime($project['project_startdate']))?><br>
							<b>End Date:</b> <?=date('M d, Y', strtotime($project['project_enddate']))?><br>
						<?php } ?>
						</small>
					</label><br>
					<label><b>Project Progress</b></label><br>
					<div class="progress progress-lg">
					<div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: <?=$project['project_progress']?>%"><span><?=$project['project_progress']?>%</span></div>
					</div>
				</div>
			</div>

			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Project Checklist</h5>
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="collapse"></a></li>
	                		<li><a data-action="reload"></a></li>
	                	</ul>
	            	</div>
				</div>
				<div class="panel-body">
					<?php foreach ($check as $row): ?>
						<div class="form-group">
						<div class="media-body">
						<?php 
								if($row->task_status == 0) {
									echo '<label class="label label-success pull-right">Finish</label>';
								} elseif($row->task_status == 1) {
									echo '<label class="label label-primary pull-right">On Going</label>';
								} else {
									echo '<label class="label label-danger pull-right">Not Started</label>';
								} 
								?>
							<div class="media-heading text-semibold"><?=$row->task?></div>
						</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<!-- /sidebars overview -->
		<!-- Sidebars overview -->
		<div class="col-md-8">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Project Photos</h5>
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="collapse"></a></li>
	                		<li><a data-action="reload"></a></li>
	                	</ul>
	            	</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<?php foreach ($photo as $show): ?>
							<div class="col-lg-4 col-sm-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="<?=base_url()?>assets/uploads/<?=$show->photo?>" alt="" style="height:100px">
										<div class="caption-overflow">
											<span>
												<a href="<?=base_url()?>assets/uploads/<?=$show->photo?>" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
												<a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
											</span>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
		<!-- /sidebars overview -->
		<!-- Sidebars overview -->
		<div class="col-md-12">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Project Request Supplies</h5>
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="collapse"></a></li>
	                		<li><a data-action="reload"></a></li>
	                	</ul>
	            	</div>
				</div>
				<div class="panel-body">
					<table class="table datatable-basic table-striped">
					<thead>
						<tr>
							<th style="width:2px;">#</th>
							<th>Engineer/Architect</th>
							<th>Item</th>
							<th>Quantity</th>
							<th>Units</th>
							<th>Date</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;foreach ($request as $row){
						$rows = $this->AccountModel->edit($row->account_id);
						$rows2 = $this->SupplyModel->edit($row->supply_id);
						?>
							<tr>
								<td><?=$i++?>.</td>
								<td><?=$rows['type_role'] == 1 ? 'Engr.' : 'Arch.'?> <?=$rows['firstname'].' '.$rows['surname']?></td>
								<td><?=$rows2['item']?></td>
								<td><?=$row->quantity?></td>
								<td><?=$rows2['unit']?></td>
								<td><?=date('F d, Y', strtotime($row->request_date))?></td>
								<?php  if ($row->request_status == 1){ ?>
								<td><label class="label label-primary">Pending</label></td>
								<?php } elseif ($row->request_status == 2 || $row->request_status == 3 || $row->request_status == 4 || $row->request_status == 5 || $row->request_status == 7 ||$row->request_status == 9 ){ ?>
								<td><label class="label label-info">On Process</label></td>
								<?php } elseif ($row->request_status == 6) { ?>
								<td><label class="label label-success"> Confirmed Request</label></td>
								<?php } elseif ($row->request_status == 8) { ?>
								<td><label class="label label-danger"> Denied Request</label></td>
								<?php } elseif ($row->request_status == 10) { ?>
								<td><label class="label label-danger">Out of Stock</label></td>
								<?php } ?>
							</tr>
						<?php } ?>
						
					</tbody>
				</table>
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