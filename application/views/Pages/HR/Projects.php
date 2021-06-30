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
							<th>Project Name</th>
							<th>Engineer/Architect</th>
							<th>Budget</th>
							<th>Number of Workers</th>
							<th>Project Status</th>
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
									<?php } else { ?>
										<b>Type:</b> Public Project <br>
										<b>Start Date:</b> <?=date('M d, Y', strtotime($row->project_startdate))?><br>
										<b>End Date:</b> <?=date('M d, Y', strtotime($row->project_enddate))?><br>
									<?php } ?>
									</small>
								</td>
								<td>
									<?php if($row->first_ea != 0) { ?>
										&bull; <?=$first['type_role'] == 1 ? 'Engr. ' : 'Arch. '?><?=$first['firstname'].' '.$first['surname']?><br>
									<?php } ?> 
									<?php if($row->second_ea != 0) { ?>
										&bull; <?=$second['type_role'] == 1 ? 'Engr. ' : 'Arch. '?><?=$second['firstname'].' '.$second['surname']?><br>
									<?php } ?> 
									<?php if($row->third_ea != 0) { ?>
										&bull; <?=$third['type_role'] == 1 ? 'Engr. ' : 'Arch. '?><?=$third['firstname'].' '.$third['surname']?>
									<?php } ?> 
								</td>
								<td>&#8369;<?=number_format($row->project_budget, 2) ?></td>
								<td><?=$row->project_workers?></td>
								<td><?=$row->project_progress?>%</td>
								<td>
									<?php if ($row->project_progress != 100){ ?>
									<a href="<?=base_url()?>HR/Project/Apply/<?=$row->project_id?>" class="btn btn-primary btn-sm" data-popup="tooltip" title="" data-original-title="Apply Worker" style="border-radius: 0px;"><i class=" icon-plus2"></i></a>
									<?php } else { ?>
									<label class="label label-success">Project Done</label>
									<?php } ?>
								</td>
							</tr>
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