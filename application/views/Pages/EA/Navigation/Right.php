<div class="sidebar sidebar-opposite sidebar-default">
	<div class="sidebar-content">
		
		
		<?php if ($nav == 'Project') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Project Workers</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<?php foreach ($workers as $row): ?>
					<div class="form-group">
						<div class="media-left media-middle">
								<img src="<?=base_url()?>assets/uploads/<?=$row->worker_img?>" class="img-circle img-md" alt="">
						</div>
						<div class="media-body">
							<div class="media-heading text-semibold"><?=$row->name?></div>
							<label class="label label-primary"><span><?=$row->position?></span></label>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		<?php } ?>

	</div>
</div>
