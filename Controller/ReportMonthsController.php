<?php

App::uses('AppController', 'Controller');

/**
 * Report Month Controller
 *
 * @property Transaction $Transaction
 * @property PaginatorComponent $Paginator
 */
class ReportMonthsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {

        $this->loadModel('User');
        $this->loadModel('Wallet');
        $this->loadModel('Transaction');
        $this->loadModel('Category');

        $id_auth = $this->Auth->user('id');
        
        $aaacategories = $this->Transaction->Categorie->find('all');
        $result_categorie_id = Set::classicExtract($aaacategories, '{n}.Categorie.id');

        $tests = $this->User->query(
                "select wallets.user_id, wallets.id from wallets 
            inner join users on users.id = wallets.user_id where users.id = '$id_auth'");
        $result = Set::classicExtract($tests, '{n}.wallets.id');

        $wallets = $this->Transaction->Wallet->find('list', array('conditions' => array('id' => $result)));
        if(!empty($wallets)){
            $categories = $this->Transaction->Categorie->find('list', array('conditions' => array('id' => $result_categorie_id)));

            $this->set(compact('categories', 'wallets', 'transactions'));
            $this->set('showLayoutContent', true);

            $groupByCategories = $this->Transaction->find('all', array('conditions' => array('wallet_id' => $result,
                    'categorie_id' => $result_categorie_id),
                'fields' => array('sum(Transaction.transaction_money) as total_money',
                    'month(Transaction.day_transaction) as month',
                    'Transaction.categorie_id'),
                'order' => array('month(Transaction.day_transaction)' => 'asc'),
                'group' => array('Transaction.categorie_id')));

            $totalMoneyMonth = $this->Transaction->find('all', array('conditions' => array('wallet_id' => $result,
                    'categorie_id' => $result_categorie_id),
                'fields' => array('sum(transaction_money) as total_money_month', 'month(Transaction.day_transaction)'),
                'group' => 'month(Transaction.day_transaction)'));
        
            $transactions = $this->Transaction->find('all', array('conditions' => array('Wallet.id IN' => $result)));
           
            $outputMonthTransactions = array();
            $i = 0;
            if(!empty($transactions)){
                foreach ($transactions as $key => $transaction) {
                    if (!isset($outputMonthTransactions[$i])) {
                        $outputMonthTransactions[$i] = date('Y-m', strtotime($transaction['Transaction']['day_transaction']));
                    }
                    $i++;
                }

                $months = array_unique($outputMonthTransactions);
                rsort($months); 
                $this->set('months', $months);
                $this->set('pieData', $this->Transaction->getReportFollowType($result));
                $this->set('pieDataCategories', $this->Transaction->getReportFollowCategories($result));
            }  
        }
    }
}
