<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SiteController extends Controller
{

    protected $m_rep; // Variable MarkerRepository

    protected $title = 'Default page'; // Variable to show the title of the page
    protected $template; //  Variable which contains the path of page template 
    protected $content = false; // Variable which contains the page content
    protected $navigation = false; // Variable which contains the site navigation 

    protected $globalArr = [];  // A global array that passes data to a template


    // Function which return specific view for different pages
    protected function renderOutput() {

        $this->globalArr = Arr::add($this->globalArr, 'title', $this->title); 

        $this->globalArr = Arr::add($this->globalArr, 'navigation', $this->navigation);

        if($this->content) {
            $this->globalArr = Arr::add($this->globalArr, 'content', $this->content);
        } 

        return view($this->template)->with($this->globalArr);

    }

}
