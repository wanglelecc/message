<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use EasyWeChat\Foundation\Application;
use EasyWeChat;


class WechatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎关注 overtrue！";
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }

    //
    public function index(){
        return view('wechat.index');
    }

    public function message(Application $wechat){
        $notice = $wechat->notice;

        $result = $notice->send([
            'touser' => 'oKZ5et5tJ_yaY8ZOGzFYOn8wdmyg',
            'template_id' => '8e8-3474tkDGjhxRyGDZHnmYkl574kfqtA1NXvMZXW0',
            'data' => [
                "first" => "奥，又出现故障啦...",
                "level" => '紧急',
                "node" => 'sms',
                "content" => 'send sms error, code:5038739',
                "frequency" => '998',
                "date" => date("Y-m-d H:i:s"),
                "remark" => '请尽快处理.',
            ],
        ]);

        return $result;
    }

    public function message2(){

//        $wechat =app('wechat');
//        $notice = $wechat->notice;

        $notice = EasyWeChat::notice();

        $result = $notice->send([
            'touser' => 'oKZ5et5tJ_yaY8ZOGzFYOn8wdmyg',
            'template_id' => '8e8-3474tkDGjhxRyGDZHnmYkl574kfqtA1NXvMZXW0',
//          'url' => $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'],
            'data' => [
                "first" => "奥，又出现故障啦...",
                "level" => '紧急',
                "node" => 'sms',
                "content" => 'send sms error, code:5038739',
                "frequency" => '998',
                "date" => date("Y-m-d H:i:s"),
                "remark" => '请尽快处理.',
            ],
        ]);

        return $result;
    }
}
