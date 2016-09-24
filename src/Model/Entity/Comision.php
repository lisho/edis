<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comision Entity.
 *
 * @property int $id
 * @property \Cake\I18n\Time $fecha
 * @property string $tipo
 * @property string $observaciones
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Asistentecomision[] $asistentecomisions
 * @property \App\Model\Entity\Pasacomision[] $pasacomisions
 */
class Comision extends Entity
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
