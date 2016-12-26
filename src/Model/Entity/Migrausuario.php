<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Migrausuario Entity
 *
 * @property int $id
 * @property string $dni
 * @property string $sexo
 * @property string $nombre
 * @property string $apellidos
 * @property string $telefono
 * @property string $otrosdatos
 * @property string $numedis
 * @property string $observaciones
 * @property string $relacion
 * @property \Cake\I18n\Time $nacimineto
 * @property string $nacionalidad
 */
class Migrausuario extends Entity
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
