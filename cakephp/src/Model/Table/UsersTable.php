<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
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

        $this->setTable('users');
        $this->setDisplayField('users');
        $this->setPrimaryKey('id');

        $this->hasMany('Tweets', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Follows', [
            'foreignKey' => 'user_id',
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
            ->scalar('userid')
            ->maxLength('userid', 20)
            ->requirePresence('userid', 'create')
            ->notEmpty('userid')
            ->add('userid', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 30)
            ->notEmpty('name');

        $validator
            ->scalar('nickname')
            ->maxLength('nickname', 30)
            ->notEmpty('nickname');

        $validator
            ->scalar('mail')
            ->maxLength('mail', 30)
            ->notEmpty('mail')
            ->add('mail', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->boolean('private')
            ->notEmpty('private');

        $validator
            ->scalar('password')
            ->maxLength('password', 256)
            ->notEmpty('password');

        $validator
            ->dateTime('registered_at')
            ->notEmpty('registered_at');

        $validator
            ->dateTime('modified_at')
            ->notEmpty('modified_at');

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
        $rules->add($rules->isUnique(['userid']));
        $rules->add($rules->isUnique(['mail']));

        return $rules;
    }
}
