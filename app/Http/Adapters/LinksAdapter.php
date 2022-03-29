<?php


namespace App\Http\Adapters;


use App\Http\Requests\CreateRequest;
use App\Services\LinksService;
use Illuminate\Support\Facades\Cache;

class LinksAdapter
{
    private $service;

    public function __construct()
    {
        $this->service = LinksService::class;
    }

    /**
     * @param CreateRequest $request
     */
    public function setData($request): array
    {
        $token = $this->service::saveLink($request->link, $request->limit, $request->time);
        $shortUrl = request()->root() . '/' . $token;

        return [
            'shortUrl' => $shortUrl,
            'token' => $token
        ];
    }


    public function getData($token): string
    {
        $url = $this->service::checkLimitFollow($token);
        return $url;
    }

}
