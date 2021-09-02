<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post_raw;
use App\Models\City;
use App\Models\drainaseProblems;
use App\Models\Marker;
use App\Models\District;
use Illuminate\Http\Request;

class ListDashboard extends Component
{
	public $posts = [];
	public $latitudes = [];
	public $longitudes = [];
	public $markers = [];
	public $problems = [];
	public $latarray = [];
	public $lngarray = [];
	public $problemlists = [];
	public $markerlist = [];
	public $sortby = 'id';
	public $direction = 'asc';
	protected $listener = ['DetailPost'];

	public function mount()
	{

		$this->posts = Post_raw::all('problem_id');
		$this->problemlists = drainaseProblems::find($this->posts,'marker_id');
		$this->markerlists = Marker::find($this->problemlists)->toJSON();
		$this->latarray = Post_raw::all('lat','problem_id')->toJSON();
		$this->lngarray = Post_raw::all('lng','problem_id')->toJSON();

		$this->dispatchBrowserEvent('problem-loaded',[
			'problems' => $this->problems = $this->problemlists
		]);

		$this->dispatchBrowserEvent('marker-loaded',[
			'markers' => $this->markers = $this->markerlists
		]);


		$this->dispatchBrowserEvent('latitude-loaded',[
			'latitudes' => $this->latitudes = $this->latarray
		]);


		$this->dispatchBrowserEvent('longitude-loaded',[
			'longitudes' => $this->longitudes = $this->lngarray
		]);
	}
	
	public function sorting($field, $direction)
	{

		$this->sortby = $field;
		$this->direction = $direction;

	}

    public function DetailPost()
    {

    	$this->emit('toggleGalaxyFormModal');

    }

    public function render()
    {

		$lists = Post_raw::orderBy($this->sortby, $this->direction);

        return view('livewire.list-dashboard', [
        	'lists' => $lists->get(),
        ]);
    }
}
