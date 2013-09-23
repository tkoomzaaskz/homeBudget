            <ul class="nav nav-list">
              <li class="nav-header">Api commands</li>
              <li class="active"><?php echo link_to('users', '@command?action=users') ?></li>
              <li><?php echo link_to('incomes', '@command?action=incomes') ?></li>
              <li><?php echo link_to('outcomes', '@command?action=outcomes') ?></li>
              <li><?php echo link_to('income categories', '@command?action=incomeCategories') ?></li>
              <li><?php echo link_to('outcome categories', '@command?action=outcomeCategories') ?></li>
            </ul>