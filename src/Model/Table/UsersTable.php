<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Equipos
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('dni');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Equipos', [
            'foreignKey' => 'equipo_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Avisos', [
            'foreignKey' => 'user_id'
        ]);

        $this->hasMany('Roles', [
            'foreignKey' => 'user_id'
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
            //->requirePresence('dni', 'create')
            //->notEmpty('dni')
           ->add('dni', 'validFormat',[
                            'rule'=>array('custom','/^(([X-Z]{1})(\d{7})([A-Z]{1}))|((\d{8})([A-Z]{1}))$/i'),
                            'message' => 'La forma de introducir el DNI/NIE no es correcta'
                            ])
        ;


        $validator
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->requirePresence('apellidos', 'create')
            ->notEmpty('apellidos');

        $validator
            ->email('email')
            //->requirePresence('email', 'create')
            //->notEmpty('email')
        ;

        $validator
            //->requirePresence('telefono', 'create')
            //->notEmpty('telefono')
        ;

        $validator
            ->requirePresence('user', 'create')
            ->notEmpty('user');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('role', 'create')
            ->notEmpty('role');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['dni']));
        $rules->add($rules->isUnique(['user']));
        $rules->add($rules->existsIn(['equipo_id'], 'Equipos'));
       
        return $rules;
    }

}
