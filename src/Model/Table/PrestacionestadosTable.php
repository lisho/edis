<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prestacionestados Model
 *
 * @property \Cake\ORM\Association\HasMany $Prestacions
 *
 * @method \App\Model\Entity\Prestacionestado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prestacionestado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Prestacionestado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prestacionestado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prestacionestado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prestacionestado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prestacionestado findOrCreate($search, callable $callback = null)
 */
class PrestacionestadosTable extends Table
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

        $this->table('prestacionestados');
        $this->displayField('tipo');
        $this->primaryKey('id');

        $this->hasMany('Prestacions', [
            'foreignKey' => 'prestacionestado_id'
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
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

        $validator
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        return $validator;
    }
}
