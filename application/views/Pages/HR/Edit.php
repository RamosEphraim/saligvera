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
		<!-- Sidebars overview -->
		<div class="panel panel-flat">
			
			<div class="panel-body">
				<table class="table datatable-basic table-striped">
					<thead>
						<tr>
							<th style="width:2px;">#</th>
							<th>Name</th>
							<th>Position</th>
							<th>Home Address</th>
							<th>Contact Number</th>
							<th>Account Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i=1;
						foreach ($show as $row) {
						?>
						<tr>
							<td><?=$i++?></td>
							<td><?=$row->name?></td>
							<td><?=$row->position?></td>
							<td><?=$row->address?></td>
							<td><?=$row->contact?></td>
							<?php if ($row->worker_status == 1){ ?>
							<td>Worker Available</td>
							<?php } elseif($row->worker_status == 2) { ?>
							<td>Worker Not Available</td>
							<?php } elseif($row->worker_status == 3) { ?>
							<td>Worker Have Project</td>
							<?php } ?> 
							<td><a href="<?=base_url()?>HR/Worker/Edit/<?=$row->worker_id?>" class="btn btn-primary btn-sm" style="border-radius: 0px;" data-popup="tooltip" data-original-title="Modify"><i class="icon-pencil7"></i></a></td>
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