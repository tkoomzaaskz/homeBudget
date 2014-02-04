<?php

/**
 * Outcome filter form.
 *
 * @package    finances
 * @subpackage filter
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OutcomeFormFilter extends BaseOutcomeFormFilter
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

    $this->setWidget('amount_range', new sfWidgetFormFilterInputRange(array(
      'from_value' => new sfWidgetFormInput(),
      'to_value' => new sfWidgetFormInput(),
      'with_empty' => false
    )));

    $this->setValidator('amount_range', new sfValidatorInputRange(array(
      'required' => false,
      'from_value' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'to_value' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false)))
    )));

    $this->setWidget('created_at', new sfWidgetFormFilterDate(array(
      'from_date' => new sfWidgetFormI18nDate(array('culture' => 'pl')),
      'to_date' => new sfWidgetFormI18nDate(array('culture' => 'pl')),
      'with_empty' => false,
    )));
  }

  public function addAmountRangeColumnQuery($query, $field, $value)
  {
    $rootAlias = $query->getRootAlias();
    if (isset($value['from']) && $value['from'])
      $query->andWhere($rootAlias.".amount >= ?", $value['from']);
    if (isset($value['to']) && $value['to'])
      $query->andWhere($rootAlias.".amount <= ?", $value['to']);
  }
}
