<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Prestacion Entity
 *
 * @property int $id
 * @property string $numprestacion
 * @property int $prestaciontipo_id
 * @property \Cake\I18n\Time $apertura
 * @property \Cake\I18n\Time $cierre
 * @property int $expediente_id
 * @property int $participante_id
 * @property int $prestacionestado_id
 * @property string $observaciones
 * @property int $created
 * @property int $modified
 *
 * @property \App\Model\Entity\Prestaciontipo $prestaciontipo
 * @property \App\Model\Entity\Expediente $expediente
 * @property \App\Model\Entity\Participante $participante
 * @property \App\Model\Entity\Prestacionestado $prestacionestado
 */
class Prestacion extends Entity
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
