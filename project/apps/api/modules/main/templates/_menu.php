<ul class="nav nav-list">
  <li class="nav-header">Api commands</li>
  <li<?php if ($action == 'users'): ?> class="active"<?php endif; ?>>
    <?php echo link_to('users', '@command?action=users') ?>
  </li>
  <li<?php if ($action == 'incomes'): ?> class="active"<?php endif; ?>>
    <?php echo link_to('incomes', '@command?action=incomes') ?>
  </li>
  <li<?php if ($action == 'outcomes'): ?> class="active"<?php endif; ?>>
    <?php echo link_to('outcomes', '@command?action=outcomes') ?>
  </li>
  <li<?php if ($action == 'incomeCategories'): ?> class="active"<?php endif; ?>>
    <?php echo link_to('income categories', '@command?action=incomeCategories') ?>
  </li>
  <li<?php if ($action == 'outcomeCategories'): ?> class="active"<?php endif; ?>>
    <?php echo link_to('outcome categories', '@command?action=outcomeCategories') ?>
  </li>
</ul>