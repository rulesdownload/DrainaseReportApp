<div>
        <div class="row justify-content-center">
                <div class="m-2 col">   
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title pt-3">Map</h5>
                        </div>
                        <div class="card-body form-group">
                            <div wire:ignore id="map" class="p-2 bd-highlight" style=" width: 100%; height: 300px; float: left;"></div>
                        </div>
                    </div>
                </div>
    </div>

  <table class="table">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Deskripsi Masalah</th>
	      <th scope="col">Deskripsi Lokasi</th>
	      <th scope="col">Status Laporan</th>
	      <th scope="col">Jenis Permasalahan</th>
	      <th scope="col">Tipe Drainase</th>
	    </tr>
	  </thead>
	  <tbody>
	    
	  		@foreach($lists as $id => $list)
	    <tr class="cursor-pointer"  wire:click.prevent="$emitTo('index', 'open', {{ $id }})">
	      <div wire:key="{{ $id }}">
	      <th scope="row">{{ $loop->iteration }}</th>
	      <td>{{ $list->des_mas }}</td>
	      <td>{{ $list->des_lok }}</td>
	      <td>{{ $list->status->parameter}}}</td>
	      <td>{{ $list->problem->problem }}</td>
	      <td>{{ $list->type->tipe}}</td>
	      <td>{{ $list->lat }}</td>
	      <td>{{ $list->lng }}</td>
	      </div>
	    </tr>
	    	@endforeach
	  </tbody>
</table>
</div>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrFLi96zuuekA3nlI5TllQ--4ktUMvoF8&libraries=places&callback=initialize"
  type="text/javascript"></script>

<script type="text/javascript">

function initialize() {

	var lat = 1.474830;
	var lng = 124.842079;

	var markers = [];
	var lats = @this.latitudes;
	var lngs = @this.longitudes;
	console.log(@this.latitudes);
	console.log(@this.longitudes);
	var latslangs = new google.maps.LatLng(lats, lngs);
	console.log(latslangs);

    var latlng = new google.maps.LatLng(lat, lng);
    var crosshairShape = {
        coords: [0, 0, 0, 0],
        type: 'rect'
      };
  var mapCanvas = document.getElementById('map');
  var mapOptions = {
    center: latlng,
    zoom: 13,
    scrollwheel: false,
    panControl: false,
    zoomControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(mapCanvas, mapOptions);

 //  var marker = new google.maps.Marker({
 //    map: map,
 //    position: latlng,
	// });

   var marker = new google.maps.Marker({
    map: map,
    position: latslangs,
	});
   markers.push(marker);

	 // markers.push(
	 // 	new google.maps.Marker({
	 // 		position: latslangs,
	 // 	})
	 // );

	 function setMapOnAll(map) {
	  for (let i = 0; i < markers.length; i++) {
	    markers[i].setMap(map);
	  }
	}

}

	document.addEventListener('livewire:load', function () {
		google.maps.event.addDomListener(window, "load", initialize);

	});
</script>
