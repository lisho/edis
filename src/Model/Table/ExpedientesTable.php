<?php
namespace App\Model\Table;

use App\Model\Entity\Expediente;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Expedientes Model
 *
 * @property \Cake\ORM\Association\HasMany $Participantes
 * @property \Cake\ORM\Association\HasMany $Roles
 */
class ExpedientesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('expedientes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Participantes', [
            'foreignKey' => 'expediente_id'
        ]);
        $this->hasMany('Roles', [
            'foreignKey' => 'expediente_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('numedis', 'create')
            ->notEmpty('numedis');

        $validator
            ->requirePresence('numrgc', 'create')
            ->notEmpty('numrgc');

        $validator
            ->requirePresence('domicilio', 'create')
            ->notEmpty('domicilio');

        return $validator;
    }
}
