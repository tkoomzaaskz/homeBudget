<?php echo $form['date_from']->renderLabel() ?>:
<?php echo $form['date_from']->render(array('onchange' => 'javascript:reload();')); ?>
<br />

<?php echo $form['date_to']->renderLabel() ?>:
<?php echo $form['date_to']->render(array('onchange' => 'javascript:reload();')); ?>
<br />

<?php echo $form['created_by']->renderLabel() ?>:
<?php echo $form['created_by']->render(array('onchange' => 'javascript:reload();')); ?>
<br />

<?php echo $form['sum_subcategories']->renderLabel() ?>:
<?php echo $form['sum_subcategories']->render(array('onchange' => 'javascript:reload();')); ?>
<br />

<?php
  $params = array(
    'mode' => 'calculate',
    'chart[date_from]' => $form->getDefault('date_from'),
    'chart[date_to]' => $form->getDefault('date_to'),
    'chart[created_by]' => $form->getDefault('created_by'),
    'chart[sum_subcategories]' => $form->getDefault('sum_subcategories'),
    'format' => 'txt'
  );
  stOfc::createChart(
  sfConfig::get('app_chart_size_width'),
  sfConfig::get('app_chart_size_height'),
  '@chart_category_pie?' . http_build_query($params), false);
?>
