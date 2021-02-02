<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Repositories\MarkerRepository;
use App\Models\Marker;
use App\Models\Comment;

class HomeController extends SiteController
{
    protected $scripts = false; // Variable for adding scripts on the page

    public function __construct(MarkerRepository $m_rep) 
    {
        $this->m_rep = $m_rep;
    }  

    // Function to display the main page of the site
    public function index()
    {   
        $this->title = 'Main page';
        $this->template = config('settings.theme').'.index';    
        $this->navigation = view(config('settings.theme').'.navigation')->render();
        $this->scripts = view(config('settings.theme').'.scripts')->render();   
        $this->globalArr = Arr::add($this->globalArr, 'scripts', $this->scripts);
        
        return $this->renderOutput();
    }

    // Function to display concrete marker by his id
    public function show($id)
    {
        $marker = Marker::find($id);
        $comments = Comment::where('marker_id', $id)->get();

        $this->navigation = view(config('settings.theme').'.navigation')->render();
        $this->title = 'Info about marker with id - '.$id;
        $this->template = config('settings.theme').'.marker';
        $this->content = view(config('settings.theme').'.marker_content')->with(['marker'=> $marker, 'comments' => $comments]);

        return $this->renderOutput();
    }
}
