<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prestacions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Tipoprestacions
 * @property \Cake\ORM\Association\BelongsTo $Expedientes
 * @property \Cake\ORM\Association\BelongsTo $Participantes
 * @property \Cake\ORM\Association\BelongsTo $Estadoprestacions
 *
 * @method \App\Model\Entity\Prestacion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prestacion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Prestacion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prestacion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prestacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prestacion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prestacion findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PrestacionsTable extends Table
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

        $this->table('prestacions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Tipoprestacions', [
            'foreignKey' => 'tipoprestacion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Expedientes', [
            'foreignKey' => 'expediente_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Participantes', [
            'foreignKey' => 'participante_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Estadoprestacions', [
            'foreignKey' => 'estadoprestacion_id',
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
            ->allowEmpty('numprestacion');

        $validator
            ->date('apertura')
            ->requirePresence('apertura', 'create')
            ->notEmpty('apertura');

        $validator
            ->date('cierre')
            ->allowEmpty('cierre');

        $validator
            ->allowEmpty('observaciones');

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
        $rules->add($rules->existsIn(['tipoprestacion_id'], 'Tipoprestacions'));
        $rules->add($rules->existsIn(['expediente_id'], 'Expedientes'));
        $rules->add($rules->existsIn(['participante_id'], 'Participantes'));
        $rules->add($rules->existsIn(['estadoprestacion_id'], 'Estadoprestacions'));

        return $rules;
    }
}
