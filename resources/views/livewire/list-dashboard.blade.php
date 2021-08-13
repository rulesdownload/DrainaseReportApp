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
		  <th scope="col">Latitude</th>
		  <th scope="col">Longitude</th>
	    </tr>
	  </thead>
	  <tbody>
	    
	  		@foreach($lists as $id => $list)
	    <tr class="cursor-pointer"  wire:click.prevent="$emitTo('index', 'open', {{ $id }})">
	      <div wire:key="{{ $id }}">
	      <th scope="row">{{ $loop->iteration }}</th>
	      <td>{{ $list->des_mas }}</td>
	      <td>{{ $list->des_lok }}</td>
	      <td>{{ $list->status->parameter}}</td>
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

//Makes function to show multiple marker based on input data.
function initialize(){
		//Center the map to manado.
		const lat = 1.474830;
		const lng = 124.842079;
		const manado = new google.maps.LatLng(lat,lng);
		const map = new google.maps.Map(document.getElementById("map"),{
			zoom: 12,
			scrollwheel: true,
			panControl: false,
			zoomControl: true,
			mapTypeId: google.maps.MapTypeId.HYBRID,
			center: manado,
			styles: [ 
			{ 
			"featureType": "poi", 
			"stylers": [ 
				{ "visibility": "off" } 
			] 
			} 
		] 
		});


		//Retrieve values from JSON to List
		//CHANGES: Multiple marker showed up done.
		var latJSON = JSON.parse(@this.latitudes);
		var lngJSON = JSON.parse(@this.longitudes);
		
		for(var i = 0; i < latJSON.length;i++){
			var lats = latJSON[i];
			var lngs = lngJSON[i];
			var latsObject = Object.values(lats);
			var lngsObject = Object.values(lngs);
			var latitudeValue = latsObject[0];
			var longitudeValue = lngsObject[0];

			const marker = new google.maps.Marker({
				position: new google.maps.LatLng(latitudeValue,longitudeValue),
				map,
				title: String(i+1)
			})
	
		}

	}
</script>
