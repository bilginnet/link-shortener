<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortenerStoreRequest;
use App\Models\Link;
use App\Services\LinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ShortenerController extends Controller
{
    protected ?LinkService $linkService = null;
    public function __construct()
    {
        $this->linkService = app()->get(LinkService::class);
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $params = [];
        $clientIp = request()->getClientIp();
        if (auth()->check()) {
            $params['links'] = $this->linkService->get(auth()->id());
        } else if (Redis::exists('link:'.$clientIp) && $link = Redis::get('link:'.$clientIp)) {
            $params['last'] = json_decode($link, true);
        }

        return view('home', $params);
    }

    public function store(ShortenerStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->linkService->store($request->validated());

        return redirect()->route('home');
    }

    public function show(Request $request, Link $link): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        return redirect($link->url);
    }
}
