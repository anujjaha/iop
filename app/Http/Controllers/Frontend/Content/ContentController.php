<?php

namespace App\Http\Controllers\Frontend\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Content\EloquentContentRepository;

class ContentController extends Controller
{
    public $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EloquentContentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.content.home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function info($slug)
    {
        $content = $this->repository->getBySlug($slug);

        if(isset($content))
        {
            return view('frontend.content.home')->with([
                'content' => $content,
                'counter'   => $this->repository->contentCounter($content)
            ]);    
        }
        return redirect('/');
    }
}
