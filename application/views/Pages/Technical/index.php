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
				<h5 class="panel-title">Project Lists</h5>
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
							<th>Project Name</th>
							<th>Engineer/Architect</th>
							<th>Budget</th>
							<th>Number of Workers</th>
							<th>Project Progress</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($show as $row): 
						$first = $this->AccountModel->edit($row->first_ea);
						$second = $this->AccountModel->edit($row->second_ea);
						$third = $this->AccountModel->edit($row->third_ea);

						?>
							<tr>
								<td>
									<?=$row->project_name?><br>
									<small>
									<?php if ($row->project_enddate == ""){ ?>
										<b>Type:</b> Private Project <br>
										<b>Start Date:</b> <?=date('M d, Y', strtotime($row->project_startdate))?><br>
										<?php if ($row->project_progress == 0){ ?>
										<a href="<?=base_url()?>Technical/Private/Edit/<?=$row->project_id?>" ><label class="label label-default" style="cursor:pointer">Edit</label></a>
									<?php } } else { ?>
										<b>Type:</b> Public Project <br>
										<b>Start Date:</b> <?=date('M d, Y', strtotime($row->project_startdate))?><br>
										<b>End Date:</b> <?=date('M d, Y', strtotime($row->project_enddate))?><br>
										<?php if ($row->project_progress == 0){ ?>
										<a href="<?=base_url()?>Technical/Public/Edit/<?=$row->project_id?>" ><label class="label label-default" style="cursor:pointer">Edit</label></a>
									<?php } } ?>
									</small>
								</td>
								<td>
									<?php if($row->first_ea != 0) { ?>
										&bull; <?=$first['type_role'] == 1 ? 'Engr.' : 'Arch.'?><?=$first['firstname'].' '.$first['surname']?><br>
									<?php } ?> 
									<?php if($row->second_ea != 0) { ?>
										&bull; <?=$second['type_role'] == 1 ? 'Engr.' : 'Arch.'?><?=$second['firstname'].' '.$second['surname']?><br>
									<?php } ?> 
									<?php if($row->third_ea != 0) { ?>
										&bull; <?=$third['type_role'] == 1 ? 'Engr.' : 'Arch.'?><?=$third['firstname'].' '.$third['surname']?>
									<?php } ?> 
								</td>
								<td>&#8369;<?=number_format($row->project_budget, 2) ?></td>
								<td><?=$row->project_workers?></td>
								<td><?=$row->project_progress?>%</td>
								<td>
								<?php if ($row->project_status != 1){ ?>
								<a href="<?=base_url()?>Technical/Project/Checklist/<?=$row->project_id?>"><label class="label label-primary" style="cursor:pointer;">View Checklist</label></a>
								<?php } ?>
								<?php if($row->project_progress == 100 && $row->project_status != 1){ ?>
									<a href="#" class="btn btn-success btn-sm" data-popup="tooltip" title="" data-original-title="Project Done" style="border-radius: 0px;" data-toggle="modal" data-target="#modal_animation-<?=$row->project_id?>"><i class=" icon-checkmark3"></i></a>
								<?php }  elseif ($row->project_progress != 100 && $row->project_status != 1) { ?>
									<label class="label label-info	">On Going</label>
								<?php } elseif ($row->project_progress == 100 && $row->project_status == 1) { ?>
									<label class="label label-success">Project Done</label>
								<?php } ?>
								</td>
							</tr>

							<!-- Modal Change Picture -->
							<div id="modal_animation-<?=$row->project_id?>" class="modal">
								<div class="modal-dialog modal-xs">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h5 class="modal-title">Confirmation</h5>
										</div>
										<div class="modal-body">
											<?=form_open('Technical/Project/Status/update/'.$row->project_id)?>
												<input type="text" name="pincode" class="form-control" placeholder="Please input your pincode." style="border-radius: 0px;">
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary btn-sm" style="border-radius: 0px">Save changes</button>
											<?=form_close()?>
										</div>
									</div>
								</div>
							</div>
							<!-- / Modal Change Picture -->	
						<?php endforeach ?>
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