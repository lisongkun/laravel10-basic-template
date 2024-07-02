<?php

namespace App\Http\Controllers\ThirdParty;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class WechatController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.');

        $server = app('easywechat.official_account')->getServer();

        $server->with(function ($message) {
            return "欢迎关注！";
        });

        return $server->serve();
    }
}
