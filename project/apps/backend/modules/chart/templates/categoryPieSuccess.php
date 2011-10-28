<input name="date_from" id="date_from" value="<?php echo $date['from'] ?>" onchange="javascript:reload();" />
<input name="date_to" id="date_to" value="<?php echo $date['to'] ?>" onchange="javascript:reload();" />
<br />
<?php stOfc::createChart(600, 400, '@chart_category_pie?mode=calculate&date[from]='.$date['from'].'&date[to]='.$date['to'], false); ?>
