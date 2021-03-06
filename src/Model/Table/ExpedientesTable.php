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
            'foreignKey' => 'expediente_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->hasMany('Roles', [
            'foreignKey' => 'expediente_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->hasMany('Incidencias', [
            'foreignKey' => 'expediente_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->hasMany('Pasacomisions', [
            'foreignKey' => 'expediente_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->hasMany('Prestacions', [
            'foreignKey' => 'expediente_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
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
            //->isUnique('numedis', 'Este Número de expediente ya está creado en la aplicación')
            ->notEmpty('numedis','Debes añadir un número de Expediente de EDIS.')
            ->add('numedis', 'validFormat',[
                            'rule'=>array('custom','/^(\d{4})$/i'),
                            //'rule'=>array('custom','/^(\d{4})-(\d{1})$/i'),
                            'message' => 'La forma de introducir el número de expediente EDIS no es correcta (4 dígitos)'
                            ]);
            

        $validator
            ->requirePresence('numhs', 'create')
            //->isUnique('numhs', 'Este Número de historia ya existe en la aplicación')
            ->notEmpty('numhs','Debes introducir el número de Historia Social de SAUSS para crear correctamente el expediente.')
            ->add('numhs', 'validFormat',[
                            'rule'=>array('custom','/^(\d{7})$/i'),
                            //'rule'=>array('custom','/^(\d{4})-(\d{1})$/i'),
                            'message' => 'La forma de introducir el número de historia social no es correcta (7 dígitos)'
                            ]);

        $validator
            ->requirePresence('domicilio', 'create')
            ->notEmpty('domicilio', 'Debes añadir un domicilio de referencia para crear el expediente.');    

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
        $rules->add($rules->isUnique(['numedis'], 'Este Número de expediente ya está creado en la aplicación'));
       // $rules->add([$this,'numedis']));
        

      
        $rules->add($rules->isUnique(['numhs'], 'Este Número de historia ya existe en la aplicación'));
        //$rules->add($rules->existsIn(['expediente_id'], 'Expedientes'));
        //$rules->add($rules->existsIn(['relation_id'], 'Relations'));
        return $rules;
    }
}
