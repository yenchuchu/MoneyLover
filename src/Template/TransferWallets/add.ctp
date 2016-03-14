<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Transfer Wallets'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="transferWallets form large-9 medium-8 columns content">
    <?= $this->Form->create($transferWallet) ?>
    <fieldset>
        <legend><?= __('Add Transfer Wallet') ?></legend>
        <?php
            echo $this->Form->input('transfer_money');
            echo $this->Form->input('sent_wallet_id');
            echo $this->Form->input('receive_wallet_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
