<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Transfer Wallet'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transferWallets index large-9 medium-8 columns content">
    <h3><?= __('Transfer Wallets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('transfer_money') ?></th>
                <th><?= $this->Paginator->sort('sent_wallet_id') ?></th>
                <th><?= $this->Paginator->sort('receive_wallet_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transferWallets as $transferWallet): ?>
            <tr>
                <td><?= $this->Number->format($transferWallet->id) ?></td>
                <td><?= $this->Number->format($transferWallet->transfer_money) ?></td>
                <td><?= $this->Number->format($transferWallet->sent_wallet_id) ?></td>
                <td><?= $this->Number->format($transferWallet->receive_wallet_id) ?></td>
                <td><?= h($transferWallet->created) ?></td>
                <td><?= h($transferWallet->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $transferWallet->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $transferWallet->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $transferWallet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transferWallet->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
