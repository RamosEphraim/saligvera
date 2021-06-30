<div class="sidebar sidebar-opposite sidebar-default">
	<div class="sidebar-content">
		
		
		<?php if ($nav == 'Order') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Order Reports</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<div class="row">
					<div class="col-xs-12">
						<button class="btn bg-blue-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$today?></b></i> <span>Today</span></button>
						<br>
					</div>
					<div class="col-xs-6">
						<button class="btn bg-success-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$verified?></b></i> <span>Verified</span></button>
						<br>
					</div>
					<div class="col-xs-6">
						<button class="btn bg-danger-400 btn-block btn-float btn-float-lg" style="cursor: default;"><i><b><?=$denied?></b></i> <span>Denied</span></button>
						<br>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>

	</div>
</div>
