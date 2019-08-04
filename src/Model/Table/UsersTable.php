<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\BookmarksTable|\Cake\ORM\Association\HasMany $Bookmarks
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
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
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Bookmarks', [
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 100)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name','Rellene este campo');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 100)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name', 'Rellene este campo');

        $validator
            ->email('email',['message'=>'Ingrese Correo Valido'])
            ->requirePresence('email', 'create')
            ->notEmptyString('email','Rellene este campo');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', 'Rellene este campo','create');

        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmptyString('role', 'Rellene este campo');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmptyString('active', 'Rellene este campo');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    /*indica que el email se unico*/
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email'], 'Ya Existe Este Correo.'));

        return $rules;
    }

    public function findAuth(\Cake\ORM\Query $query, array $options)
    {//obtengo en bd los datos de los usuarios activados, solamente van a poder auth los activos
        $query
            ->select(['id', 'first_name', 'last_name', 'email', 'password', 'role'])
            ->where(['Users.active' => 1]);
        return $query;
    }

     public function recoverPassword($id)
    {
        $user = $this->get($id);
        return $user->password;
    }
/**metdo para no eliminar admin, actua antes de eliminar*/
     public function beforeDelete($event,$entity,$options){
        if ($entity->role == 'admin') {
            return false;
            $this->redirect(['action' => 'index']);
        }
        return true;
     }
}
