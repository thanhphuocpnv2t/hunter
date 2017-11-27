var target = document.head;
var observer = new MutationObserver(function(mutations) {
  for (var i = 0; mutations[i]; ++i) {
    if (mutations[i].addedNodes[0].nodeName == "SCRIPT" && mutations[i].addedNodes[
        0].src.match(/\/AuthenticationService.Authenticate?/g)) {
      var str = mutations[i].addedNodes[0].src.match(/[?&]callback=.*[&$]/g);
      if (str) {
        if (str[0][str[0].length - 1] == '&') {
          str = str[0].substring(10, str[0].length - 1);
        } else {
          str = str[0].substring(10);
        }
        var split = str.split(".");
        var object = split[0];
        var method = split[1];
        window[object][method] = null;
      }
      observer.disconnect();
    }
  }
});
var config = {
  attributes: true,
  childList: true,
  characterData: true
}
observer.observe(target, config);

function initMap() {
  var uluru = {
    lat: 16.064480,
    lng: 108.218900
  };  var map = new google.maps.Map(document.getElementById('map'), {
    center: uluru,
    zoom: 16,
    scrollwheel: false,
    disableDefaultUI: true,
    styles: [{
      "stylers": [{
        "hue": "#858585"
      }, {
        "saturation": -100
      }, {
        "lightness": 0
      }],
      "elementType": "all",
      "featureType": "all"
    }, {
      "stylers": [{
        "color": "#858585"
      }],
      "featureType": "road.highway",
    }]
  });
  var marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
  google.maps.event.addDomListener(window, 'resize', function() {
    var center = map.getCenter()
    google.maps.event.trigger(map, "resize")
    map.setCenter(center)
  });
}
