<?php

namespace App\Http\Controllers;

use App\Notifications\Wechat;
use App\User;
use App\WalkRoute;
use App\WxTemplate;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * 发送消息通知
     * @param Request $request
     * @return string
     */
    public function result(Request $request)
    {
        $user = User::current();

        if ($user->group_id === null)
            return StandardFailJsonResponse('你还没有加入');

        $group = $user->group()->first();
        $group['route'] = WalkRoute::find($group['route_id'])->name;
        unset($group['route_id']);

        return StandardJsonResponse(1, 'Success', $group);

    }
}
