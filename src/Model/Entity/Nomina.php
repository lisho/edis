<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Nomina Entity
 *
 * @property int $id
 * @property string $CCLL
 * @property string $CEAS
 * @property string $HS
 * @property string $RGC
 * @property string $CLASIFICACION
 * @property string $MIEMBROS
 * @property string $dni
 * @property string $nombrecompleto
 * @property string $SEXO
 * @property string $EDAD
 * @property string $NACIONALIDAD
 * @property string $DOMICILIO
 * @property \Cake\I18n\Time $fechatramite
 * @property string $RESOLUCION
 * @property \Cake\I18n\Time $fechaefectos
 * @property string $relacion
 * @property string $fechanomina
 */
class Nomina extends Entity
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
