<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Migrausuarios Model
 *
 * @method \App\Model\Entity\Migrausuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Migrausuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Migrausuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Migrausuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Migrausuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Migrausuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Migrausuario findOrCreate($search, callable $callback = null)
 */
class MigrausuariosTable extends Table
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

        $this->table('migrausuarios');
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
            ->allowEmpty('dni');

        $validator
            ->allowEmpty('sexo');

        $validator
            ->allowEmpty('nombre');

        $validator
            ->allowEmpty('apellidos');

        $validator
            ->allowEmpty('telefono');

        $validator
            ->allowEmpty('otrosdatos');

        $validator
            ->allowEmpty('numedis');

        $validator
            ->allowEmpty('observaciones');

        $validator
            ->allowEmpty('relacion');

        $validator
            ->date('nacimiento')
            ->allowEmpty('nacimiento');

        $validator
            ->allowEmpty('nacionalidad');

        return $validator;
    }
}
