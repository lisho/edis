<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Migraactuacione Entity
 *
 * @property int $id
 * @property int $id_antiguo
 * @property \Cake\I18n\Time $fecha
 * @property string $descripcion
 * @property string $dni
 * @property string $numedis
 * @property string $nombre
 * @property string $apellidos
 * @property string $actuacion
 */
class Migraactuacione extends Entity
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
