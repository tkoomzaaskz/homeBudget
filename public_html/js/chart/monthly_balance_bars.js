function reload()
{
  tmp = findSWF("chart");
  x = tmp.reload("/index.php/chart/monthly-balance-bars/calculate"
    +"?chart[date_from]="+document.getElementById('chart_date_from').value
    +"&chart[date_to]="+document.getElementById('chart_date_to').value
    +"&chart[created_by]="+document.getElementById('chart_created_by').value
    +"&format=txt"
  );
}
