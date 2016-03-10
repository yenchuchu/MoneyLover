<?php

App::uses('AppModel', 'Model');
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');

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

        $idIncome = Hash::extract($categorie, '{n}.Categorie[type=1].id');
        $idExpense = Hash::extract($categorie, '{n}.Categorie[type=0].id');

        $transactionsIncomes = $this->find('all', array('conditions' => array('Categorie.id IN' => $idIncome)));
        $transactionsExpenses = $this->find('all', array('conditions' => array('Categorie.id IN' => $idExpense)));
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
        foreach ($months as $month) {
            $percentExpense[$month] = ($outputExpense[$month] * 100) / ($outputExpense[$month] + $outputIncome[$month]);
            $percentIncome[$month] = ($outputIncome[$month] * 100) / ($outputExpense[$month] + $outputIncome[$month]);
            $percentMonth[$month] = [
                ['value' => round($percentExpense[$month], 2), 'color' => '#FF8153', 'label' => 'Expense'],
                ['value' => round($percentIncome[$month], 2), 'color' => '#4ACAB4', 'label' => 'Income']
            ];
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
        foreach ($months as $month) {
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

            for ($i = 0; $i < $countCategoryMonth[$month]; $i++) {
                $percentMonthCategory[$month][$categoriesMonths[$month][$i]] = ( $sumMoneyMonths[$month][$categoriesMonths[$month][$i]] * 100) / $sumTotalMonths[$month];

                // $percentMonthCategory[$month][$categoriesMonths[$month][$i]]  = $this->Number->format($percentMonthCategory[$month][$categoriesMonths[$month][$i]]  , array(
                // 								'places' => 2));
                // echo $percentMonthCategory[$month][$categoriesMonths[$month][$i]];
                if (!isset($percentCategory[$month][$i])) {
                    $percentCategory[$month][$i] = ['value' => round($percentMonthCategory[$month][$categoriesMonths[$month][$i]], 2),
                                'color' => '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)],
                                'label' => $nameCategoryId[$categoriesMonths[$month][$i]]];
                }
            }
        }
        return $percentCategory;
    }

}
