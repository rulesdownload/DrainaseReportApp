<div>
        <div class="row justify-content-center">
                <div class="m-2 col">   
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title pt-3">Map</h5>
                        </div>
                        <div wire:ignore class="card-body form-group">
                            <div wire:ignore id="maps" class="p-2 bd-highlight" style=" width: 100%; height: 300px; float: left;"></div>
                        </div>
                    </div>
                </div>
    </div>
<div>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">
			No
      	   <a href="#"wire:click="sorting('id','asc')">&uarr;</a>
		   <a href="#"wire:click="sorting('id','desc')">&darr;</a>
	  </th>
      <th scope="col">
      	Deskripsi Masalah
      </th>
      <th scope="col">
	       <a href="#"wire:click="sorting('city_id','asc')">&uarr;</a>
		   <a href="#"wire:click="sorting('city_id','desc')">&darr;</a>
	       Kecamatan
  	  </th>      <th scope="col">
	       <a href="#"wire:click="sorting('district_id','asc')">&uarr;</a>
		   <a href="#"wire:click="sorting('district_id','desc')">&darr;</a>
	       Kelurahan
  	  </th>
      <th scope="col">
	       <a href="#"wire:click="sorting('status_id','asc')">&uarr;</a>
		   <a href="#"wire:click="sorting('status_id','desc')">&darr;</a>
	       Status Laporan
  	  </th>
      <th scope="col">
	      <a href="#"wire:click="sorting('problem_id','asc')">&uarr;</a>
		  <a href="#"wire:click="sorting('problem_id','desc')">&darr;</a>
		  Jenis Permasalahan
	  </th>
      <th scope="col">
		  <a href="#"wire:click="sorting('tipe_id','asc')">&uarr;</a>
      	  <a href="#"wire:click="sorting('tipe_id','desc')">&darr;</a>
      	  Tipe Drainase
	  </th>
    </tr>
  </thead>
  <tbody>
    
  		@foreach($lists as $id => $list)
    <tr class="cursor-pointer"  wire:click.prevent="$emitTo('index', 'open', {{ $id }})">
      <div wire:key="{{ $id }}">
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $list->des_mas }}</td>
      <td>{{ $list->city->kecamatan }}</td>
      <td>{{ $list->district->kelurahan }}</td>
      <td>{{ $list->status->parameter}}</td>
      <td>{{ $list->problem->problem }}</td>
      <td>{{ $list->type->tipe}}</td>
      </div>
    </tr>
    	@endforeach
  </tbody>
</table>
        <div class="modal fade" id="detail-post-modal" tabindex="-1" role="dialog" aria-hidden="true">
            @livewire('index')
        </div>
</div>

@section('scripts')
<script type="text/javascript">

	window.livewire.on('toggleGalaxyFormModal', () => $('#detail-post-modal').modal('toggle'));

</script>
@endsection

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.key')}}&libraries=places&callback=initmap"
  type="text/javascript"></script>

<script type="text/javascript">
function initmap(){
		//Center the map to manado.
		const lat = 1.474830;
		const lng = 124.842079;
		const manado = new google.maps.LatLng(lat,lng);
		const map = new google.maps.Map(document.getElementById("maps"),{
			zoom: 12,
			scrollwheel: true,
			panControl: false,
			zoomControl: true,
			mapTypeId: google.maps.MapTypeId.roadmap,
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
		//add some kind of icon for marker when hit the diffrent problem
		const image = [
		{path: 'storage/marker/marker-biru.png'},
		{path: 'storage/marker/marker-putih.png'},
		{path: 'storage/marker/marker-birudongker.png'},
		{path: 'storage/marker/marker-coklat.png'},
		{path: 'storage/marker/marker-cyan.png'},
		{path: 'storage/marker/marker-hijau.png'},
		{path: 'storage/marker/marker-krem.png'},
		{path: 'storage/marker/marker-merah.png'},
		];

		//Retrieve values from JSON to List
		//CHANGES: Multiple marker showed up done.
		//add: problem id as an indicator if the problem is diffrent and changes the marker colours
		var latJSON = JSON.parse(@this.latitudes);
		var lngJSON = JSON.parse(@this.longitudes);
		var markerJSON = JSON.parse(@this.markers);
		var text = 'storage/marker/';
					console.log(markerJSON);


		

		for(var i = 0; i < latJSON.length;i++){
			var lats = latJSON[i];
			var lngs = lngJSON[i];
			var markers = markerJSON[i];
			var latsObject = Object.values(lats);
			var lngsObject = Object.values(lngs);
			var marksObject = Object.values(markers);
			var marksValue = marksObject[1];
			console.log(marksValue);
			var latitudeValue = latsObject[0];
			var longitudeValue = lngsObject[0];
			var problemValue = latsObject[1];
			// var imagesObject = Object.values(image[problemValue]);
			var images = text+marksValue;
			const marker = new google.maps.Marker({
				position: new google.maps.LatLng(latitudeValue,longitudeValue),
				map,
				icon: images,	
				title: String(i+1)
			})
	
		}
	}
</script>

