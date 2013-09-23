<?php $urls = $sf_data->getRaw('urls') ?>

        <div class="span9">
          <div class="hero-unit">
            <h2><?php echo $command ?></h2>
            <ul>
            <?php foreach($urls as $label => $link): ?>
                <li><a href="<?php echo url_for($link) ?>"><?php echo $label ?></a></li>
            <?php endforeach; ?>
            </ul>
          </div>
        </div>
