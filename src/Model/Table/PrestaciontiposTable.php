<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prestaciontipos Model
 *
 * @method \App\Model\Entity\Prestaciontipo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prestaciontipo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Prestaciontipo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prestaciontipo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prestaciontipo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prestaciontipo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prestaciontipo findOrCreate($search, callable $callback = null)
 */
class PrestaciontiposTable extends Table
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

        $this->table('prestaciontipos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Prestacions', [
            'foreignKey' => 'prestaciontipo_id',
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
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        return $validator;
    }
}
