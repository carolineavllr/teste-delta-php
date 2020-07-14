<div class="wrapper-map">
  <div id="map"></div>
</div>

<script>
  window.addEventListener('load', function() {
    mapboxgl.accessToken = 'pk.eyJ1IjoiY2Fyb2xpbmVhdmVsbGFyIiwiYSI6ImNrY2wzd2lpdzE1MzAycm8ybnpzeTNyMDAifQ.Hpufd53e2o2Yg83ONLqZhw';
    var input = document.querySelector('#address');
    var coord = document.querySelector('#coord');
    var marker;

    var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: JSON.parse(coord.value), // centro em Porto Alegre
      zoom: 12
    });


    document.querySelector('#search').addEventListener('click', function() {
      fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURI(input.value)}.json?access_token=pk.eyJ1IjoiY2Fyb2xpbmVhdmVsbGFyIiwiYSI6ImNrY2wzd2lpdzE1MzAycm8ybnpzeTNyMDAifQ.Hpufd53e2o2Yg83ONLqZhw`)
      .then(function(response) {
        return response.json();
      })
      .then(function(result) {
        return result.features[0].center
      })
      .then(function(center) {
        marker && marker.remove();
        marker = new mapboxgl.Marker({
          color: '#091D3C',
          })
          .setLngLat(center)
          .setPopup(new mapboxgl.Popup().setHTML("<h1>Local do Ocorrêcia</h1>"))
          .addTo(map)
          

        map.setCenter(center)
        map.zoomTo(15)
        coord.value = center
      })
    })

  })
</script>