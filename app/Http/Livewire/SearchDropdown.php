<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';
    public function render()
    {
        $apiToken = env('API_TOKEN');
        $baseUrl=env('BASE_URL');

        $searchResults= [];

        if (strlen($this->search) >=2) {
            $searchResults= Http::withToken($apiToken)
            ->get( 'https://api.themoviedb.org/3/search/movie?query='.$this->search)
            ->json(['results']);
        }
        
        // dump($searchResults);
    

        return view('livewire.search-dropdown',[
            'searchResults'=>collect($searchResults)->take(7),
        ]);
    }
}
