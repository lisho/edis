<?php
namespace App\Model\Table;

use App\Model\Entity\Participante;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Participantes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Expedientes
 */
class ParticipantesTable extends Table
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

        $this->table('participantes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Expedientes', [
            'foreignKey' => 'expediente_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Relations', [
            'foreignKey' => 'relation_id',
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
            ->allowEmpty('dni')
            ->add('dni', 'validFormat',[
                            'rule'=>array('custom','/^(([X-Z]{1})(\d{7})([A-Z]{1}))|((\d{8})([A-Z]{1}))$/i'),
                            'message' => 'La forma de introducir el DNI/NIE no es correcta'
                            ]);

        $validator
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->allowEmpty('apellidos');

        $validator
            ->date('nacimiento')
            ->allowEmpty('nacimiento');

        $validator
            ->requirePresence('sexo', 'create')
            ->notEmpty('sexo','¡No puede ser tan dificil saber si es chico o chica!');

        $validator
            //->requirePresence('telefono', 'create')
            ->allowEmpty('telefono');

        $validator
            ->email('email')
            //->requirePresence('email', 'create')
            ->allowEmpty('email');

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
        $rules->add($rules->isUnique(['dni']));
        $rules->add($rules->existsIn(['expediente_id'], 'Expedientes'));
        $rules->add($rules->existsIn(['relation_id'], 'Relations'));
        return $rules;
    }
}
