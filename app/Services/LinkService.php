<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class LinkService
{
    protected function getCode(): string
    {
        $code = Str::random(6);

        if ($this->find($code)) {
            $code = $this->getCode();
        }

        return $code;
    }

    public function get(?int $user_id = null): \Illuminate\Database\Eloquent\Collection|array
    {
        return Link::query()
            ->when($user_id, fn($query, $user_id) => $query->where('user_id', $user_id))
            ->get();
    }

    public function store(array $attributes)
    {
        $attributes['code'] = $this->getCode();
        $link = Link::create($attributes);

        if (!auth()->check()) {
            $clientIp = request()->getClientIp();
            Redis::set('link:' . $clientIp, $link, 'EX', 5);
        }

        return $link;
    }

    public function find(string $code): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|null
    {
        return Link::query()->where('code', $code)->first();
    }
}
