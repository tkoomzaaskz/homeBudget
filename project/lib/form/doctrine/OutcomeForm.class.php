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

    $this->setValidator('amount', new sfValidatorString(array('max_length' => 64)));

    $this->setWidget('remember_date',
      new sfWidgetFormInputCheckbox(
    ));

    $this->setValidator('remember_date',
      new sfValidatorBoolean(
    ));

    $this->widgetSchema['created_at'] = new sfWidgetFormI18nDate(array('culture' => 'pl'));

    if ($this->isNew())
    {
      $user = sfContext::getInstance()->getUser();
      $date = $user->hasAttribute('last_outcome_created_at') ?
        $user->getAttribute('last_outcome_created_at') :
        date('Y-m-d H:i:s');
      $this->setDefault ('created_at', $date);
      $this->setDefault ('created_by', $user->getId());
    }

    $this->setWidget('description', new sfWidgetFormInputText());
  }

  protected function updateAmountColumn($value)
  {
    return Tools::processMoneyStrToFloat($value);
  }
}
