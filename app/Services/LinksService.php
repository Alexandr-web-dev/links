<?php


namespace App\Services;


use App\Models\Link;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class LinksService
{
    private static int $unLimited = -1;
    /**
     * Сохраняем ссылку
     * @param string $link
     * @param int $limit
     * @param int $time
     * @return mixed
     */
    public static function saveLink(string $link, int $limit, int $time): string
    {
        $token = ShortLinkService::generateToken();
        $limit = $limit == 0 ? self::$unLimited : $limit;

        $link = Link::create([
            'token'=> $token,
            'link'=> $link,
            'limit' => $limit,
            'time' => $time,
            'expires' => now()->addHour($time)
        ]);

        return $link->token;
    }

    /**
     * Проверяем сохраняем лимит
     * @param string $token
     * @return bool|mixed
     */
    public static function checkLimitFollow(string $token)
    {
        $link = self::getLink($token);
        if ($link == null) return false;

        if ($link->limit == self::$unLimited) {
            return $link->link;
        } elseif ($link->limit > 0) {
            $link->limit--;
            $link->save();

            return $link->link;
        }
    }


    /**
     * @param string $token
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function getLink(string $token)
    {
        $link = Link::query()
                ->where('limit','>', 0)
                ->orWhere('limit', self::$unLimited)
                ->where('token', $token)
                ->where('expires', '>', Carbon::now()->toDateTime())
                ->first();

        return $link;
    }
}
