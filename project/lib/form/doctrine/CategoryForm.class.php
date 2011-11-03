<?php

/**
 * Category form.
 *
 * @package    finances
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoryForm extends BaseCategoryForm
{
  public function configure()
  {
    unset($this['type']);
    unset($this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by']);

    $this->setWidget('parent_id',
      new sfWidgetFormDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Parent'),
        'add_empty' => '→ wybierz ←',
        'method' => 'getIndentedName',
        'table_method' => 'getTopLevelCategoriesQuery',)
    ));
  }
}
