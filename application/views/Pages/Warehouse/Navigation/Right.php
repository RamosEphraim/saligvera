<div class="sidebar sidebar-opposite sidebar-default">
	<div class="sidebar-content">
		
		<?php if ($nav == 'Supply Lists') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Add New Supply</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<?=form_open('Warehouse/Supply/add')?>
					<div class="form-group">
						<label>Item:</label>
						<input type="text" class="form-control" name="item" value="<?php echo set_value('item'); ?>">
						<?=form_error('item', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Description:</label>
						<input type="text" class="form-control" name="description" value="<?php echo set_value('description'); ?>">
						<?=form_error('description', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Quantity:</label>
						<input type="text" class="form-control" name="quantity" value="<?php echo set_value('quantity'); ?>">
						<?=form_error('quantity', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Unit:</label>
						<select class="form-control" name="unit">
							<option value="">--Select Unit--</option>
							<option value="Bags">Bags</option>
							<option value="Bottles">Bottles</option>
							<option value="Boxed">Boxed</option>
							<option value="Can">Can</option>
							<option value="Gal">Gal</option>
							<option value="KLS">KLS</option>
							<option value="Meters">Meters</option>
							<option value="Pairs">Pairs</option>
							<option value="PCS">PCS</option>
							<option value="Rolls">Rolls</option>
							<option value="Sets">Sets</option>
							<option value="Sheets">Sheets</option>
							
						</select>
						<?=form_error('unit', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Supplier:</label>
						<input type="text" class="form-control" name="supplier" value="<?php echo set_value('supplier'); ?>">
						<?=form_error('supplier', '<small class="text-danger">', '</small>');?>
					</div>
					
					<div class="text-right">
						<button type="submit" name="btn-addSupply" class="btn btn-primary btn-sm" style="border-radius: 0px;">Submit <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				<?=form_close()?>
			</div>
		</div>
		<?php } elseif ($nav == 'Edit Supply') { ?>
		<div class="sidebar-category">
			<div class="category-title bg-blue">
				<span>Edit Supply</span>
				<ul class="icons-list">
					<li><a href="#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content">
				<?=form_open('Warehouse/Supply/Edit/update/'.$edit['supply_id'])?>
					<div class="form-group">
						<label>Item:</label>
						<input type="text" class="form-control" name="item" value="<?=$edit['item']?>">
						<?=form_error('item', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Description:</label>
						<input type="text" class="form-control" name="description" value="<?=$edit['description']?>">
						<?=form_error('description', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Quantity:</label>
						<input type="text" class="form-control" name="quantity" value="<?=$edit['stocks']?>">
						<?=form_error('quantity', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Unit:</label>
						
						<select class="form-control" name="unit">
						    <option value="">--Select Unit--</option>
							<option value="Bags" <?=$edit['unit'] == 'Bags' ? 'selected' : ''?>>Bags</option>
							<option value="Bottles" <?=$edit['unit'] == 'Bottles' ? 'selected' : ''?>>Bottles</option>
							<option value="Boxed" <?=$edit['unit'] == 'Boxed' ? 'selected' : ''?>>Boxed</option>
							<option value="Can" <?=$edit['unit'] == 'Can' ? 'selected' : ''?>>Can</option>
							<option value="Gal" <?=$edit['unit'] == 'Gal' ? 'selected' : ''?>>Gal</option>
							<option value="KLS" <?=$edit['unit'] == 'KLS' ? 'selected' : ''?>>KLS</option>
							<option value="Meters" <?=$edit['unit'] == 'Meters' ? 'selected' : ''?>>Meters</option>
							<option value="Pairs" <?=$edit['unit'] == 'Pairs' ? 'selected' : ''?>>Pairs</option>
							<option value="PCS" <?=$edit['unit'] == 'PCS' ? 'selected' : ''?>>PCS</option>
							<option value="Rolls" <?=$edit['unit'] == 'Rolls' ? 'selected' : ''?> >Rolls</option>
							<option value="Sets" <?=$edit['unit'] == 'Sets' ? 'selected' : ''?>>Sets</option>
							<option value="Sets" <?=$edit['unit'] == 'Sheets' ? 'selected' : ''?>>Sheets</option>
							
							
							
						</select>
						<?=form_error('unit', '<small class="text-danger">', '</small>');?>
					</div>

					<div class="form-group">
						<label>Supplier:</label>
						<input type="text" class="form-control" name="supplier" value="<?=$edit['supplier']?>">
						<?=form_error('supplier', '<small class="text-danger">', '</small>');?>
					</div>
					
					<div class="text-right">
						<button type="submit" name="btn-editSupply" class="btn btn-primary btn-sm" style="border-radius: 0px;">Submit <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				<?=form_close()?>
			</div>
		</div>
		<?php } elseif($nav == 'Order') { ?>
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
