<?php

define("TOKEN", "wechat");

class WeChat {

    public function valid() {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg() {
        //get post data, May be due to the different environments
        $postStr = file_get_contents('php://input');

        //extract post data
        if (!empty($postStr)) {
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
              the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            if (!empty($keyword)) {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            } else {
                echo "Input something...";
            }
        } else {
            echo "";
            exit;
        }
    }

    private function checkSignature() {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

}

/*
 * 微信公众平台操作类
 */

//class WeChat {
//
//    private $_appid;
//    private $_appsecret;
//    private $_token; //公众平台请求开发者是需要
//

//    private $menu = '{
//    "button": [
//        {
//            "name": "商城",
//            "sub_button": [
//                {
//                    "type": "view",
//                    "name": "商城首页",
//                    "url": "http://yilunhuang.eicp.net/shop"
//                },
//                {
//                    "type": "view",
//                    "name": "购物车",
//                    "key": "cart",
//                    "url": "http://yilunhuang.eicp.net/shop/index.php/Home/Cart"
//                }
//            ]
//        },
//        {
//            "name": "发现",
//            "sub_button": [
//                {
//                    "type": "pic_sysphoto",
//                    "name": "最近热卖",
//                    "key": "pic_sysphoto",
//                   "sub_button": [ ]
//                 },
//                {
//                    "type": "pic_photo_or_album",
//                    "name": "拍照或者相册发图",
//                    "key": "pic_photo_or_album",
//                    "sub_button": [ ]
//                },
//                {
//                    "type": "pic_weixin",
//                    "name": "微信相册发图",
//                    "key": "pic_weixin",
//                    "sub_button": [ ]
//                }
//            ]
//        },
//        {
//            "name": "我的",
//            "sub_button" : [
//                {
//                    "name" : "我的订单",
//                    "type": "view",
//                    "url": "http://yilunhuang.eicp.net/shop/index.php/Home/User"
//                },
//                {
//                    "name" : "用户信息",
//                    "type": "view",
//                    "url": "http://yilunhuang.eicp.net/shop/index.php/home/wechat/getbaseinfo"
//                },
//                {
//                    "name" : "查看URL",
//                    "type": "view",
//                    "url": "http://yilunhuang.eicp.net/shop"
//                },
//            ],
//
//        },
//    ]
//}';
//    private $_msg_template = array(
//        'text' => '<xml>
//                <ToUserName><![CDATA[%s]]></ToUserName>
//                <FromUserName><![CDATA[%s]]></FromUserName>
//                <CreateTime>%s</CreateTime>
//                <MsgType><![CDATA[text]]></MsgType>
//                <Content><![CDATA[%s]]></Content>
//                </xml>',
//        'news' => '<xml>
//                    <ToUserName><![CDATA[%s]]></ToUserName>
//                    <FromUserName><![CDATA[%s]]></FromUserName>
//                    <CreateTime>%s</CreateTime>
//                    <MsgType><![CDATA[news]]></MsgType>
//                    <ArticleCount>%s</ArticleCount>
//                    <Articles>%s</Articles></xml> ', //新闻主体
//        'news_item' => '<item>
//                        <Title><![CDATA[%s]]></Title>
//                        <Description><![CDATA[%s]]></Description>
//                        <PicUrl><![CDATA[%s]]></PicUrl>
//                        <Url><![CDATA[%s]]></Url>
//                        </item>', //某个新闻模板
//    );
//
//    public function __construct($id, $secret, $token) {
//        $this->_appid = $id;
//        $this->_appsecret = $secret;
//        $this->_token = $token;
//
//        $this->menusSet($this->menu);
//    }
//
//    public function responseMSG() {
//        //获取请求的是事POST：XML数据
//        $xml_str = file_get_contents('php://input');
////        $xml_str = $GLOBALS["HTTP_RAW_POST_DATA"];
//        var_dump($xml_str);
//        //extract post data
//        if (!empty($xml_str)) {
//            libxml_disable_entity_loader(true); //禁止xml实体解析，防止xml注入
//            $request_xml = simplexml_load_string($xml_str, 'SimpleXMLElement', LIBXML_NOCDATA); //从字符串获取xml对象
//            //判断消息类型通过MsgType
//            switch ($request_xml->MsgType) {
//                case 'event': //事件类型
//                    $event = $request_xml->Event;
//                    if ('subscribe' == $event) { //关注事件
//                        $this->_doSubscribe($request_xml);
//                    } elseif ('CLICK' == $event) {//菜单点击事件
//                        $this->_doClick($request_xml);
//                    } elseif ('VIEW' == $event) {//链接跳转事件
//                        $this->_doView($request_xml);
//                    }
//                    break;
//                case 'text':  //文本类型
//                    $this->_doText($request_xml);
//                    break;
//                case 'image':
//                    $this->_doImage($request_xml);
//                    break;
//                case 'location':
//                    $this->_doLocation($request_xml);
//                    break;
//            }
//        } else {
//            //如果没有post数据，则响应空数据，表示结束
//            echo "";
//            exit;
//        }
//    }
//
//    /**
//     *
//     * @param type $request_xml
//     */
//    private function _doClick($request_xml) {
//        $response_content = '你点击了菜单，携带的KEY为：' . $request_xml->EventKey;
//        $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
//    }
//
//    /**
//     *  用于处理位置信息
//     */
//    private function _doLocation($request_xml) {
////        $content = '你的经度为'.$request_xml->Location_X.'，纬度为'.$request_xml->Location_Y."\n".'所在位置为'.$request_xml->Label;
////        $response = sprintf($text, $request_xml->FromUserName, $request_xml->ToUserName, time(), $content);
////        echo $response;exit;
//        //利用位置获取信息
//        //百度LBS圆形范围查询
//        $url = 'http://api.map.baidu.com/place/v2/search?query=%s&location=%s&radius=%s&output=%s&ak=%s';
//        $query = '银行';
//        $location = $request_xml->Location_X . ',' . $request_xml->Location_Y;
//        $radius = 2000;
//        $output = 'json';
//        $ak = 'nBjNQbwzd0W2woSCSeK9HiSwMGHRhBr0';
//        $url = sprintf($url, urldecode($query), $location, $radius, $output, $ak);
//        $result = $this->_requestPost($url, false);
//        $result_obj = json_decode($result);
//        foreach ($result_obj->results as $re) {
//            $r['name'] = $re->name;
//            $r['address'] = $re->address;
//            $re_list[] = implode('-', $r);
//        }
//        $re_str = implode("\n", $re_list);
//        $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $re_str);
//    }
//
//    /*
//     * 处理图片响应数据
//     */
//
//    private function _doImage($request_xml) {
//        $text = '<xml>
//                <ToUserName><![CDATA[%s]]></ToUserName>
//                <FromUserName><![CDATA[%s]]></FromUserName>
//                <CreateTime>%s</CreateTime>
//                <MsgType><![CDATA[text]]></MsgType>
//                <Content><![CDATA[%s]]></Content>
//                </xml>';
//        $content = '您所上传的图片的Media_ID是：' . $request_xml->MediaId;
//        $response = sprintf($text, $request_xml->FromUserName, $request_xml->ToUserName, time(), $content);
//        echo $response;
//    }
//
//    /**
//     * 用于处理关注事件
//     * @param type $request_xml 事件信息对象
//     */
//    private function _doSubscribe($request_xml) {
//        //利用消息的发送，完成向关注用户发送消息
//        $text = '<xml>
//                <ToUserName><![CDATA[%s]]></ToUserName>
//                <FromUserName><![CDATA[%s]]></FromUserName>
//                <CreateTime>%s</CreateTime>
//                <MsgType><![CDATA[text]]></MsgType>
//                <Content><![CDATA[%s]]></Content>
//                </xml>';
//        $content = '感谢你的关注，Welcome to wechat world!';
//        $response = sprintf($text, $request_xml->FromUserName, $request_xml->ToUserName, time(), $content);
//        echo $response;
//    }
//
//    private function _doText($request_xml) {
//        //获取文本内容
//        $content = $request_xml->Content;
//        //对文本内容进行判断
//        if ('?' == $content || '？' == $content) {
//            $response_content = '输入对应序号或名称获取相应资源' . "\n" . '[1]PHP' . "\n" . '[2]Java' . "\n" . '[3]C++';
//            $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
//        } elseif ('1' == strtolower($content) || 'php' == strtolower($content)) {
//            $response_content = 'php' . "\n" . 'http://www.baidu.com';
//            $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
//        } elseif ('2' == strtolower($content) || 'Java' == strtolower($content)) {
//            $response_content = 'Java' . "\n" . 'http://www.baidu.com';
//            $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
//        } elseif ('3' == strtolower($content) || 'C++' == strtolower($content)) {
//            $response_content = 'C++' . "\n" . 'http://www.baidu.com';
//            $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
//        } elseif ('图片' == $content) {
//            $id_list = array(
//                'xX5qsb_UayZMgFdwQmSeaTzloo_8WjtRowtUBj2EUbogKJT-dt16M42RbKRP1ulj',
//                'zJi_Qxcsc1_FTk3ys_Ulu1OmnndqaLGHbQ9JZJRwOum8I4u4HTYA4wMOASbp-Zjr',
//                'IsJFNOLriNMowvf2Zz5hVFvMQhikRaHrvGP5zJzRTkvEbjy-A7CS5f0LCdC-V_Xu',
//            );
//            $rand_index = mt_rand(0, count($id_list) - 1);
//            $this->_msgImage($request_xml->FromUserName, $request_xml->ToUserName, $id_list[$rand_index], true);
//        } elseif ('音乐' == $content) {
//            $music_url = 'http://yilunhuang.eicp.net/wechat/th.mp3';
//            $hq_music_url = 'http://yilunhuang.eicp.net/wechat/th.mp3';
//            $thumb_media_id = 'xX5qsb_UayZMgFdwQmSeaTzloo_8WjtRowtUBj2EUbogKJT-dt16M42RbKRP1ulj';
//            $title = '童话';
//            $desc = '光良';
//            $this->_msgMusic($request_xml->FromUserName, $request_xml->ToUserName, $music_url, $hq_music_url, $thumb_media_id, $title, $desc);
//        } elseif ('新闻' == $content) {
//            $item_list = array(
//                array('title' => '1', 'desc' => '1', 'picurl' => 'http://img02.3dmgame.com/uploads/allimg/140623/265_140623223334_1_lit.jpg', 'url' => 'http://www.soso.com'),
//                array('title' => '2', 'desc' => '2', 'picurl' => 'http://yilunhuang.eicp.net/wechat/2.jpg', 'url' => 'http://www.soso.com'),
//                array('title' => '3', 'desc' => '3', 'picurl' => 'http://yilunhuang.eicp.net/wechat/3.jpg', 'url' => 'http://www.soso.com'),
//                array('title' => '4', 'desc' => '4', 'picurl' => 'http://yilunhuang.eicp.net/wechat/4.jpg', 'url' => 'http://www.soso.com'),
//            );
//            $this->_msgNews($request_xml->FromUserName, $request_xml->ToUserName, $item_list);
//        } else {
//            $response_content = '输入对应序号或名称获取相应资源' . "\n" . '[1]PHP' . "\n" . '[2]Java' . "\n" . '[3]C++';
//            $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
//        }
//    }
//
//    private function _msgText($to, $from, $content) {
//        $response = sprintf($this->_msg_template['text'], $to, $from, time(), $content);
//        die($response);
//    }
//
//    /**
//     *
//     * @param type $to
//     * @param type $from
//     * @param type $item_list
//     */
//    private function _msgNews($to, $from, $item_list = array()) {
//        //拼凑文章部分
//        $item_str = '';
//        foreach ($item_list as $item) {
//            $item_str .= sprintf($this->_msg_template['news_item'], $item['title'], $item['desc'], $item['picurl'], $item['url']);
//        }
//        //拼凑整体图文部分
//        $response = sprintf($this->_msg_template['news'], $to, $from, time(), count($item_list), $item_str);
////        file_put_contents('./a.txt',$response);
//        echo $response;
//    }
//
//    /**
//     * 菜单删除
//     * @return boolean
//     */
//    public function menuDelete() {
//        $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=' . $this->_getAccessToken();
//        $result = $this->_requestGet($url);
//        $result_obj = json_decode($result);
//        if ($result_obj->errcode == 0) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    public function menusSet($menu) {
//        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $this->_getAccessToken();
//        $data = $menu;
//        $result = $this->_requestPost($url, $data);
//        $result_obj = json_decode($result);
//        if ($result_obj->errcode == 0) {
//            return true;
//        } else {
//            echo $result_obj->errmsg . '<br>';
//            return false;
//        }
//    }
//
//    /**
//     * 用于第一次验证URL合法性的方法
//     */
//    public function firstValid() {
//        //验证签名合法性
//        if ($this->_checkSignature()) {
//            //签名合法 告知微信公众平台
//            echo $_GET['echostr'];
//        }
//    }
//
//    /**
//     * 验证签名
//     * @return boolean
//     * @throws Exception
//     */
//    private function _checkSignature() {
//        // you must define TOKEN by yourself
//        if (!defined("TOKEN")) {
//            throw new Exception('TOKEN is not defined!');
//        }
//
//        $signature = $_GET["signature"];
//        $timestamp = $_GET["timestamp"];
//        $nonce = $_GET["nonce"];
//
//        $token = TOKEN;
//        $tmpArr = array($token, $timestamp, $nonce);
//        // use SORT_STRING rule
//        sort($tmpArr, SORT_STRING);
//        $tmpStr = implode($tmpArr);
//        $tmpStr = sha1($tmpStr);
//
//        if ($tmpStr == $signature) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    /*
//     * 获取access_token
//     * @param $token_file 用来存储token临时文件
//     */
//
//    private function _getAccessToken($token_file = './access_token') {
//        //考虑过期问题 将获取的access_token存储到某个文件中
//        $life_time = 7200;
//        if (file_exists($token_file) && time() - filemtime($token_file) < $life_time) {
//            //存在有效的access_token
//            return file_get_contents($token_file);
//        }
//        //目标URL
//        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->_appid}&secret={$this->_appsecret}";
//        ;
//        //向该目标发送get请求
//        $result = $this->_requestGet($url);
//        if (!$result) {
//            return false;
//        }
//        //存在返回的结果
//        $result_obj = json_decode($result);
//        file_put_contents($token_file, $result_obj->access_token);
//        return $result_obj->access_token;
//    }
//
//    /**
//     * @param $content 内容
//     * @param $type qr码类型
//     * @param $expire 有效期，如果是临时的需要此参数
//     * @return string ticket
//     */
//    private function _getQRCodeTicket($content, $type = 2, $expire = 2592000) {
//        $access_token = $this->_getAccessToken();
//        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$access_token}";
//        $type_list = array(
//            self::QRCODE_TYPE_TEMP => 'QR_SCENE',
//            self::QRCODE_TYPE_LIMIT => 'QR_LIMIT_SCENE',
//            self::QRCODE_TYPE_LIMIT_STR => 'QR_LIMIT_STR_SCEN',
//        );
//        $action_name = $type_list[$type];
//        switch ($type) {
//            case self::QRCODE_TYPE_TEMP:
//                //{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}
//                $data_arr['expire_seconds'] = $expire;
//                $data_arr['action_name'] = $action_name;
//                $data_arr['action_info']['scene']['scene_id'] = $content;
//                break;
//            case self::QRCODE_TYPE_LIMIT:
//            case self::QRCODE_TYPE_LIMIT_STR:
//                $data_arr['action_name'] = $action_name;
//                $data_arr['action_info']['scene']['scene_id'] = $content;
//                break;
//        }
//        $data = json_encode($data_arr);
////        echo $data;
////        echo '<br>';
//        $result = $this->_requestPost($url, $data);
//        if (!$result) {
//            return false;
//        }
//        //处理响应数据
//        $result_obj = json_decode($result);
//        return $result_obj->ticket;
//    }
//
//    /**
//     *
//     * @param int/string $content qrcode内容表示
//     * @param type $file 文件地址，为null表示直接输出
//     * @param int $type 类型
//     * @param int $expire 如果是临时的表示有效期
//     */
//    public function getQRCode($content, $file = NULL, $type = 2, $expire = 2592000) {
//        //获取ticket
//        $ticket = $this->_getQRCodeTicket($content, $type = 1, $expire = 2592000);
//        $url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={$ticket}";
//        $result = $this->_requestGet($url); //此时的result就是图像内容
//
//        if ($file) {
//            file_put_contents($file, $result);
//        } else {
//            header('Content-Type:image/jpeg');
//            echo $result;
//        }
//    }
//
//    public function _requestPost($url, $data, $ssl = true) {
//        //curl完成
//        $curl = curl_init();
//        //设置curl选项
//        curl_setopt($curl, CURLOPT_URL, $url); //URL
//        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '
//Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0';
//        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent); //user_agen请求代理信息
//        curl_setopt($curl, CURLOPT_AUTOREFERER, true);  //referer 请求来源
//        curl_setopt($curl, CURLOPT_TIMEOUT, 30); //设置超时时间
//        //SSL相关
//        if ($ssl) {
//            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //禁用后cURL将终止从服务端进行验证
//            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //检查服务器SSL证书中是否存在一个公用名（common,name)
//        }
//        //处理post请求
//        curl_setopt($curl, CURLOPT_POST, true); //是否为post请求
//        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//        //处理响应结果
//        curl_setopt($curl, CURLOPT_HEADER, false); //是否处理响应头
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //curl_exec() 是否返回响应结果
//        //发出请求
//        $response = curl_exec($curl);
//        if (false === $response) {
//            echo '<br>' . curl_error($curl) . '<br>';
//            return false;
//        }
////        echo $response;
//        return $response;
//    }
//
//    /*
//     * 发送get请求的方法
//     * @param string $rul URL
//     * @param bool $ssl 是否为https协议
//     * @param string响应主题Content
//     */
//
//    private function _requestGet($url, $ssl = true) {
//        //curl完成
//        $curl = curl_init();
//        //设置curl选项
//        curl_setopt($curl, CURLOPT_URL, $url); //URL
//        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '
//Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0';
//        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent); //user_agen请求代理信息
//        curl_setopt($curl, CURLOPT_AUTOREFERER, true);  //referer 请求来源
//        //SSL相关
//        if ($ssl) {
//            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //禁用后cURL将终止从服务端进行验证
//            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //检查服务器SSL证书中是否存在一个公用名（common,name)
//        }
//
//
//        //处理响应结果
//        curl_setopt($curl, CURLOPT_HEADER, false); //是否处理响应头
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //curl_exec() 是否返回响应结果
//        //发出请求
//        $response = curl_exec($curl);
//        if (false === $response) {
//            echo '<br>' . curl_error($curl) . '<br>';
//            return false;
//        }
////        echo $response;
//        return $response;
//    }
//
//    function http($url, $params, $method = 'GET', $header = array(), $multi = false) {
//        $opts = array(
//            CURLOPT_TIMEOUT => 30,
//            CURLOPT_RETURNTRANSFER => 1,
//            CURLOPT_SSL_VERIFYPEER => false,
//            CURLOPT_SSL_VERIFYHOST => false,
//            CURLOPT_HTTPHEADER => $header
//        );
//        /* 根据请求类型设置特定参数 */
//        switch (strtoupper($method)) {
//            case 'GET':
//                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
//                break;
//            case 'POST':
//                //判断是否传输文件
//                $params = $multi ? $params : http_build_query($params);
//                $opts[CURLOPT_URL] = $url;
//                $opts[CURLOPT_POST] = 1;
//                $opts[CURLOPT_POSTFIELDS] = $params;
//                break;
//            default:
//                throw new Exception('不支持的请求方式！');
//        }
//        /* 初始化并执行curl请求 */
//        $ch = curl_init();
//        curl_setopt_array($ch, $opts);
//        $data = curl_exec($ch);
//        $error = curl_error($ch);
//        curl_close($ch);
//        if ($error)
//            throw new Exception('请求发生错误：' . $error);
//        return $data;
//    }
//
//}
