<!DOCTYPE html >
  <head>
    <meta http-equiv="refresh" content="30" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Museums in Sofia</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQUrBEyBUV3aVyu0CThtIT1Lvkehaf8WY "
            type="text/javascript"></script>
    <script type="text/javascript">
	//<![CDATA[

    var customIcons = {
      museum: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      }
    };

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(42.6959248,23.30452557),
        zoom: 12,
        mapTypeId: 'roadmap'
      });
      // Change this depending on the name of your PHP file
      downloadUrl("phpsqlajax_genxml3.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
		  var type="museum";
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("latitude")),
              parseFloat(markers[i].getAttribute("longditude")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[type] || {};
		  var infoWindow = new google.maps.InfoWindow({content: html});

          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
	    });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {
     <?php
	include 'php.php';
	?>
	}

    //]]>//
    //http://localhost/php_example/phpsqlajax_map_v3.php
  </script>

  </head>

  <body onload="doNothing(); load();">
  <div id="map" style="width: 1550px; height: 1000px"></div>
</body>

</html>
