<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TransferWallet Entity.
 *
 * @property int $id
 * @property float $transfer_money
 * @property int $sent_wallet_id
 * @property \App\Model\Entity\SentWallet $sent_wallet
 * @property int $receive_wallet_id
 * @property \App\Model\Entity\ReceiveWallet $receive_wallet
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class TransferWallet extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
