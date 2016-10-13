
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
      var airports = JSON.parse(xhttp.responseText);
      //console.log(airports);
      for (var i = 0; i<airports["airport"].length; i+=2) {
	var airport_name = airports["airport"][i]["name"];
	var airport_code = airports["airport"][i]["code"];
	document.getElementById("left").innerHTML += "<div onClick='showAirportInfo()'><a href='#'>" + airport_name + " (" + airport_code + ")</a></div>";
      }
    }
  };
  
};


function showAirportInfo (/*your parameters*/) {

  document.getElementById("right").innerHTML = "Hello";
   
}

window.onload = showAirports();
