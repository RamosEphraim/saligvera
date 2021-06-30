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
			<div class="panel-heading">
				<h5 class="panel-title"><a href="<?=base_url()?>Accounting/Print" class="btn bg-green-400 btn-sm" style="border-radius: 0px;" target="_blank">Print Ordered Report</a></h5>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse"></a></li>
                		<li><a data-action="reload"></a></li>
                		<li><a data-action="close"></a></li>
                	</ul>
            	</div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
				<table class="table datatable-basic table-striped">
					<thead>
						<tr>
							<th style="width:2px;">#</th>
							<th>Project</th>
							<th>Engineer/Architect</th>
							<th>Order Supply</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Status</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;
						foreach ($show as $row) { 
							$rows = $this->RequestModel->get($row->request_id);
							$rows2 = $this->AccountModel->edit($rows['account_id']);
							$rows3 = $this->SupplyModel->edit($rows['supply_id']);
							$rows4 = $this->ProjectModel->edit($rows['project_id']);
						?>
						<tr>
							<td><?=$i++?></td>
							<td><?=$rows4['project_name']?></td>
							<td><?=$rows2['type_role'] == 1 ? 'Engr.' : 'Arch.'?> <?=$rows2['firstname'].' '.$rows2['surname']?></td>
							<td><?=$rows3['item']?></td>
							<td><?=$rows['quantity']?></td>
							<td><?=$rows3['unit']?></td>
							<td><?=$row->order_status == 1 ? 'Verified' : 'Denied'?></td>
							<td><?=date('F d, Y',strtotime($row->order_date))?></td>
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