<?php echo $form['date_from']->render(array('onchange' => 'javascript:reload();')); ?>
<?php echo $form['date_to']->render(array('onchange' => 'javascript:reload();')); ?>
<?php echo $form['created_by']->render(array('onchange' => 'javascript:reload();')); ?>
<br />
<?php stOfc::createChart(
  sfConfig::get('app_chart_size_width'),
  sfConfig::get('app_chart_size_height'),
  '@chart_monthly_balance_bars?mode=calculate'
  .'&chart[date_from]='.$form->getDefault('date_from')
  .'&chart[date_to]='.$form->getDefault('date_to')
  .'&chart[created_by]='.$form->getDefault('created_by'), false); ?>
