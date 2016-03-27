<?php echo $this->Flash->render('positive') ?>

<?php echo $this->element('menu_user'); ?>
<!-- Contact Section -->
<section id="wallet" class="content-section text-center">
    
    <span >
        <h1 id="title-h1">My Wallets</h1> 
    </span> 
    <span> 
        <p> Total money current: <?php echo $this->Number->currency($sumMoneyCurrent, ' VND', $options = array('thousands' => '.',
        'wholePosition' => 'after', 'places' => 0
    )); ?> </p>
    </span>
    <a href="#add-wallet" id="a-add-wallet"> Add Wallet</a> 
    <div class="row">
        <?php if(empty($wallets)) {
                echo "<p>No wallet</p>";
            } ?>
        <?php foreach ($wallets as $wallet): ?>  
            <div class="col-lg-5 ">
                <h2 class="name-wallet">
    <?php echo h($wallet['Wallet']['name']); ?> 
                </h2>

                <span class="wallet-info"><i class="fa fa-smile-o"></i> Wallet Info:</span>
                <p class="content-wallet-info">
                    <i>
                        <?php
                        if ($wallet['Wallet']['info'] == NULL) {
                            echo "--No description--";
                        } else
                            echo h($wallet['Wallet']['info']);
                        ?> <br> 
                    </i>
                </p>
                
                <span class="wallet-current-money"><i class="fa fa-money"></i> money_initialize: </span>
                <p style="text-align: left;"> 
    <?php
    echo $this->Number->currency($wallet['Wallet']['money_initialize'], ' VND', $options = array('thousands' => '.',
        'wholePosition' => 'after', 'places' => 0
    ));
    ?> </p>
                <span class="wallet-current-money"><i class="fa fa-money"></i> Current money: </span>
                <p style="text-align: left;"> 
    <?php
    echo $this->Number->currency($wallet['Wallet']['money_current'], ' VND', $options = array('thousands' => '.',
        'wholePosition' => 'after', 'places' => 0
    ));
    ?> </p>
                <span class="time-active-wallet">
                    <i> 
                        <span class="time-create-wallet"> Create:    &nbsp; <?php echo $this->Time->format($wallet['Wallet']['created'], '%B %e, %Y'); ?> </span> <br>
                        <span class="time-modified-wallet"> Modified:  &nbsp;  <?php echo $this->Time->format($wallet['Wallet']['modified'], '%B %e, %Y'); ?> </span>
                    </i>
                </span>
                <div class="action-wallet"> 
                    <?php echo $this->Html->link('Edit', array('action' => 'edit', $wallet['Wallet']['id']), array('class'=>'edit-wallet')); ?> 

                     <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $wallet['Wallet']['id']), array('class'=>'delete-wallet'), array('confirm' => __('Are you sure you want to delete # %s?', $wallet['Wallet']['id']))); ?> 
                </div>
            </div>
<?php endforeach; ?>
    </div>
</section> 
<div id="add-wallet" class="modalDialog">      
    <div class="login-panel panel panel-default" style="margin-top: 6% !important; ">
        <div class="panel-heading">
            <h3 class="panel-title">Add Wallet</h3>
        </div> 
        <div class="panel-body" style="color: black;">
            <form action="/MoneyLover/wallets/add" id="CategoryAddForm" method="post" accept-charset="utf-8">
                <div style="display:none;"><input type="hidden" name="_method" value="POST"></div> 
                <div class="form-group">
                    <label class="control-label" for="CategoryName">Wallet Name:</label>
                    <input name="data[Wallet][name]" class="form-control" placeholder="Wallet Name" maxlength="64" type="text" id="WalletName" required="required">
                </div>
                
                <div class="form-group" style="height: 60px;">
                    <label class="control-label" for="CategoryName">money_initialize:</label>
                    <input name="data[Wallet][money_initialize]" step="any" type="number" class="form-control" placeholder="Wallet money_initialize" id="WalletMoneyCurrent" required="required">

                </div> 
                <div class="form-group">
                    <label class="control-label" for="CategoryName">Info Wallet:</label>
                    <input name="data[Wallet][info]"  class="form-control" placeholder="Wallet Name" maxlength="500" type="text" id="WalletInfo">
                </div>
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10 submit-wallet"> 
                        <a href="#close"  class="btn wallet-save ">Cancel</a>
                        <button type="submit" class="btn wallet-save">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /#add-Wallet --> 
