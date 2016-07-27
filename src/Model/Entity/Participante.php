<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Participante Entity.
 *
 * @property int $id
 * @property string $dni
 * @property string $nombre
 * @property string $apellidos
 * @property \Cake\I18n\Time $nacimiento
 * @property string $sexo
 * @property string $telefono
 * @property string $email
 * @property int $expediente_id
 * @property \App\Model\Entity\Expediente $expediente
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Participante extends Entity
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
