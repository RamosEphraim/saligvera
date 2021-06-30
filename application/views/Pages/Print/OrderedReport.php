<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url()?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <title>R.Y.Saligvera Construction and Supply Corporation</title>
    <link href="<?=base_url()?>assets/uploads/icon.png" rel="icon" type="text/css">
</head>
<body onload="window.print();">
<div class="col-md-12">
	<div class="page-container">
			<div class="row">
				<div class="panel panel-white">
					<div class="panel-body">
						<center><h3>ORDERED REPORT</h3><hr></center>
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
									<?php if($row->order_status == 1){ ?>
										<td>Verified</td>
									<?php } elseif($row->order_status == 2){ ?>
										<td>Denied</td>
									<?php } elseif($row->order_status == 3){ ?>
										<td>Confirmed</td>
									<?php } elseif($row->order_status == 4){ ?>
										<td>Denied</td>
									<?php } ?>
									<td><?=date('F d, Y',strtotime($row->order_date))?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<hr>
						<center><b>R.Y.Saligvera Construction and Supply Corporation<br>Print Date: <?=date('F d, Y  -  h:i A') ?></b></center>
					</div>
				</div>
			</div>
	</div>
</div>

</body>
</html>