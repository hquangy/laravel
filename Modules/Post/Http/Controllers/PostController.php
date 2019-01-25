<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Post;


class PostController extends Controller
{
    use ValidatesRequests;
    protected $pre_view = 'post::be.post.';
    protected $pre_route = 'be.post.';
    protected $pre_temp = 'backend.layout.temp';
    protected $title = 'Bài viết';
    protected $fields = 'Bài viết';

    // model
    protected $Post;

    public function __construct()
    {
        $this->Post = new Post;

        $this->middleware(function ($request, $next){
            view()->share('pre_view', $this->pre_view);
            view()->share('pre_route', $this->pre_view);
            view()->share('pre_temp', $this->pre_temp);
            view()->share('title', $this->title);
            return $next($request);
        });
    }

    public function index()
    {
        $items = $this->Post->where('id' , 1)->renderItems(10);

        dd($items);

        return view($this->pre_view . __FUNCTION__ );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('bepost::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('bepost::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('bepost::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
