<?php

namespace App\Http\Controllers;

use App\Http\Adapters\LinksAdapter;
use App\Http\Requests\CreateRequest;
use App\Services\ShortLinkService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * @var LinksAdapter
     */
    private LinksAdapter $adapter;

    public function __construct(LinksAdapter $adapter)
    {
        $this->adapter = $adapter;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createShortUrl(CreateRequest $request)
    {
        $data = $this->adapter->setData($request);

        return back()->with('shortUrl' , $data['shortUrl'])->with('token', $data['token']);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectUrl($token)
    {
        $url = $this->adapter->getData($token);
        if (!$url) abort('404');

        return redirect()->to($url);
    }
}
