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
  x = tmp.reload("/backend_dev.php/chart/category-pie/calculate"
    +"?date[from]="+document.getElementById('date_from').value
    +"&date[to]="+document.getElementById('date_to').value
  );
}

