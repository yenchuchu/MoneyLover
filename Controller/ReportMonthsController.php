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
        
        $findAllCategories = $this->Transaction->findAllCategory();
        $result_categorie_id = Set::classicExtract($findAllCategories, '{n}.Categorie.id');

        $findWallet = $this->User->findWalletAuth($id_auth);
        $result_wallet_id = Set::classicExtract($findWallet, '{n}.wallets.id');
        
        $year = $this->request->query('year_start');
//        debug($year);die;
        
        $wallets = $this->Transaction->findIdWalletAuth($result_wallet_id); 
        if(!empty($wallets)){
            $categories = $this->Transaction->findIdCategory($result_categorie_id);

            $this->set(compact('categories', 'wallets', 'transactions'));
            $this->set('showLayoutContent', true);

            $groupByCategories = $this->Transaction->getMoneyGroupByCategories($result_wallet_id, $result_categorie_id); 
        
            $transactions = $this->Transaction->findAllTransactionsAuth($result_wallet_id);
           
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
                $this->set('pieData', $this->Transaction->getReportFollowType($result_wallet_id));
                $this->set('pieDataCategories', $this->Transaction->getReportFollowCategories($result_wallet_id));
            }  
        }
    }
}
