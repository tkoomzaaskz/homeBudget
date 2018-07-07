function findSWF(swf) {
  if (navigator.appName.indexOf("Microsoft")!= -1) {
    return window["ie_" + swf];
  } else {
    return document[swf];
  }
}

function getQueryString(url, params)
{
  var qstring = [];
  for (var p in params)
    if (params.hasOwnProperty(p)) {
      qstring.push(p + '=' + params[p]);
    }
  return url + '?' + qstring.join('&');
}

function zerofill(number, length)
{
  var result = number.toString();
  var pad = length - result.length;
  while(pad > 0) {
    result = '0' + result;
    pad--;
  }
  return result;
}

function inverse(n) {
  return -n;
}

function mapOldFormat(result){
  var x_labels = result.x_labels.map(l => l.replace('+-+', ' - ')),
    values = result.values,
    values_2 = result.values_2,
    values_3 = result.values_3;
    return [
      ['x', ...x_labels],
      ['incomes', ...values.map(parseFloat)],
      ['outcomes', ...values_2.map(parseFloat).map(inverse)],
      ['savings', ...values_3.map(parseFloat)]
    ]
}
