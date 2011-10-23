<?php

/**
 * Category filter form.
 *
 * @package    test
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoryFormFilter extends BaseCategoryFormFilter
{
  public function configure()
  {
    $this->setWidget('parent_id',
      new sfWidgetFormDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Parent'),
        'add_empty' => '→ wybierz ←',
        'method' => 'getIndentedName',
        'table_method' => 'getCategoryTreeCollection',)
    ));
  }
}
