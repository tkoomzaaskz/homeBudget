function reload()
{
  tmp = findSWF("chart");
  x = tmp.reload("/index.php/chart/category-pie/calculate"
    +"?chart[date_from]="+document.getElementById('chart_date_from').value
    +"&chart[date_to]="+document.getElementById('chart_date_to').value
    +"&chart[created_by]="+document.getElementById('chart_created_by').value
    +"&chart[sum_subcategories]="+document.getElementById('chart_sum_subcategories').checked
    +"&format=txt"
  );
}

