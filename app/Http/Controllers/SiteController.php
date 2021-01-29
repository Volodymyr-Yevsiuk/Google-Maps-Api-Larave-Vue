<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SiteController extends Controller
{

    protected $m_rep; // Змінна MarkerRepository

    protected $title = 'Default page'; // Змінна відображення назви сторінки
    protected $template; // Змінна, яка містить шлях шаблону сторінки
    protected $content = false; // Змінна, яка містить у собі контент сторінки
    protected $navigation = false; // Змінна, яка містить у собі панель навігації

    protected $globalArr = [];  // Глобальний масив, який передає дані у шаблон



    protected function renderOutput() {

        $this->globalArr = Arr::add($this->globalArr, 'title', $this->title); 

        $this->globalArr = Arr::add($this->globalArr, 'navigation', $this->navigation);

        if($this->content) {
            $this->globalArr = Arr::add($this->globalArr, 'content', $this->content);
        } 

        return view($this->template)->with($this->globalArr);

    }

}
