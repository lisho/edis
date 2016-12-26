<?php
namespace App\Model\Table;

use App\Model\Entity\Asistentecomision;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Asistentecomisions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Comisions
 * @property \Cake\ORM\Association\BelongsTo $Tecnicos
 */
class AsistentecomisionsTable extends Table
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

        $this->table('asistentecomisions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Comisions', [
            'foreignKey' => 'comision_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tecnicos', [
            'foreignKey' => 'tecnico_id',
            'joinType' => 'INNER'
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
            ->requirePresence('rol', 'create')
            ->notEmpty('rol');

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
        $rules->add($rules->existsIn(['comision_id'], 'Comisions'));
        $rules->add($rules->existsIn(['tecnico_id'], 'Tecnicos'));
        return $rules;
    }
}
