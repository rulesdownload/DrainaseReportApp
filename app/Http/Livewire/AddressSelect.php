<?php

namespace App\Http\Livewire;

use App\Models\Post_raw;
use App\Models\City;
use App\Models\District;
use App\Models\additionalphotos;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;  

class AddressSelect extends Component
{

	public $city;
	public $districts=[];
	public $district;
    public $des_lok, $des_mas, $lat, $lng, $latitude, $longitude;
    public $prompt;
    public $modelId;
    public  $photos = [];
    use WithFileUploads;
    protected $listeners = [
        "refreshParent", 
        "getLatitudeForInput",
        "getLongitudeForInput",
        "getModelId"
    ];


        protected $messages = [
        'city.required' => 'Kecamatan tidak boleh kosong.',
        'district.required' => 'Kelurahan tidak boleh kosong.',
        'des_lok.required' => 'Deskripsi lokasi tidak boleh kosong.',
        'des_mas.required' => 'Deskripsi masalah tidak boleh kosong.',
        'lat.required' => 'Belum memilih titik lokasi silahkan tekan tombol Buka Map',
        'lng.required' => 'Belum memilih titik lokasi silahkan tekan tombol buka Map.',
        'photo' => 'Masukan bukti foto',

    ];
    protected function rules() {
        return [ 

        'city' =>'required',
        'district' =>'required',
        'des_lok'=>'required',
        'des_mas'=>'required',
        'lat' => 'required',
        'lng' =>'required',
        'photos.*' => 'image|max:1024|required',
        ];
    }

    public function removeImg($index){
        array_splice($this->photos, $index);
    }

    public function refreshParent()
    {
        $this->prompt ="Laporan anda berhasil dibuat, silahkan tunggu admin untuk mengkonfirmasi laporan anda";
    }
	
    public function getLatitudeForInput($value) 
    {

    if(!is_null($value))
        $this->lat = $value;
        
    }

    public function getLongitudeForInput($value)
    {
        if(!is_null($value) )
            $this->lng = $value;
    }

    public function render()
    {
    	if(!empty($this->city)) {
    		$this->districts = District::where('cities_id', $this->city)->get();
    	}

        return view('livewire.address-select')
        	->withCities(City::orderBy('kecamatan')->get());
    }

    public function getModelId($modelId){

        $this->modelId = $modelId;
        $model = Post_raw::find($this->modelId);

    }


    public function store()
    {
        $this->validate();


        if ($this->modelId) {
            Post_raw::find($this->modelId);
            $postInstanceId  = $this->modelId;
        } 
        else {
            $postInstance = Post_raw::create([
            'city_id' => $this->city,
            'district_id' => $this->district,
            'des_lok' => $this->des_lok,
            'des_mas' => $this->des_mas,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'user_id' => auth()->user()->id,
            'status_id'=>1,
            'problem_id'=>1,
            'tipe_id'=>1,
        ]);
            $postInstanceId = $postInstance->id;
        }

        foreach ($this->photos as $photo) {
            $photo->store('additional_photos','public');

            additionalphotos::create([
                'post_raw_id' => $postInstanceId,
                'filename' => $photo->hashName()
            ]);
        }

        $this->emit('refreshParent');
    }
}
