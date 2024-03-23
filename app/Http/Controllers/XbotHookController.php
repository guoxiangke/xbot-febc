<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Services\Xbot;



class XbotHookController extends Controller
{
    public function __invoke(Request $request){
        // 验证消息
        if(!isset($request['msgid']) || $request['self'] == true)  return $this->_return();

        $wxidOrCurrentRoom = $request['wxid'];
        $isRoom = Str::endsWith($wxidOrCurrentRoom, '@chatroom');
        // personal
        $this->wxid = $wxidOrCurrentRoom;
        $this->remark = Str::replace("\n", '', $request['remark']);
        $this->remark = Str::replace(":", '', $request['remark']);
        if($isRoom){
             $this->wxid = $request['from'];
             $this->remark = $request['from_remark'];
        }
        // $this->cache = Cache::tags($this->wxid);
		$adminGroupWxid = config('febc.group.forward.from'); //测试群
		$groupsToForward = config('febc.group.forward.to');
		$msgid = $request['msgid'];
		//TODO  && msg_type = Link!
    	if($isRoom && $wxidOrCurrentRoom == $adminGroupWxid){
			$msg = [
				'type' => 'forward',
				'to' => 'filehelper',
				'data' => compact('msgid'),
			];
			collect($groupsToForward)->each(function($wxid) use($msg){
				$msg['to'] = $wxid;
				$this->send($msg);
			});
    	}

        $keyword = $request['content'];

        
        $adminGroupWxid = config('febc.group.forward2.from'); //测试群
        $groupsToForward = config('febc.group.forward2.to');
        if($isRoom && $wxidOrCurrentRoom == $adminGroupWxid){
            $msg = [
                'type' => 'forward',
                'to' => 'filehelper',
                'data' => compact('msgid'),
            ];
            collect($groupsToForward)->each(function($wxid) use($msg){
                $msg['to'] = $wxid;
                $this->send($msg);
            });
        }

        return $this->_return();
  
    }

    private function _return(){
        return response()->json(null);
    }

    // $msg = [
    //     'type' => 'text',
    //     'to' => $wxid,
    //     'data' => [
    //         'content' => $content
    //     ],
    // ];

    // $msg = [
    //     'type' => 'forward',
    //     'to' => $wxid,
    //     'data' => [
    //         'msgid' => $msgid
    //     ],
    // ];
    private function send($msg){
	    return Http::withToken(config('febc.xbot.token'))
	            ->post(config('febc.xbot.endpoint'), $msg);
    }

}
