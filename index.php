<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Web App Project</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyD-S_0uiHyZTtdR7-wxgOIHuRHfnh12c6I"></script>

<style>
    .bs-example{
        margin: 20px;        
    }
</style>
</head>
<body>
<div class="bs-example">
   
    <form action="#"  method="post">
        <div class="form-group">
            <label for="city1">City 1</label>
            <input type="text" class="form-control" id="city1" name="city1" placeholder="Enter the city1" required>
        </div>
        <div class="form-group">
            <label for="city2">City 2</label>
            <input type="text" class="form-control" id="city2" name="city2" placeholder="Enter the city2" required>
        </div>
       
        <button  id="btn"  type="button" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>           


<script>
	//function for getting the distance of radius 

	function distance(lat1, lon1, lat2, lon2, unit) {
	if ((lat1 == lat2) && (lon1 == lon2)) {
		return 0;
	}
	else {
		var radlat1 = Math.PI * lat1/180;
		var radlat2 = Math.PI * lat2/180;
		var theta = lon1-lon2;
		var radtheta = Math.PI * theta/180;
		var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
		if (dist > 1) {
			dist = 1;
		}
		dist = Math.acos(dist);
		dist = dist * 180/Math.PI;
		dist = dist * 60 * 1.1515;
		if (unit=="K") { dist = dist * 1.609344 }
		if (unit=="N") { dist = dist * 0.8684 }
		return dist;
	}
}

//end of fucntion for getting radius

//process for get the lat and long from google api


	$("#btn").click(function(){
		var city1=document.getElementById("city1").value;
		var city2=document.getElementById("city2").value;
		var geocoder = new google.maps.Geocoder();
		
		geocoder.geocode( { 'address': city1}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
		var latitude1 = results[0].geometry.location.lat();
		var longitude1 = results[0].geometry.location.lng();
		}
		else{
		 alert(status);return false;
		}
         }); 
		geocoder.geocode( { 'address': city2}, function(results1, status1) {
        if (status1 == google.maps.GeocoderStatus.OK) {
		var latitude2 = results1[0].geometry.location.lat();
		var longitude2 = results1[0].geometry.location.lng();
		}
		else{
		 alert(status1); return false;
		}

		if(latitude1 && longitude1 && latitude2  && longitude2)
		{
			var get_total_distance=distance(latitude1, longitude1, latitude2, longitude2, 'K');
			if(get_total_distance>5)
			{
				alert(city1+'is not in 5 km radius of '+city2);
			}
			else{
				alert(city1+'is in 5 km radius of '+city2);
			}
		}


         }); 


	});

			
	   
//end of process for getting the lat and long from google api


</script>                 
