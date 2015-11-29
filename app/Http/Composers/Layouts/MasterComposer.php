<?php namespace App\Http\Composers\Layouts;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class MasterComposer {

    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function compose(View $view) {
        $path = $this->request->path();

        $view->path    = $path;
        $view->date    = date('Y');
        $view->title   = 'AdBuilder';
        $view->company = 'Media Solutions Corporation';
    }

}
