function reload()
{
  var url = '/index.php/chart/monthly-balance-bars/calculate';
  var params = {
    'chart[date_from]': document.getElementById('chart_date_from_year').value + "-" + zerofill(document.getElementById('chart_date_from_month').value, 2),
    'chart[date_to]': document.getElementById('chart_date_to_year').value + "-" + zerofill(document.getElementById('chart_date_to_month').value, 2),
    'chart[created_by]': document.getElementById('chart_created_by').value,
    'format': 'txt'
  };
  url = getQueryString(url, params);
  findSWF('chart').reload(url);
}
