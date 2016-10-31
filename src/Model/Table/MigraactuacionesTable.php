<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Migraactuaciones Model
 *
 * @method \App\Model\Entity\Migraactuacione get($primaryKey, $options = [])
 * @method \App\Model\Entity\Migraactuacione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Migraactuacione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Migraactuacione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Migraactuacione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Migraactuacione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Migraactuacione findOrCreate($search, callable $callback = null)
 */
class MigraactuacionesTable extends Table
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

        $this->table('migraactuaciones');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->integer('antiguo')
            ->requirePresence('antiguo', 'create')
            ->notEmpty('antiguo');

        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmpty('fecha');

        $validator
            //->requirePresence('descripcion', 'create')
            //->notEmpty('descripcion')
            ;

        $validator
            ->requirePresence('numedis', 'create')
            ->notEmpty('numedis');

        $validator
            //->requirePresence('actuacion', 'create')
            //->notEmpty('actuacion')
            ;

        return $validator;
    }
}
