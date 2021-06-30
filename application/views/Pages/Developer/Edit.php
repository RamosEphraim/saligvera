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
			<div class="panel-heading">
				<h5 class="panel-title">Head Account Lists</h5>
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
							<th>Name</th>
							<th>Username</th>
							<th>Contact Number</th>
							<th>Email Address</th>
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
							<td><?=$row->firstname.' '.$row->surname?></td>
							<td><?=$row->username?></td>
							<td><?=$row->contact?></td>
							<td><?=$row->email?></td>
							<td><?=$row->account_status == 1 ? 'Activated' : 'Deactivated'?></td>
							<td><a href="<?=base_url()?>Developer/Edit/<?=$row->account_id?>" class="btn btn-primary btn-sm" style="border-radius: 0px;" data-popup="tooltip" data-original-title="Modify"><i class="icon-pencil7"></i></a></td>
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