<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post_raw;
use Illuminate\Http\Request;

class ListDashboard extends Component
{
	public $lists = [];
	public $latitudes = [];
	public $longitudes = [];
	public $latarray = [];
	public $lngarray = [];
	protected $listener = ['DetailPost'];

	public function mount()
	{

		$this->lists = Post_raw::all();

		$this->latarray = Post_raw::all('lat','problem_id')->toJSON();
		$this->lngarray = Post_raw::all('lng','problem_id')->toJSON();
		$this->dispatchBrowserEvent('latitude-loaded',[
			'latitudes' => $this->latitudes = $this->latarray
		]);

		// dd($this->latitudes);

		$this->dispatchBrowserEvent('longitude-loaded',[
			'longitudes' => $this->longitudes = $this->lngarray
		]);

	}

    public function DetailPost()
    {

    	$this->emit('toggleGalaxyFormModal');

    }

    public function render()
    {
        return view('livewire.list-dashboard');
    }
}
