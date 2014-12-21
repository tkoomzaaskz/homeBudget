<ul class="nav nav-list">
  <li class="nav-header">Api commands</li>
  <?php foreach($links as $link_action => $link_label): ?>
  <li<?php if ($action == $link_action): ?> class="active"<?php endif; ?>>
    <?php echo link_to($link_label, '@command?action=' . $link_action) ?>
  </li>
  <?php endforeach; ?>
</ul>
