function findSWF(swf) {
  if (navigator.appName.indexOf("Microsoft")!= -1) {
    return window["ie_" + swf];
  } else {
    return document[swf];
  }
}
