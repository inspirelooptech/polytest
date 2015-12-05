<html>
<head>
   <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>

      <script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js" type="text/javascript"></script>    
   <script>
function initializeMaps() {
          var latlng = new google.maps.LatLng(13.0839, 80.2700);
          var myOptions = {
              zoom: 2,
              center:latlng
			  
 
          };
          var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
          var infowindow = new google.maps.InfoWindow({});
		  var mc = new MarkerClusterer(map)
		  var marker, i;
          var stack = [];
		  var marker = [];
		    <?php
				//open connection to mysql db
				$connection = mysqli_connect("localhost","dummytest","","loop@313233") or die("Error " . mysqli_error($connection));
				//fetch table rows from mysql db
				$sql = "select * from location";
				$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
				//create an array
			?>
			 <?php while($row =mysqli_fetch_assoc($result)){?>
                marker = new google.maps.Marker({
                  position: new google.maps.LatLng(<?php echo $row['lat'] ?>,<?php echo $row['lng'] ?>),
                  map: map
				  	
                });
				<?php if($row['status']==1){ ?>
					marker.setIcon("red.png");
					<?php }else{ ?>
					marker.setIcon("icon_green.png");
					<?php } ?>
				google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
                return function () {
                    infowindow.setContent("<div id='pano' style='width: 100px; height: 50px;'></div><div><?php echo $row['c_name']; ?></div>" + "<div><?php echo $row['c_address']; ?></div><div><?php echo $row['capacity']; ?></div>");	
					infowindow.open(map, marker);
				}
				google.maps.event.addListener(marker, 'mouseout', function() {
				infowindow.close();	
			});
			})
			
			(marker, i));
            stack.push(marker);
				mc.addMarker(marker);
			<?php } ?>
			
        }
   </script>
</head>
<body onLoad="initializeMaps()">
  <div id="map_canvas" style="width:100%;height:100%"></div>
</body>
</html>
