<?php
namespace App\Model\Table;

use App\Model\Entity\Comision;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Comisions Model
 *
 * @property \Cake\ORM\Association\HasMany $Asistentecomisions
 * @property \Cake\ORM\Association\HasMany $Pasacomisions
 */
class ComisionsTable extends Table
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

        $this->table('comisions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Asistentecomisions', [
            'foreignKey' => 'comision_id'
        ]);
        $this->hasMany('Pasacomisions', [
            'foreignKey' => 'comision_id'
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
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmpty('fecha');

        $validator
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            // ->requirePresence('observaciones', 'create')
            // ->notEmpty('observaciones')
        ;

        return $validator;
    }
}
