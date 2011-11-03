<?php

/**
 * Outcome form.
 *
 * @package    finances
 * @subpackage form
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OutcomeForm extends BaseOutcomeForm
{
  public function configure()
  {
    $this->setWidget('category_id',
      new sfWidgetFormDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Category'),
        'add_empty' => '→ wybierz ←',
        'method' => 'getIndentedName',
        'table_method' => 'getCategoryTreeCollection',)
    ));

    $this->widgetSchema['created_at'] = new sfWidgetFormI18nDate(array('culture' => 'pl'));

    if ($this->isNew())
    {
      $this->setDefault ('created_at', date('Y-m-d H:i:s'));
      $this->setDefault ('created_by', sfContext::getInstance()->getUser()->getId());
    }

    $this->setWidget('comment', new sfWidgetFormInputText());
  }
}
