<?php
namespace App\Model\Table;

use App\Model\Entity\Pasacomision;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pasacomisions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Expedientes
 * @property \Cake\ORM\Association\BelongsTo $Comisions
 */
class PasacomisionsTable extends Table
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

        $this->table('pasacomisions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Expedientes', [
            'foreignKey' => 'expediente_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Comisions', [
            'foreignKey' => 'comision_id',
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
            ->allowEmpty('motivo');

        $validator
            ->requirePresence('clasificacion', 'create')
            ->notEmpty('clasificacion');

        $validator
            ->boolean('diligencia')
            ->requirePresence('diligencia', 'create')
            ->notEmpty('diligencia');

        $validator
            ->boolean('informeedis')
            ->requirePresence('informeedis', 'create')
            ->notEmpty('informeedis');

        $validator
            ->requirePresence('observaciones', 'create')
            ->notEmpty('observaciones');

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
        $rules->add($rules->existsIn(['expediente_id'], 'Expedientes'));
        $rules->add($rules->existsIn(['comision_id'], 'Comisions'));
        return $rules;
    }
}
