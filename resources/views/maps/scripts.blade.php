<script
    src="https://maps.googleapis.com/maps/api/js?key={{ config('settings.gmaps_api_key') }}&callback=initMap&libraries=&v=weekly"
    defer
></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style type="text/css">
    /* Always set the map height explicitly to define the size of the div
    * element that contains the map. */
    #map {
    height: 1000px;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
    height: 100%;
    margin: 0;
    padding: 0;
    }
</style>
<script>

  function initMap() 
  {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 6,
      center: {lat: 50.449218, lng: 30.525824},
    });

    axios.get('/api/markers')
      .then((response) => {
          return OutputFromDB(response.data, map)
      })
      .catch((error) => console.log(error))
  }

  
  function OutputFromDB(data, map) 
  {
    data.forEach((item) => {
      let latLng = {lat: item.lat, lng: item.lng};
      const marker = new google.maps.Marker({
      position: latLng,
      map: map,
      });

      let contentString = `<a href="/markers/${item.id}">View marker information</a>`;

      const infowindow = new google.maps.InfoWindow({
        content: contentString,
      });

      marker.addListener("click", (e) => {
        infowindow.open(map, marker);
        console.log(marker);
      });
    });
  }
</script>
