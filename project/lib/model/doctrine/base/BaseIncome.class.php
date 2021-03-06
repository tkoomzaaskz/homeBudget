<?php

/**
 * BaseIncome
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $category_id
 * @property decimal $amount
 * @property string $description
 * @property IncomeCategory $Category
 * 
 * @method integer        getCategoryId()  Returns the current record's "category_id" value
 * @method decimal        getAmount()      Returns the current record's "amount" value
 * @method string         getDescription() Returns the current record's "description" value
 * @method IncomeCategory getCategory()    Returns the current record's "Category" value
 * @method Income         setCategoryId()  Sets the current record's "category_id" value
 * @method Income         setAmount()      Sets the current record's "amount" value
 * @method Income         setDescription() Sets the current record's "description" value
 * @method Income         setCategory()    Sets the current record's "Category" value
 * 
 * @package    finances
 * @subpackage model
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseIncome extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('income');
        $this->hasColumn('category_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('amount', 'decimal', 10, array(
             'type' => 'decimal',
             'notnull' => true,
             'length' => 10,
             'scale' => '2',
             ));
        $this->hasColumn('description', 'string', 64, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 64,
             ));

        $this->option('charset', 'utf8');
        $this->option('collate', 'utf8_general_ci');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('IncomeCategory as Category', array(
             'local' => 'category_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             'updated' => 
             array(
              'disabled' => true,
             ),
             ));
        $signable0 = new Doctrine_Template_Signable(array(
             'updated' => 
             array(
              'disabled' => true,
             ),
             ));
        $this->actAs($timestampable0);
        $this->actAs($signable0);
    }
}