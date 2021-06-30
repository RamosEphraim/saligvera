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
				<h5 class="panel-title">Supply Requests</h5>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse"></a></li>
                		<li><a data-action="reload"></a></li>
                		<li><a data-action="close"></a></li>
                	</ul>
            	</div>
			</div>
			<div class="panel-body">
				<table class="table datatable-basic table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Engineer/Architect</th>
							<th>Request</th>
							<th>Quantty</th>
							<th>Unit</th>
							<th>Date</th>
							<th>Status</th>
							<th style="width:auto">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1;
						foreach ($show as $row){
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
								<?php if ($row->request_status == 1){ ?>
								<td>Pending Request</td>
								<td>
									<!-- Purchasing Search -->
									<a href="<?=base_url()?>Purchasing/CheckStocks/Request/<?=$row->supply_id?>" class="btn bg-blue btn-sm" data-popup="tooltip" title="" data-original-title="Check Supply" style="border-radius: 0px;"><i class="icon-search4"></i></a>
									<a href="<?=base_url()?>Purchasing/SendOrder/send/<?=$row->request_id?>" class="btn bg-violet btn-sm" data-popup="tooltip" title="" data-original-title="Send Order" style="border-radius: 0px;"><i class="icon-inbox"></i></a>
									<a href="<?=base_url()?>Purchasing/DeclineSupply/send/<?=$row->request_id?>" class="btn btn-danger btn-sm" data-popup="tooltip" title="" data-original-title="Supply Not Available" style="border-radius: 0px;"><i class="icon-cross"></i></a>
								</td>
								<?php } elseif ($row->request_status == 3){ ?>
								<td>Verified Order</td>
								<td>
									<a href="<?=base_url()?>Purchasing/SendSupply/send/<?=$row->request_id?>" class="btn btn-warning btn-sm" style="border-radius: 0px;">Send Supply Request</a>
								</td>
								<?php } elseif ($row->request_status == 5){ ?>
								<td>Warehouse Verified</td>
								<td>
									<a href="<?=base_url()?>Purchasing/ConfirmedRequest/send/<?=$row->request_id?>" class="btn btn-success btn-sm" style="border-radius: 0px;">Confirm Request</a>
								</td>
								<?php } elseif ($row->request_status == 6){ ?>
								<td>Confirmed Request</td>
								<td>
									<label class="label label-success">Confirmed</label>
								</td>
								<?php } elseif ($row->request_status == 7){ ?>
								<td>Deny Order</td>
								<td>
									<a href="<?=base_url()?>Purchasing/RejectRequest/send/<?=$row->request_id?>" class="btn btn-danger btn-sm" style="border-radius: 0px;">Reject Request</a>
								</td>
								<?php } elseif ($row->request_status == 8){ ?>
								<td>Reject Request</td>
								<td>
									<label class="label label-danger">Rejected</label>
								</td>
								<?php } elseif ($row->request_status == 9){ ?>
								<td>Decline Supply</td>
								<td>
									<a href="<?=base_url()?>Purchasing/DeclineSupply/send/<?=$row->request_id?>" class="btn btn-danger btn-sm" style="border-radius: 0px;">Decline Supply</a>
								</td>
								<?php } elseif ($row->request_status == 10){ ?>
								<td>Out of Stock</td>
								<td>
									<label class="label label-danger">N/A</label>
								</td>
								<?php } ?>
							</tr>
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
						<h5 class="modal-title">Configuration</h5>
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