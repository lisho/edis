<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pasacomision Entity.
 *
 * @property int $id
 * @property string $motivo
 * @property string $clasificacion
 * @property bool $diligencia
 * @property bool $informeedis
 * @property string $observaciones
 * @property int $expediente_id
 * @property \App\Model\Entity\Expediente $expediente
 * @property int $comision_id
 * @property \App\Model\Entity\Comision $comision
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Pasacomision extends Entity
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
