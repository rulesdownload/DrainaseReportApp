<div >

   
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Buka Map
    </button>
            @error('lat') <span class="error">{{ $message }}</span> @enderror
    <form wire:submit.prevent="store">

        <div class="form-group " >

          <div class="relative mt-1 mb-4" >
        		<label for="city"> Kecamatan </label>
        			<div class="mt-1 mb-4 border rounded-md">
            	<select 
              name="city" 
              wire:model="city" 
              class="mt-1 mb-4 w-full outline-primary" >
            		<option value=''>Pilih Kecamatan</option>
            		@foreach($cities as $city)
            			<option value={{ $city ->id}}>{{ $city->kecamatan }}</option> 
            		@endforeach
            	</select>
                @error('city') <span class="error">{{ $message }}</span> @enderror
                	</div>
          </div>

          <div class="mt-1 mb-4">            
            <label for="district"> Kelurahan </label>
              <div class="mt-1 mb-4 border rounded-md">
            	<select 
              name="district" 
              wire:model="district"
              class="mt-1 mb-4 w-full outline-primary" >
            		<option value=''>Pilih Kelurahan</option>
            		@foreach($districts as $district)
            			<option value={{ $district ->id}}>{{ $district->kelurahan }}</option> 
            		@endforeach
            	</select>
                  @error('district') <span class="error">{{ $message }}</span> @enderror
             </div>
          </div>

        </div>

    <div class="form-group">  
     <label for="des_lok"> Masukan deskripsi Lokasi </label>
        <div class="mt-1 mb-4 pl-1 pt-1 pb-1 " >   
        <textarea class="resize-none border rounded-md focus:outline-none w-full" placeholder="Dijalan maesa, depan rumah makan kios bakmi.." name="des_lok"  wire:model="des_lok" wire:ignore></textarea>
        @error('des_lok') <span class="error">{{ $message }}</span> @enderror
        </div>
     </div>

     <div class="form-group">  
     <label for="des_mas">Deskripsi Masalah</label>
        <div class="mt-1 mb-4 pl-1 pt-1 pb-1 " >   
        <textarea class="resize-none border rounded-md focus:outline-none w-full" placeholder="Sudah seminggu air diselokan tidak mengalir jika hujan maka air tumpah dijalan. " wire:model="des_mas"></textarea>
        @error('des_mas') <span class="error">{{ $message }}</span> @enderror
        </div>
  
    </div>

        <label for="photo_input"> Masukan Gambar </label>
        <input type="file" wire:model="photos" multiple>
    <div class="flex">
    @if ($photos)
        Photo Preview:
        @foreach($photos as $photo)
        <i wire:click.prevent="removeImg({{$loop->index}})">X</i>
        <img width="62" height="22" class="responsive p-2" src="{{ $photo->temporaryUrl() }}">

        @endforeach
    </div>
    @endif


    @error('photos.*') <span class="error">{{ $message }}</span> @enderror

    <div class="form-group" >
        <label for="latitudehide">latitude</label>
        <input id="latitudehide" name="latitudehide" wire:model="lat" wire:model="lat"  >

        <label for="longitudehide">longitude</label>
        <input id="longitudehide" name="longitudehide" wire:model="lng" wire:model="lng" >
    </div>

     <label for="status_id"></label>
     	<input type="text" name="status_id" class="">

    <button type="submit" class="btn btn-sm btn-primary" >Submit</button>

    </form>
    {{$prompt}}
    <!-- Button trigger modal -->

<!-- Modal Buka map -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
        <input id="pac-input" type="text" placeholder="cari lokasi">
        <div wire:ignore id="map" class="mb-2" style=" width: 500px; height: 400px; float: left;"></div>


        <input wire:ignore id="infolat" value="as" type="text" name="infolat" class="hidden">
        <input wire:ignore id="infolng" value="rs" type="text" name="infolng" class="hidden">
        <div id="infoPanel" class="hidden">
        <b>Marker status:</b>
        <div id="markerStatus"><i>Click and drag the marker.</i></div>
        <b>Current position:</b>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button onclick="myFunction()" id="save" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
          </div>
        </div>
      </div>
    </div>

</div>

@section('scripts')
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.key')}}&libraries=places&callback=initialize"
  type="text/javascript"></script>
 <script src="{{ asset('js/mapInput.js') }}" defer></script>

<script >
// supaya menu dalam searchbox tidak membelakangi modal
var pacContainerInitialized = false;
$("#pac-input").keypress(function() {
  if (!pacContainerInitialized) {
    $(".pac-container").css("z-index", "9999");
    pacContainerInitialized = true;
  }
});

// ambil data latitude dan longitude dari input yang dimodal
    function myFunction() {
      var lat = document.getElementById("infolat").value;
      var lng = document.getElementById("infolng").value;

    // ambil value lewat DOM, tidak cocok buat livewire
      // x.setAttribute("value",lat );

    // agar Javascript dapat berkomunikasi dng Livewire
      Livewire.emit('getLatitudeForInput',lat);
      Livewire.emit('getLongitudeForInput',lng);

    //memasukan value pada text input, tidak cocok dgn livewire
      // document.getElementById("infolat").value ;
      // document.getElementById("latutudehide").value = document.getElementById("infolat").value ;
      // document.getElementById("infolng").value ;
      // document.getElementById("longitudehide").value = document.getElementById("infolng").value ;
    }
 // Enter button disabling 
    $(document).keypress(
         function(event){
            if (event.which == '13') {
         event.preventDefault();
    }
});

</script> 
@endsection

