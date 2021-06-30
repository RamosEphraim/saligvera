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
		<!-- Sidebars overview -->
		<div class="panel panel-flat">
		
			<div class="panel-body">
				<table class="table datatable-basic table-striped">
					<thead>
						<tr>
							<th style="width:2px;">#</th>
							<th>Name</th>
							<th>Username</th>
							<th>Contact</th>
							<th>Role</th>
							<th>Pincode</th>
							<th>Status</th>
							<th style="width:1px">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i=1;
						foreach ($show as $row) {
						?>
						<tr>
							<td><?=$i++?></td>
							<td>
								<?php 
								if($row->type_role == 1){ 
									echo 'Engr.';
								} elseif ($row->type_role == 2) {
									echo 'Arch.';
								} ?> 
								<?=$row->firstname.' '.$row->surname?>
							</td>
							<td><?=$row->username?></td>
							<td><?=$row->contact?></td>
							<?php if($row->role == 1){ ?>
							<td>Accounting Department</td>
							<?php } elseif($row->role == 2) { ?>
							<td>Technical Department</td>
							<?php } elseif($row->role == 3) { ?>
							<td>Purchasing  Department</td>
							<?php } elseif($row->role == 4) { ?>
							<td>Engineer/Architect</td>
							<?php } elseif($row->role == 5) { ?>
							<td>Warehouse </td>
							<?php } ?> 
							<td><?=$row->pincode?></td>
							<td><?=$row->account_status == 1 ? 'Activated' : 'Deactivated'?></td>
							<td><a href="<?=base_url()?>HR/Edit/<?=$row->account_id?>" class="btn btn-primary btn-sm" style="border-radius: 0px;" data-popup="tooltip" data-original-title="Modify"><i class="icon-pencil7"></i></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
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