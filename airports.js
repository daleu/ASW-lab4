
var uri = "http://localhost:8080/waslab04";

function showAirports () {
  var country = document.getElementById("countryName").value;

  // Replace the two lines below with your implementation
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET",uri+"/airport_names.php?country="+country, true);
  xhttp.setRequestHeader("Content-Type", "text/json");
  xhttp.send();
  
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //Mostrar el llistat de aeroports al lateral
      var airports = JSON.parse(this.responseText);
      var html = '';
      for (var i = 0; i<airports.length; ++i) { 
		var name = airports[i]["name"]; 
		var code = airports[i]["code"]; 
		html +="<div><a href='javascript:showAirportInfo("+'"'+code+'"'+")'>" + name + " (" + code + ")</a></div>"; 
		
      }
      document.getElementById("left").innerHTML = html;
    }
  };
};


function showAirportInfo (code) {

  var xhttp = new XMLHttpRequest();
  xhttp.open("GET",uri+"/airport_info.php?code="+code, true);
  xhttp.setRequestHeader("Content-Type", "text/json");
  xhttp.send();
  
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	  var info = JSON.parse(this.responseText);
	  var header = "<h1>Airport of " + info["CityOrAirportName"] + " (" + info["AirportCode"] + ")</h1>";
	  var list = "<ul>" +
	  "<li>Runway length: <b>"+ info["RunwayLengthFeet"] + "</b> feet</li>" + 
	  "<li>Runway Elevation: <b>"+ info["RunwayElevationFeet"] + "</b> feet</li>" + 
	  "<li>Coordinates: <b>"+ info["LatitudeDegree"] +"º"+info["LatitudeMinute"]+"'"+info["LatitudeSecond"]+"'' "+ info["LatitudeNpeerS"]+", "+
							+ info["LongitudeDegree"]+"º"+info["LongitudeMinute"]+"'"+info["LongitudeSeconds"]+"'' "+info["LongitudeEperW"]+"</b></li></ul>";
							
	  document.getElementById("right").innerHTML = header + list;
    }
  };
   
}

window.onload = showAirports();
