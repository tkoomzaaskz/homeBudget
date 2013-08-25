<?php $urls = $sf_data->getRaw('urls') ?>

<h1>Wealthy Laughing Duck RESTful API</h1>

<?php foreach ($urls as $section => $links): ?>
<h2><?php echo $section ?></h2>
<ul>
<?php foreach($links as $label => $link): ?>
    <li><a href="<?php echo url_for($link) ?>"><?php echo $label ?></a></li>
<?php endforeach; ?>
</ul>
<?php endforeach; ?>
