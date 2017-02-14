<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Migraexpedientes Model
 *
 * @method \App\Model\Entity\Migraexpediente get($primaryKey, $options = [])
 * @method \App\Model\Entity\Migraexpediente newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Migraexpediente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Migraexpediente|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Migraexpediente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Migraexpediente[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Migraexpediente findOrCreate($search, callable $callback = null)
 */
class MigraexpedientesTable extends Table
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

        $this->table('migraexpedientes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Migrausuarios', [
            'foreignKey' => 'migraexpediente_id',
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
            ->allowEmpty('rgc');

        $validator
            ->allowEmpty('numedis');

        $validator
            ->allowEmpty('tedis');

        $validator
            ->allowEmpty('cc');

        $validator
            ->allowEmpty('ceas');

        $validator
            ->date('alta')
            ->allowEmpty('alta');

        $validator
            ->date('baja')
            ->allowEmpty('baja');

        $validator
            ->allowEmpty('domicilio');

        return $validator;
    }
}
