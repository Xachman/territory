<?php
namespace App\Model\Table;

use App\Model\Entity\Checkout;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use Cake\ORM\TableRegistry;

/**
 * Checkouts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Territories
 * @property \Cake\ORM\Association\HasMany $Territories
 */
class CheckoutsTable extends Table
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

        $this->table('checkouts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Territories', [
            'foreignKey' => 'territory_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Territories', [
            'foreignKey' => 'checkout_id'
        ]);

        $this->belongsTo('Participants', [
            'foreignKey' => 'participant_id',
            'joinType' => 'LEFT'
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
            ->integer('user')
            ->allowEmpty('user');

        $validator
            ->allowEmpty('name');
        $validator
            ->allowEmpty('participant_id');

        $validator
            
            ->requirePresence('checkout_date', 'create')
            ->notEmpty('checkout_date');

        $validator
            ->dateTime('turnindate')
            ->allowEmpty('turnindate');

        return $validator;
    }
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        if(!isset($data['name']) && isset($data['first_name']) && isset($data['last_name'])) {
            $data['name'] = $data['first_name'] . " " . $data['last_name'];
        }
    }
    public function beforeSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {   
        if(!isset($entity->uuid) && !$entity->uuid) {
            $entity->uuid = Text::uuid();
        }
        if(isset($entity->participant_id) && $entity->participant_id > 0) {
            $participants = TableRegistry::get("Participants");
            $participant = $participants->get($entity->participant_id);

            $entity->name = $participant->first_name.' '.$participant->last_name;
        }

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
        $rules->add($rules->existsIn(['territory_id'], 'Territories'));
        return $rules;
    }


    public function findLatestCheckouts() {
        $subquery = $this->find();
        $subquery->select(['territory_id' => 'territory_id', 'checkout_date' => $subquery->func()->max('checkout_date')])->group('territory_id');
        $query = $this->find()->select([
            "territory_id" => "Checkouts.territory_id",
            "name" => "Checkouts.name",
            "user" => "Checkouts.user",
            "checkout_date" => "Checkouts.checkout_date",
            "turnindate" => "Checkouts.turnindate",
            "created" => "Checkouts.created",
            "modified" => "Checkouts.modified",
            "id" => "Checkouts.id"
            ])->innerJoin(['Checkouts2'=> $subquery], ['Checkouts.territory_id = Checkouts2.territory_id', 'Checkouts.checkout_date = Checkouts2.checkout_date']);
        return $query;
    }

    public function findLatestTurnindate() {
        $subquery = $this->find();
        $subquery->select(['territory_id' => 'territory_id', 'turnindate' => $subquery->func()->max('turnindate')])->group('territory_id');
        $query = $this->find()->select([
            "territory_id" => "Checkouts.territory_id",
            "name" => "Checkouts.name",
            "user" => "Checkouts.user",
            "checkout_date" => "Checkouts.checkout_date",
            "turnindate" => "Checkouts.turnindate",
            "created" => "Checkouts.created",
            "modified" => "Checkouts.modified",
            "id" => "Checkouts.id"
            ])->innerJoin(['Checkouts2'=> $subquery], ['Checkouts.territory_id = Checkouts2.territory_id', 'Checkouts.turnindate = Checkouts2.turnindate']);
        return $query;
    }
    public function findLatestCheckout($territory_id) {
        return $this->findLatestCheckouts()->where(["Checkouts.territory_id" => $territory_id]);
    }
}
