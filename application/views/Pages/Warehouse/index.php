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
				<h5 class="panel-title">Supply List</h5>
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
							<th>Item</th>
							<th>Description</th>
							<th>Stocks</th>
							<th>Unit</th>
							<th>Supplier</th>
							<th>Status</th>
							<th style="width:1px"></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;foreach ($show as $row): ?>
							<tr>
								<td><?=$i++?></td>
								<td><?=$row->item?></td>
								<td><?=$row->description?></td>
								<td><?=$row->stocks?></td>
								<td><?=$row->unit?></td>
								<td><?=$row->supplier?></td>
								<?php if($row->supply_status == 1){ ?>
								<td>Available</td>
								<?php } elseif($row->supply_status = 2) { ?>
								<td>Low Stock</td>
								<?php } else { ?>
								<td>Out of Stack</td>
								<?php } ?>
								<td>
									<a href="<?=base_url()?>Warehouse/Supply/Edit/<?=$row->supply_id?>" class="btn bg-blue btn-sm" data-popup="tooltip" title="" data-original-title="Edit Supply" style="border-radius: 0px;"><i class="icon-pencil7"></i></a>
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