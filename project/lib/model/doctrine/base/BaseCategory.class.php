<?php

/**
 * BaseCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $parent_id
 * @property string $name
 * @property Category $Parent
 * @property Doctrine_Collection $Events
 * @property Doctrine_Collection $Children
 * 
 * @method integer             getParentId()  Returns the current record's "parent_id" value
 * @method string              getName()      Returns the current record's "name" value
 * @method Category            getParent()    Returns the current record's "Parent" value
 * @method Doctrine_Collection getEvents()    Returns the current record's "Events" collection
 * @method Doctrine_Collection getChildren()  Returns the current record's "Children" collection
 * @method Category            setParentId()  Sets the current record's "parent_id" value
 * @method Category            setName()      Sets the current record's "name" value
 * @method Category            setParent()    Sets the current record's "Parent" value
 * @method Category            setEvents()    Sets the current record's "Events" collection
 * @method Category            setChildren()  Sets the current record's "Children" collection
 * 
 * @package    test
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('category');
        $this->hasColumn('parent_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('name', 'string', 32, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 32,
             ));

        $this->option('charset', 'utf8');
        $this->option('collate', 'utf8_general_ci');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Category as Parent', array(
             'local' => 'parent_id',
             'foreign' => 'id'));

        $this->hasMany('Event as Events', array(
             'local' => 'id',
             'foreign' => 'category_id'));

        $this->hasMany('Category as Children', array(
             'local' => 'id',
             'foreign' => 'parent_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $signable0 = new Doctrine_Template_Signable();
        $this->actAs($timestampable0);
        $this->actAs($signable0);
    }
}