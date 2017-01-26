<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Informe Entity
 *
 * @property int $id
 * @property string $antecedentes
 * @property string $situacion
 * @property string $pii
 * @property string $valoracion
 * @property string $propuesta
 * @property int $user_id
 * @property \Cake\I18n\Time $fecha
 * @property string $estado
 * @property int $expediente_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Expediente $expediente
 */
class Informe extends Entity
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
