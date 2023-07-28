<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    private $profiles;
    public $search;
    public $results;

    public function findProfile($search)
    {
        if ($search != null) {
            $this->profiles = User::where('username', 'LIKE', '%' . $search . '%')->where('id', '<>', auth()->user()->id)->take(5)->get();
        } else {
            $this->profiles = null;
            $this->results = null;
        }
        if ($this->profiles != null) {
            $fields = array();
            $filterd = array();
            foreach ($this->profiles as $profile) {
                $fields['username'] = $profile->username;
                $fields['profile_photo_url'] = $profile->profile_photo_url;
                $filterd[] = $fields;


            }
            $this->results = $filterd;
        } else {
            # code...
        }

    }
    public function render()
    {
        return view('livewire.search');
    }
}