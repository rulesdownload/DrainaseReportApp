<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post_raw;
use App\Models\City;
use App\Models\District;
use App\Models\additionalphotos;
use App\Models\Comment;
use Livewire\WithFileUploads;
class Index extends Component
{

	protected $listeners = ['open'=>'loadPosts', 'CommentCreated'];
	public $cities = [];
	public $districts= [];
	public $posts = [];
	public $postId = [];
	public $reports;
	public $latitude;
	public $longitude;
	public $renderedLater;
	public $photos = [];

	//komentar
	public $created_at;
	public $comment_input;
	public $commentprompt;

	public function loadPosts($uid, $renderedLater = false)
	{
		// return view('livewire.index', [
			// $this->'posts' => Post_raw::all()->get($uid),
		// ]);			
		// $reports = Post_raw::where('id',$uid)->first();


			// $detail = Post_raw::find($this->detail_id);
		// $reports = Post_raw::where('id',$uid)->first();
		// $this->posts = $repots->get($uid) ?? '';
		// return Post_raw::all($this->reports)->get($uid);	
		// $reports = Post_raw::where('id',$uid)->first();
		// $this->posts($reports->get($uid));

		$reports = Post_raw::all()->get($uid);
		$this->posts = $reports;
		$this->postId = $reports->id;
		$this->renderedLater = $renderedLater;

		$this->dispatchBrowserEvent('latitude-loaded', ['alat' => $this->latitude = $reports->lat]);
		$this->dispatchBrowserEvent('longitude-loaded', ['alng' => $this->longitude = $reports->lng]);

		$this->photos = additionalphotos::where('post_raw_id', $reports->id)->get();

		// binding Kecamatan dan Kelurahan berdasarkan post yang dipilih user
		$this->cities = City::where('id', $reports->city_id)->get();
    	$this->districts = District::where('id', $reports->district_id)->get();

		$this->emit('toggleGalaxyFormModal');
	}

	protected function rules()
	{
		return[
			
		    'comment_input' =>'',	
		];
	}

    public function CommentCreated()
    {
        $this->commentprompt = "Komentar berhasil terkirim";

    }

    public function addComment()
    {
        Comment::create([
            'komentar' => $this->comment_input,
            'user_id'=> auth()->user()->id,
            'post_raw_id' => $this->posts->id,
        ]);

		$this->emit('CommentCreated');
        $this->reset('comment_input');
    }

	public function render()
	{
 
		return view('livewire.index', [
			'koment'=> Comment::all()
		]);

	}
}
