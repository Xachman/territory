<?php
namespace App\Model\Table;

use App\Model\Entity\Territory;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Territories Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class TerritoriesTable extends Table
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

        $this->table('territories');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);
		$this->hasMany('Checkouts', [
			"foreignKey" => "territory_id"
		]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            // You can configure as many upload fields as possible,
            // where the pattern is `field` => `config`
            //
            // Keep in mind that while this plugin does not have any limits in terms of
            // number of files uploaded per request, you should keep this down in order
            // to decrease the ability of your users to block other requests.
            'pdf' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'pdf_dir', // defaults to `dir`
                ],
            ],
            'image' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'image_dir', // defaults to `dir`
                ],
            ]
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
            ->allowEmpty('title');

        $validator
            ->allowEmpty('pdf');

        $validator
            ->allowEmpty('is_checked_out');
        $validator
            ->allowEmpty('image');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('url');

        $validator
            ->integer('territory_number')
            ->notEmpty('territory_number');
        
        
        $validator
            ->dateTime('turnindate')
            ->allowEmpty('turnindate');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['territory_id'], 'Checkouts'));
        return $rules;
    }

    public function orderByIsCheckedOut($desc = true) {
        $checkouts = TableRegistry::get('Checkouts');

        $subquery = $checkouts->findLatestCheckouts();
        $query = $this->find('all')->select([
			"id" => "Territories.id",
			"territory_number" => "Territories.territory_number",
			"title" => "Territories.title",
			"is_checked_out" => "Territories.is_checked_out",
			"checkout_name" => "Checkouts.name",
			"checkout_date" => "Checkouts.checkout_date",
			"turnindate" => "Checkouts.turnindate",
			"checkout_turnindate" => "Checkouts.turnindate",
            "checkout_id" => "Checkouts.id"
		])
        ->innerJoin(["Checkouts" => $subquery], ["Territories.id = Checkouts.territory_id"]);
        return $query;
        
    }

    public function orderByTurninDate() {
        $checkouts = TableRegistry::get('Checkouts');

        $subquery = $checkouts->findLatestTurnindate();
        $query = $this->find('all')->select([
			"id" => "Territories.id",
			"territory_number" => "Territories.territory_number",
			"title" => "Territories.title",
			"is_checked_out" => "Territories.is_checked_out",
			"checkout_name" => "Checkouts.name",
			"checkout_date" => "Checkouts.checkout_date",
			"turnindate" => "Checkouts.turnindate",
			"checkout_turnindate" => "Checkouts.turnindate",
            "checkout_id" => "Checkouts.id"
		])
        ->innerJoin(["Checkouts" => $subquery], ["Territories.id = Checkouts.territory_id"]);
        return $query;
    }

    public function over90DaysOut() {
        return $this->orderByIsCheckedOut()->where(["is_checked_out" => 1, "checkout_date  <" => date('Y-m-d H:i:s', strtotime(" -90 days"))])->order("checkout_date");
    }

    public function overDaysOut($days) {
        return $this->orderByIsCheckedOut()->where(["is_checked_out" => 1, "checkout_date  <" => date('Y-m-d H:i:s', strtotime(" -".$days." days"))])->order("checkout_date");
    }
    public function overOneYearNotWorked() {
        return $this->orderByIsCheckedOut()->where(["turnindate  <" => date('Y-m-d H:i:s', strtotime(" -1 year"))])->order("turnindate");
    }

    public function checking($territoryId) {
        
    }

}
