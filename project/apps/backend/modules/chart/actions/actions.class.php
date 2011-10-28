<?php
/**
 * @file
 *
 * File containing chartActions class.
 */

/**
 * chart actions.
 *
 * @package    finances
 * @class      chartActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class chartActions extends sfActions
{
 /**
  * Displays category pie chart.
  *
  * @param sfRequest A request object
  */
  public function executeCategoryPie(sfWebRequest $request)
  {
    switch ($request->getParameter('mode'))
    {
      case 'execute':
        $this->getResponse()->addJavascript('chart/category_pie.js');
        $this->date = array(
          'from' => Tools::getBeginningOfTheMonthDate(),
          'to' => Tools::getEndingOfTheMonthDate(),
        );
        break;
      case 'calculate':
        $this->calculateCategoryPie($request);
      default:
        throw new sfException('Unknown action mode in '.get_class($this));
    }
  }

  /**
   * Calculate data for category pie chart.
   *
   * @param sfWebRequest $request
   * @return NONE
   */
  private function calculateCategoryPie(sfWebRequest $request)
  {
    $data = ChartDataManager::getCategoryPieData($request->getParameter('date'));
    //Creating a stGraph object
    $g = new stGraph();
    //set background color
    $g->bg_colour = '#E4F5FC';
    //Set the transparency, line colour to separate each slice etc.
    $g->pie(80,'#78B9EC','{font-size: 12px; color: #78B9EC;');
    $g->pie_values($data, array_keys($data));
    //Set the colour for each slice. Here we are defining three colours
    //while we need 7 colours. So, the same colours will be
    //repeated for the all remaining slices in the same order
    $g->pie_slice_colours( array('#d01f3c','#356aa0','#c79810','#98c710','#9810c7') );
    $g->set_tool_tip( '#x_label#: #val# zł' );
    $g->title('Wydatki na poszczególne kategorie', '{font-size:18px; color: #18A6FF}' );
    echo $g->render();
    return sfView::NONE;
  }
}
