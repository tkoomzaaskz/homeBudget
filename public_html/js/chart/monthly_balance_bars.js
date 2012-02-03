function findSWF(movieName) {
  if (navigator.appName.indexOf("Microsoft")!= -1) {
    return window["ie_" + movieName];
  } else {
    return document[movieName];
  }
}
function reload()
{
  tmp = findSWF("chart");
  x = tmp.reload("/backend_dev.php/chart/monthly-balance-bars/calculate"
    +"?chart[date_from]="+document.getElementById('chart_date_from').value
    +"&chart[date_to]="+document.getElementById('chart_date_to').value
    +"&chart[created_by]="+document.getElementById('chart_created_by').value
  );
}

