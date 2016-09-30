<?php
namespace App\Model\Table;

use App\Model\Entity\Tecnico;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tecnicos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Equipos
 * @property \Cake\ORM\Association\HasMany $Roles
 */
class TecnicosTable extends Table
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

        $this->table('tecnicos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Equipos', [
            'foreignKey' => 'equipo_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Roles', [
            'foreignKey' => 'tecnico_id'
        ]);
        $this->hasMany('Asistentecomisions', [
            'foreignKey' => 'tecnico_id'
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
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->requirePresence('apellidos', 'create')
            ->notEmpty('apellidos');

        $validator
            ->requirePresence('puesto', 'create')
            ->notEmpty('puesto');

        //$validator
            //->email('email');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['equipo_id'], 'Equipos'));
        return $rules;
    }
}
