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
		    if($this->session->flashdata('success2')){
		      echo "<div class='alert bg-success' style='border-radius:0px;'><button type='button' class='close' data-dismiss='alert'><span>&times;</span><span class='sr-only'>Close</span></button>".$this->session->flashdata('success2') ."</div>";
		    }
		    if($this->session->flashdata('error2')){
		      echo "<div class='alert bg-danger' style='border-radius:0px;'><button type='button' class='close' data-dismiss='alert'><span>&times;</span><span class='sr-only'>Close</span></button>".$this->session->flashdata('error2') ."</div>";
		    }
		?>
		<!-- Sidebars overview -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Order Supply</h5>
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
							<th>Project</th>
							<th>Engineer/Architect</th>
							<th>Order Supply</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Date</th>
							<th>Actions</th>	
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1;
						foreach ($show as $row){ 
						$rows = $this->AccountModel->edit($row->account_id);
						$rows2 = $this->SupplyModel->edit($row->supply_id);
						$rows3 = $this->ProjectModel->edit($row->project_id);
						?>
							<tr>
								<td><?=$i++?>.</td>
								<td><?=$rows3['project_name']?></td>
								<td><?=$rows['type_role'] == 1 ? 'Engr.' : 'Arch.'?> <?=$rows['firstname'].' '.$rows['surname']?></td>
								<td><?=$rows2['item']?></td>
								<td><?=$row->quantity?></td>
								<td><?=$rows2['unit']?></td>
								<td><?=date('F d, Y', strtotime($row->request_date))?></td>
								<td style="width:15%;">
									<a href="#" class="btn btn-primary btn-sm" data-popup="tooltip" title="" data-original-title="Verify" style="border-radius: 0px;" data-toggle="modal" data-target="#approve-<?=$row->request_id?>"><i class=" icon-checkmark3"></i></a>
									<a href="#" class="btn btn-danger btn-sm" data-popup="tooltip" title="" data-original-title="Deny" data-toggle="modal" data-target="#deny-<?=$row->request_id?>" style="border-radius: 0px;"><i class=" icon-cross2"></i></a>
								</td>
							</tr>
							<div id="approve-<?=$row->request_id?>" class="modal">
								<div class="modal-dialog modal-xs">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h5 class="modal-title">Confirmation</h5>
										</div>

										<div class="modal-body">
											<?=form_open('Warehouse/Verify/'.$row->request_id)?>
												<input type="text" class="form-control" name="pincode" placeholder="Please input your pincode." style="border-radius: 0px;">
										</div>

										<div class="modal-footer">
											<button type="submit" class="btn btn-primary btn-sm" style="border-radius: 0px">Save changes</button>
											<?=form_close()?>
										</div>
									</div>
								</div>
							</div>
							<div id="deny-<?=$row->request_id?>" class="modal">
								<div class="modal-dialog modal-xs">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h5 class="modal-title">Confirmation</h5>
										</div>

										<div class="modal-body">
											<?=form_open('Warehouse/Deny/'.$row->request_id)?>
												<input type="text" class="form-control" name="pincode" placeholder="Please input your pincode." style="border-radius: 0px;">
										</div>

										<div class="modal-footer">
											<button type="submit" class="btn btn-primary btn-sm" style="border-radius: 0px">Save changes</button>
											<?=form_close()?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /sidebars overview -->
		<!-- Modal Change Picture -->
		<div id="modal_animation" class="modal">
			<div class="modal-dialog modal-xs">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title">Confirmation</h5>
					</div>

					<div class="modal-body">
						<form method="post">
							<input type="text" class="form-control" placeholder="Please input your pincode." style="border-radius: 0px;">
						</form>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<!-- / Modal Change Picture -->	

					
		<!-- Footer -->
		<div class="footer text-muted">
			Copyright &copy; 2018 | R.Y.Saligvera Construction and Supply Corporation | Project Management System 
		</div>
		<!-- /footer -->

	</div>
	<!-- /content area -->
</div>