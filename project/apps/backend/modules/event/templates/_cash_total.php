<span<?php if ($event['cash_total'] >= sfConfig::get('app_money_emphasize_above')): ?> style="font-weight: bold;"<?php endif; ?>>
  <?php echo Tools::priceFormat($event['cash_total'], true) ?>
</span>
