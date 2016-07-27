<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Expediente Entity.
 *
 * @property int $id
 * @property string $numedis
 * @property string $numrgc
 * @property string $domicilio
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Participante[] $participantes
 * @property \App\Model\Entity\Role[] $roles
 */
class Expediente extends Entity
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
