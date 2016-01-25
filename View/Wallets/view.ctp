<div class="wallets view">
<h2><?php echo __('Wallet'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($wallet['User']['name'], array('controller' => 'users', 'action' => 'view', $wallet['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Info'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['info']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Money Current'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['money_current']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($wallet['Wallet']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Wallet'), array('action' => 'edit', $wallet['Wallet']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Wallet'), array('action' => 'delete', $wallet['Wallet']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $wallet['Wallet']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Wallets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Wallet'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('controller' => 'transactions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Transactions'); ?></h3>
	<?php if (!empty($wallet['Transaction'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Categorie Id'); ?></th>
		<th><?php echo __('Wallet Id'); ?></th>
		<th><?php echo __('Transaction Date'); ?></th>
		<th><?php echo __('Transaction Money'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($wallet['Transaction'] as $transaction): ?>
		<tr>
			<td><?php echo $transaction['id']; ?></td>
			<td><?php echo $transaction['categorie_id']; ?></td>
			<td><?php echo $transaction['wallet_id']; ?></td>
			<td><?php echo $transaction['transaction_date']; ?></td>
			<td><?php echo $transaction['transaction_money']; ?></td>
			<td><?php echo $transaction['created']; ?></td>
			<td><?php echo $transaction['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'transactions', 'action' => 'view', $transaction['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'transactions', 'action' => 'edit', $transaction['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'transactions', 'action' => 'delete', $transaction['id']), array('confirm' => __('Are you sure you want to delete # %s?', $transaction['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Transaction'), array('controller' => 'transactions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
