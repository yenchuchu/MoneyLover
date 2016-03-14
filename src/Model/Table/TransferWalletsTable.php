<?php
namespace App\Model\Table;

use App\Model\Entity\TransferWallet;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TransferWallets Model
 *
 * @property \Cake\ORM\Association\BelongsTo $SentWallets
 * @property \Cake\ORM\Association\BelongsTo $ReceiveWallets
 */
class TransferWalletsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('transfer_wallets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SentWallets', [
            'foreignKey' => 'sent_wallet_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ReceiveWallets', [
            'foreignKey' => 'receive_wallet_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->numeric('transfer_money')
            ->requirePresence('transfer_money', 'create')
            ->notEmpty('transfer_money');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['sent_wallet_id'], 'SentWallets'));
        $rules->add($rules->existsIn(['receive_wallet_id'], 'ReceiveWallets'));
        return $rules;
    }
}
