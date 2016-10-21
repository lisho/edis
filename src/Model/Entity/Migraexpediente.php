<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Migraexpediente Entity
 *
 * @property int $id
 * @property string $rgc
 * @property string $numedis
 * @property string $tedis
 * @property string $cc
 * @property string $ceas
 * @property \Cake\I18n\Time $alta
 * @property \Cake\I18n\Time $baja
 * @property string $domicilio
 */
class Migraexpediente extends Entity
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
        'id' => false
    ];
}
