<?php

App::uses('AppModel', 'Model');
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');

App::import('Model', 'Wallet');
App::import('Model', 'User');

/**
 * Transaction Model
 *
 * @property Categorie $Categorie
 * @property Wallet $Wallet
 */
class Transaction extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'categorie_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'wallet_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'transaction_date' => array(
            'datetime' => array(
                'rule' => array('datetime'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'transaction_money' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Categorie' => array(
            'className' => 'Categorie',
            'foreignKey' => 'categorie_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Wallet' => array(
            'className' => 'Wallet',
            'foreignKey' => 'wallet_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function getReportFollowType($walletId) {
        $categorie = $this->Categorie->find('all');

        $idIncome = Hash::extract($categorie, '{n}.Categorie[type=0].id');
        $idExpense = Hash::extract($categorie, '{n}.Categorie[type=1].id');

        $transactionsIncomes = $this->find('all', array(
            'conditions' => array(
                'Categorie.id IN' => $idIncome,
                'Wallet.id IN' => $walletId
                )));
        $transactionsExpenses = $this->find('all', array(
            'conditions' => array(
                'Categorie.id IN' => $idExpense,
                'Wallet.id IN' => $walletId)));
        $transactions = $this->find('all', array('conditions' => array('Wallet.id IN' => $walletId)));

        $outputMonthTransactions = array();
        $i = 0;
        foreach ($transactions as $key => $transaction) {
            if (!isset($outputMonthTransactions[$i])) {
                $outputMonthTransactions[$i] = date('Y-m', strtotime($transaction['Transaction']['day_transaction']));
            }
            $i++;
        }

        $months = array_unique($outputMonthTransactions);
        rsort($months);

        $outputIncome = array();
        foreach ($transactionsIncomes as $key => $transactionIncome) {
            if (!isset($outputIncome[date('Y-m', strtotime($transactionIncome['Transaction']['day_transaction']))])) {
                $outputIncome[date('Y-m', strtotime($transactionIncome['Transaction']['day_transaction']))] = $transactionIncome['Transaction']['transaction_money'];
            } else {
                $outputIncome[date('Y-m', strtotime($transactionIncome['Transaction']['day_transaction']))] += $transactionIncome['Transaction']['transaction_money'];
            }
        }
        
        $outputExpense = array();
        foreach ($transactionsExpenses as $key => $transactionExpense) {
            if (!isset($outputExpense[date('Y-m', strtotime($transactionExpense['Transaction']['day_transaction']))])) {
                $outputExpense[date('Y-m', strtotime($transactionExpense['Transaction']['day_transaction']))] = $transactionExpense['Transaction']['transaction_money'];
            } else {
                $outputExpense[date('Y-m', strtotime($transactionExpense['Transaction']['day_transaction']))] += $transactionExpense['Transaction']['transaction_money'];
            }
        }
        
        $i = 0;
        $percentMonth = array();
        $toalMoney = array();
        
        foreach ($months as $month) {
            if(!isset($outputExpense[$month])) {
                $outputExpense[$month]= 0;
            }
            if(!isset($outputIncome[$month])) {
                $outputIncome[$month] = 0;
            }
            
            $toalMoney = $outputExpense[$month] + $outputIncome[$month];
            if ($toalMoney == 0) {
                return false;
            } else {
                $percentExpense[$month] = ($outputExpense[$month] * 100) / $toalMoney;
                $percentIncome[$month] = ($outputIncome[$month] * 100) / $toalMoney;
                $percentMonth[$month] = [
                    ['value' => round($percentExpense[$month], 2), 'color' => '#FF8153', 'label' => 'Expense'],
                    ['value' => round($percentIncome[$month], 2), 'color' => '#4ACAB4', 'label' => 'Income']
                    ];
            }
        }
        return $percentMonth;
    }

    public function getReportFollowCategories($walletId) {
        $transactions = $this->find('all', array('conditions' => array('wallet_id' => $walletId,
                'Categorie.id is not null')));
        $allCategories = $this->Categorie->find('all');
        $nameCategoryId = Set::combine($allCategories, '{n}.Categorie.id', '{n}.Categorie.name');
        $categoryId = Set::classicExtract($allCategories, '{n}.Categorie.id');
        $groupByCategories = $this->find('all', array('conditions' => array('wallet_id' => $walletId,
                'categorie_id' => $categoryId)
            , 'fields' => array('Transaction.transaction_money',
                'Transaction.day_transaction as month',
                'Transaction.categorie_id'),
            'order' => array('Transaction.day_transaction' => 'asc')
        ));

        $outputMonthCategories = array();
        $i = 0;
        foreach ($groupByCategories as $groupByCategorie) {
            if (!isset($outputMonthCategories[$i])) {
                $outputMonthCategories[$i] = date('Y-m', strtotime($groupByCategorie['Transaction']['month']));
            }
            $i++;
        }

        $months = array_unique($outputMonthCategories);
        sort($months);

        $totalMoneyMonth = array();
        $i = 0;
        foreach ($months as $month) {

            foreach ($groupByCategories as $groupByCategorie) {
                if (!isset($totalMoneyMonth[$month]) && date('Y-m', strtotime($groupByCategorie['Transaction']['month'])) === $month) {
                    $totalMoneyMonth[$month] = $groupByCategorie['Transaction']['transaction_money'];
                } elseif (isset($totalMoneyMonth[$month]) && date('Y-m', strtotime($groupByCategorie['Transaction']['month'])) === $month) {
                    $totalMoneyMonth[$month] += $groupByCategorie['Transaction']['transaction_money'];
                }
            }
        }

        $sumMoneyMonths = array();
        $sumTotalMonths = array();
        $outputCategories = array();

        $i = 0;
        foreach ($groupByCategories as $groupByCategorie) {
            foreach ($months as $month) {
                if (date('Y-m', strtotime($groupByCategorie['Transaction']['month'])) === $month) {
                    if (!isset($outputCategories[$month][$i])) {
                        $outputCategories[$month][$i] = $groupByCategorie['Transaction']['categorie_id'];
                    }
                    if (!isset($sumMoneyMonths[$month][$outputCategories[$month][$i]])) {
                        $sumMoneyMonths[$month][$outputCategories[$month][$i]] = $groupByCategorie['Transaction']['transaction_money'];
                    } else {
                        $sumMoneyMonths[$month][$outputCategories[$month][$i]] += $groupByCategorie['Transaction']['transaction_money'];
                    }

                    if (!isset($sumTotalMonths[$month])) {
                        $sumTotalMonths[$month] = $groupByCategorie['Transaction']['transaction_money'];
                    } else {
                        $sumTotalMonths[$month] += $groupByCategorie['Transaction']['transaction_money'];
                    }
                }
            }
            $i++;
        }

        $categoriesMonths = array();
        foreach ($months as $month) {
            $categoriesMonths[$month] = array_unique($outputCategories[$month]);
            sort($categoriesMonths[$month]);
        }

        $countCategoryMonth = array();
        foreach ($months as $month) {
            $countCategoryMonth[$month] = count($sumMoneyMonths[$month]);
        }

        $percentMonthCategory = array();
        $percentCategory = array();
        rsort($months);
        $color = array('#B1B92C', '#E8BF4F', '#22D065', '#A058E9', '#FB9734', '#EAEDEA',
            '#DEC3D5', '#A8A749', '#E7209C', '#E4A8AF', '#7E2960', '#BEEE20',
            '#660040', '#84FAD0', '#B96271', '#84F749', '#FBDBCA', '#B82754');

        foreach ($months as $month) {
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

            for ($i = 0; $i < $countCategoryMonth[$month]; $i++) {
                if ($sumTotalMonths[$month] == 0) {
                    return false;
                } else {
                    $percentMonthCategory[$month][$categoriesMonths[$month][$i]] = ( $sumMoneyMonths[$month][$categoriesMonths[$month][$i]] * 100) / $sumTotalMonths[$month];
                    if (!isset($percentCategory[$month][$i])) {
                        $percentCategory[$month][$i] = ['value' => round($percentMonthCategory[$month][$categoriesMonths[$month][$i]], 2),
                            'color' => $color[$i],
                            'label' => $nameCategoryId[$categoriesMonths[$month][$i]]];
                    }
                }
            }
        }
        return $percentCategory;
    }

    public function getMoneyGroupByCategories($walletId, $categoryId) {
        $moneyGroupByCategories = $this->find('all', array('conditions' => array('wallet_id' => $walletId,
                'categorie_id' => $categoryId),
            'fields' => array('sum(Transaction.transaction_money) as total_money',
                'month(Transaction.day_transaction) as month',
                'Transaction.categorie_id'),
            'order' => array('month(Transaction.day_transaction)' => 'asc'),
            'group' => array('Transaction.categorie_id')));
        return $moneyGroupByCategories;
    }

    public function getMonthTransaction($walletId) {
        $transactions = $this->find('all', array('conditions' => array('Wallet.id IN' => $walletId)));
        $outputMonthTransactions = array();
        $i = 0;
        if (!empty($transactions)) {
            foreach ($transactions as $key => $transaction) {
                if (!isset($outputMonthTransactions[$i])) {
                    $outputMonthTransactions[$i] = date('Y-m', strtotime($transaction['Transaction']['day_transaction']));
                }
                $i++;
            }
        }

        return $monthTransaction;
    }

    public function findAllTransactionsAuth($walletId) {
        $allTransactionsAuth = $this->find('all', array('conditions' => array('Wallet.id IN' => $walletId)));
        return $allTransactionsAuth;
    }

    public function findAllCategory() {
        $allCategories = $this->Categorie->find('all');
        return $allCategories;
    }

    public function findListCategory() {
        $listCategories = $this->Categorie->find('list');
        return $listCategories;
    }

    public function findIdCategory($categoryId) {
        $idCategories = $this->Categorie->find('list', array('conditions' => array('id' => $categoryId)));
        return $idCategories;
    }

    public function findListWallet() {
        $listWallet = $this->Wallet->find('list');
        return $listWallet;
    }

    public function findIdWalletAuth($walletId) {
        $wallets = $this->Wallet->find('list', array('conditions' => array('id' => $walletId)));
        return $wallets;
    } 
    
    public function getIncomeCategory($walletId) {
        $incomeCategories = $this->Categorie->find('list', array('fields' => 'id', 'conditions' => array('type' => '0')));
        $incomeTransactions = $this->find('all', array(
            'fields' => array('sum(Transaction.transaction_money) as money',
                'Wallet.id',
                'Wallet.money_current',
                'Wallet.money_initialize'),
            'conditions' => array('categorie_id' => $incomeCategories,
                'wallet_id' => $walletId)));
        return $incomeTransactions;
    }

    public function getExpenseCategory($walletId) {
        $expenseCategories = $this->Categorie->find('list', array('fields' => 'id', 'conditions' => array('type' => '1')));
        $expenseTransactions = $this->find('all', array(
            'fields' => array('sum(Transaction.transaction_money) as money',
                'Wallet.id',
                'Wallet.money_current',
                'Wallet.money_initialize'),
            'conditions' => array('categorie_id' => $expenseCategories,
                'wallet_id' => $walletId)));
        return $expenseTransactions;
    }
    
    public function getTypeCategory($categoryId) {
        $typeCategorie = $this->Categorie->find('list', array('fields' => 'type', 'conditions' => array('id' => $categoryId)));
        return $typeCategorie;
    }
    
    public function getAllCategoriesIncome() {
        $idCategoriesIncome = $this->Categorie->find('list', array('conditions' => array('type' => 0)));
        return $idCategoriesIncome;
    }

    public function getAllCategoriesExpense() {
        $idCategoriesExpense = $this->Categorie->find('list', array('conditions' => array('type' => 1)));
        return $idCategoriesExpense;
    }

    public function getWalletById($walletId) {
        $walletModel = new Wallet();
        $return_wallet = $walletModel->find('all', array(
                        'conditions' => array(
                                'Wallet.id' => $walletId)));
        return $return_wallet;
    }
    
    public function getTransactionById($transactionId) {
        $return_transaction = $this->query(" select * from transactions where id = $transactionId");
//                                'Transaction.id' => $transactionId)));
        return $return_transaction;
    }
    
    public function getWalletByTransactionId($transactionId) {
        $transaction = $this->find('all', array(
                        'conditions' => array(
                                'Transaction.id' => $transactionId)));
        $wallet = $transaction[0]['Wallet'];
        return $wallet;
    }
    
     public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }
}

// '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)]
