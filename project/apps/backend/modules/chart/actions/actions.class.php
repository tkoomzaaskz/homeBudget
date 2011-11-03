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
        $this->form = new CategoryPieChartForm();
        $this->getResponse()->addJavascript('chart/category_pie.js');
        break;
      case 'calculate':
        $this->calculateCategoryPie($request);
        return sfView::NONE;
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
    sfConfig::set('sf_web_debug', false);
    $g = new stGraph();
    $data = ChartDataManager::getCategoryPieData($request->getParameter('chart'));

    $g->pie_values(array_values($data), array_keys($data));
    $g->bg_colour = '#E4F5FC';
    $g->pie(80,'#78B9EC','{font-size: 12px; color: #78B9EC;');
    $g->pie_slice_colours( array('#d01f3c','#356aa0','#c79810','#98c710','#9810c7') );
    $g->set_tool_tip( '#x_label#: #val# zł' );
    $g->title('Wydatki na poszczególne kategorie', '{font-size:18px; color: #18A6FF}' );

    echo $g->render();
    return sfView::NONE;
  }

  /**
   * Calculate data for category bar chart.
   *
   * @param sfWebRequest $request
   * @return NONE
   */
  private function calculateCategoryBar(sfWebRequest $request)
  {
    sfConfig::set('sf_web_debug', false);
    $g = new stGraph();
    $data = ChartDataManager::getCategoryPieData($request->getParameter('chart'));

    $bar = new stBarOutline( 80, '#78B9EC', '#3495FE' );
    $bar->key( 'Number of downloads per day', 10 );
    $bar->data = $data;
    $g->data_sets[] = $bar;
    $g->bg_colour = '#E4F5FC';
    // Set the transparency, line colour to separate each slice etc.
    // Set the colour for each slice. Here we are defining three colours
    // while we need 7 colours. So, the same colours will be
    // repeated for the all remaining slices in the same order
    $g->set_x_labels(array_keys($data));
    $g->set_x_label_style( 14, '#9933CC', 2 );
    $g->set_y_max(1000);
    $g->set_tool_tip( '#x_label#: #val# zł' );
    $g->title('Wydatki na poszczególne kategorie', '{font-size:18px; color: #18A6FF}' );

    echo $g->render();
    return sfView::NONE;
  }
}
