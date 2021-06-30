<div class="sidebar sidebar-opposite sidebar-default">
	<div class="sidebar-content">
		
		
		<?php if ($nav == 'Request') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Request Reports</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<div class="row">
					<div class="col-xs-6">
						<button class="btn bg-blue-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$today?></b></i> <span>Request<br>Today</span></button>
						<br>
					</div>

					<div class="col-xs-6">
						<button class="btn bg-violet-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$order?></b></i> <span>Send<br>Order</span></button>
						<br>
					</div>

					<div class="col-xs-6">
						<button class="btn bg-teal-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$verified?></b></i> <span>Verified<br>Order</span></button>
						<br>
					</div>

					<div class="col-xs-6">
						<button class="btn bg-warning-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$denyorder?></b></i> <span>Denied<br>Order</span></button>
						<br>
					</div>

					<div class="col-xs-6">
						<button class="btn bg-teal-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$verification?></b></i> <span>Send<br>Supply</span></button>
						<br>
					</div>

					<div class="col-xs-6">
						<button class="btn bg-warning-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$deniedsupply?></b></i> <span>Denied<br>Supply	</span></button>
						<br>
					</div>
					<div class="col-xs-6">
						<button class="btn bg-teal-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$confirm?></b></i> <span>Verified<br>Supply</span></button>
						<br>
					</div>
					<div class="col-xs-6">
						<button class="btn bg-warning-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$declinedsupply?></b></i> <span>Declined<br>Supply	</span></button>
						<br>
					</div>
					<div class="col-xs-6">
						<button class="btn bg-success-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$confirmed?></b></i> <span>Cofirmed<br>Request	</span></button>
						<br>
					</div>
					<div class="col-xs-6">
						<button class="btn bg-danger-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$rejectrequest?></b></i> <span>Rejected<br>Request	</span></button>
						<br>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>

	</div>
</div>
