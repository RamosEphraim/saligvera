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
		<div class="col-md-9">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Workers Lists</h5>
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
							<th>Position</th>
							<th>Contact Number</th>
							<th>Address</th>
						</tr>
					</thead>
					<tbody>
					<form method="post">
					<?php foreach ($show as $row): ?>
						<tr>
							<td><input type="checkbox" name="worker_id[]" value="<?=$row->worker_id?>"</td>
							<td><?=$row->name?></td>
							<td><?=$row->position?></td>
							<td><?=$row->contact?></td>
							<td><?=$row->address?></td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
		</div>
		<!-- /sidebars overview -->
		<!-- Sidebars overview -->
		<div class="col-md-3">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Select Project</h5>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse"></a></li>
                		<li><a data-action="reload"></a></li>
                	</ul>
            	</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label><b>Project Name: </b><br>
						<small>
							<i class="icon-chevron-right"></i> <?=$edit['project_name']?>
						</small>
					</label><br>
					
					<label><b>Engineer/Architect: </b><br>
						<small>
							<?php if($edit['first_ea'] != 0) { ?>
								&bull; <?=$first['type_role'] == 1 ? 'Engr. ' : 'Arch. '?><?=$first['firstname'].' '.$first['surname']?><br>
							<?php } ?> 
							<?php if($edit['second_ea'] != 0) { ?>
								&bull; <?=$second['type_role'] == 1 ? 'Engr. ' : 'Arch. '?><?=$second['firstname'].' '.$second['surname']?><br>
							<?php } ?> 
							<?php if($edit['third_ea'] != 0) { ?>
								&bull; <?=$third['type_role'] == 1 ? 'Engr. ' : 'Arch. '?><?=$third['firstname'].' '.$third['surname']?>
							<?php } ?> 
						</small>
					</label><br>
					<label><b>Project Date: </b><br>
						<small>
						<?php if ($edit['project_enddate'] == ""){ ?>
							<b>Type:</b> Private Project <br>
							<b>Start Date:</b> <?=date('M d, Y', strtotime($edit['project_startdate']))?><br>
						<?php } else { ?>
							<b>Type:</b> Public Project <br>
							<b>Start Date:</b> <?=date('M d, Y', strtotime($edit['project_startdate']))?><br>
							<b>End Date:</b> <?=date('M d, Y', strtotime($edit['project_enddate']))?><br>
						<?php } ?>
						</small>
					</label><br>
				</div>

					<button type="submit" name="btn-apply" class="btn btn-block btn-primary btn-sm" style="border-radius: 0px;">SET WORKER <i class="icon-arrow-right14 position-right"></i></button>
					</form>
				</form>				
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