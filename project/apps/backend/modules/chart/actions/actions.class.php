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
   * Returns stGraph object data transformed into JSON format.
   *
   * @param sfRequest A request object
   * @return JSON String
   */
  private function getJson($data)
  {
    $lines = explode("\n", $data);
    $result = array();
    foreach ($lines as $line)
    {
      $line = substr($line, 1, strlen($line) - 3);
      $line_tmp = explode('=', $line);
      $attr = $line_tmp[0];
      $value = explode(',', $line_tmp[1]);
      $result[$attr] = $value;
    }
    return json_encode($result);
  }

  private function getDataOutput($graph, $format)
  {
    $content = $graph->render();
    switch($format) {
      case 'txt':
        echo $content;
        return sfView::NONE;
      case 'json':
        echo $this->getJson($content);
        return sfView::NONE;
    }
  }

 /**
  * Displays monthly balance bars chart.
  *
  * @param sfRequest A request object
  */
  public function executeMonthlyBalanceBars(sfWebRequest $request)
  {
    switch ($request->getParameter('mode'))
    {
      case 'execute':
        $this->form = new MonthlyBalanceBarsChartForm();
        $this->getResponse()->addJavascript('chart/monthly_balance_bars.js');
        $this->getResponse()->addJavascript('chart/base.js');
        break;
      case 'calculate':
        $graph = $this->calculateMonthlyBalanceBars($request);
        return $this->getDataOutput($graph, $request->getParameter('format'));
      default:
        throw new sfException('Unknown action mode in '.get_class($this));
    }
  }

  /**
   * Calculate data for monthly balance bars chart.
   *
   * @param sfWebRequest $request
   * @return stGraph
   */
  private function calculateMonthlyBalanceBars(sfWebRequest $request)
  {
    sfConfig::set('sf_web_debug', false);
    $g = new stGraph();
    $data = ChartDataManager::getMonthlyBalanceBarsData($request->getParameter('chart'));

    $bar_incomes = new bar_3d( 75, '#00BB00');
    $bar_incomes->key( 'przychody', 10 );
    $bar_incomes->data = $data['incomes'];
    $g->data_sets[] = $bar_incomes;

    $bar_outcomes = new bar_3d( 75, '#BB0000');
    $bar_outcomes->key( 'wydatki', 10 );
    $bar_outcomes->data = $data['outcomes'];
    $g->data_sets[] = $bar_outcomes;

    $bar_balances = new bar_3d( 75, '#BBBB00');
    $bar_balances->key( 'oszczędności', 10 );
    $bar_balances->data = $data['balances'];
    $g->data_sets[] = $bar_balances;

    $g->set_y_max(ChartDataManager::roundToMax($data['incomes'], $data['outcomes']));
    $g->y_label_steps(5);
    $g->set_y_legend( 'Sumy pieniedzy', 12, '#736AFF' );
    $g->set_tool_tip( '#x_label#: #val# zł' );

    $x_label_orientation = (count($data['incomes']) > 6 ? 2 : 0);
    $g->set_x_axis_3d(12);
    $g->set_x_label_style(15, '#000', $x_label_orientation);
    $g->set_x_labels($data['keys']);
    $g->x_axis_colour('#909090', '#ADB5C7');
    $g->y_axis_colour('#909090', '#ADB5C7');

    $g->title('Bilans miesięczny', '{font-size:20px; color: #FFFFFF; margin: 5px; background-color: #505050; padding:5px; padding-left: 20px; padding-right: 20px;}' );

    return $g;
  }

/******************************************************************************/

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
        $this->getResponse()->addJavascript('chart/base.js');
        break;
      case 'calculate':
        $graph = $this->calculateCategoryPie($request);
        return $this->getDataOutput($graph, $request->getParameter('format'));
      default:
        throw new sfException('Unknown action mode in '.get_class($this));
    }
  }

  /**
   * Calculate data for category pie chart.
   *
   * @param sfWebRequest $request
   * @return stGraph
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

    return $g;
  }

  /**
   * Calculate data for category bar chart.
   *
   * @param sfWebRequest $request
   * @return stGraph
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

    return $g;
  }
}
