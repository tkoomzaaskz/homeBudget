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

    $this->setWidget('created_at', new sfWidgetFormFilterDate(array(
      'from_date' => new sfWidgetFormI18nDate(array('culture' => 'pl')),
      'to_date' => new sfWidgetFormI18nDate(array('culture' => 'pl')),
      'with_empty' => false,
    )));
  }
}
