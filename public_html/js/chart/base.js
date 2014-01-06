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