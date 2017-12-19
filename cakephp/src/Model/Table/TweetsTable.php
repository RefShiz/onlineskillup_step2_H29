<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tweets Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Tweet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tweet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tweet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tweet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tweet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tweet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tweet findOrCreate($search, callable $callback = null, $options = [])
 */
class TweetsTable extends Table
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

        $this->setTable('tweets');
        $this->setDisplayField('tweets');
        $this->setPrimaryKey('tweetid');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('tweetid')
            ->allowEmpty('tweetid', 'create');

        $validator
            ->integer('user_id')
            ->notEmpty('user_id');

        $validator
            ->scalar('tweet')
            ->notEmpty('tweet');

        $validator
            ->dateTime('created_at')
            ->notEmpty('created_at');

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
        //$rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
