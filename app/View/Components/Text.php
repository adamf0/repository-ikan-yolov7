<?php

namespace App\View\Components;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Text extends Component
{
    /**
     * Create a new component instance.
     */
    public $title=false;
    public $name;
    public $default=false;
    public $class='';
    public function __construct($title=false,$name,$default=false,$class='')
    {
        // if($title==null) throw new Exception('title in component indicator cannot be null'); 
        if($name==null) throw new Exception('name in component indicator cannot be null'); 

        $this->title = $title;
        $this->name = $name;
        $this->default = $default;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text',[
            'title'=>$this->title,
            'name'=>$this->name,
            'default'=>$this->default,
            'class'=>$this->class,
        ]);
    }
}
