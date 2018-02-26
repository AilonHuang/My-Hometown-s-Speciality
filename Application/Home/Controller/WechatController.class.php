<?php

namespace Home\Controller;

use Think\Controller;

define("TOKEN", "wechat");

class WechatController extends Controller {

    private $_appid = '';
    private $_appsecret = '';
    private $_token; //公众平台请求开发者是需要
    private $menu = '{
    "button": [
        {
            "name": "商城",
            "sub_button": [
                {
                    "type": "view",
                    "name": "商城首页",
                    "url": "http://yilunhuang.eicp.net/shop"
                },
                {
                    "type": "view",
                    "name": "购物车",
                    "key": "cart",
                    "url": "http://yilunhuang.eicp.net/shop/index.php/Home/Cart"
                }
            ]
        },
        {
            "name": "发现",
            "sub_button": [
                {
                    "type": "click",
                    "name": "最近热卖",
                    "key": "V1001_TODAY_MUSIC",
                 }
            ]
        },
        {
            "name": "我的",
            "sub_button" : [
                {
                    "name" : "我的订单",
                    "type": "view",
                    "url": "http://yilunhuang.eicp.net/shop/index.php/Home/User"
                },
                {
                    "name" : "用户信息",
                    "type": "view",
                    "url": "http://yilunhuang.eicp.net/shop/index.php/home/wechat/getbaseinfo"
                },
                {
                    "name" : "查看URL",
                    "type": "view",
                    "url": "http://yilunhuang.eicp.net/shop"
                },
            ],

        },
    ]
}';
    private $_msg_template = array(
        'text' => '<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                </xml>',
        'news' => '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>%s</Articles></xml> ', //新闻主体
        'news_item' => '<item>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                        </item>', //某个新闻模板
    );

    public function _initialize() {
        import('/Home/Common/Wechat', APP_PATH); // 导入微信类
        $this->menusSet($this->menu);
    }

    public function index() {
//        $wechat = new \WeChat(); //导入微信类
        //第一次验证
//	$wechat->valid();
        $this->responseMsg();
    }

    public function responseMsg() {
        //获取请求的是事POST：XML数据
        $xml_str = file_get_contents('php://input');
//        $xml_str = $GLOBALS["HTTP_RAW_POST_DATA"];
        //extract post data
        if (!empty($xml_str)) {
            libxml_disable_entity_loader(true); //禁止xml实体解析，防止xml注入
            $request_xml = simplexml_load_string($xml_str, 'SimpleXMLElement', LIBXML_NOCDATA); //从字符串获取xml对象
            //判断用户是否存在，不存在就自动注册
            $fromUsername = trim($request_xml->FromUserName); //发送方帐号（一个OpenID）
            if ($fromUsername != '') {
                $user = M('user')->field('id,username')->where("username='" . $fromUsername . "'")->find();
                if ($user) {
                    session('uid', $user['id']);
                } else {
                    $date = time();
                    $data['username'] = $fromUsername; //用户名
                    $data['addtime'] = $date;
                    $userid = M('User')->add($data);
                    session('uid', $userid);
                }
            }

            //判断消息类型通过MsgType
            switch ($request_xml->MsgType) {

                case 'event': //事件类型
                    $event = $request_xml->Event;
                    if ('subscribe' == $event) { //关注事件
                        $this->_doSubscribe($request_xml);
                    } elseif ('CLICK' == $event) {//菜单点击事件
                        $this->_doClick($request_xml);
                    } elseif ('VIEW' == $event) {//链接跳转事件
                        $this->_doView($request_xml);
                    }
                    break;
                case 'text':  //文本类型
                    $this->_doText($request_xml);
                    break;
                case 'image':
                    $this->_doImage($request_xml);
                    break;
                case 'location':
                    $this->_doLocation($request_xml);
                    break;
            }
        } else {
            //如果没有post数据，则响应空数据，表示结束
            echo "";
            exit;
        }
    }
        private function _doText($request_xml) {
        //获取文本内容
        $content = $request_xml->Content;
        //对文本内容进行判断
        if ('?' == $content || '？' == $content) {
            $response_content = '输入对应序号或名称获取相应资源' . "\n" . '[1]PHP' . "\n" . '[2]Java' . "\n" . '[3]C++';
            $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
        } elseif ('1' == strtolower($content) || 'php' == strtolower($content)) {
            $response_content = 'php' . "\n" . 'http://www.baidu.com';
            $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
        } elseif ('2' == strtolower($content) || 'Java' == strtolower($content)) {
            $response_content = 'Java' . "\n" . 'http://www.baidu.com';
            $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
        } elseif ('3' == strtolower($content) || 'C++' == strtolower($content)) {
            $response_content = 'C++' . "\n" . 'http://www.baidu.com';
            $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
        } elseif ('新闻' == $content) {
            $item_list = array(
                array('title' => '1', 'desc' => '1', 'picurl' => 'http://img02.3dmgame.com/uploads/allimg/140623/265_140623223334_1_lit.jpg', 'url' => 'http://www.soso.com'),
                array('title' => '2', 'desc' => '2', 'picurl' => 'http://yilunhuang.eicp.net/wechat/2.jpg', 'url' => 'http://www.soso.com'),
                array('title' => '3', 'desc' => '3', 'picurl' => 'http://yilunhuang.eicp.net/wechat/3.jpg', 'url' => 'http://www.soso.com'),
                array('title' => '4', 'desc' => '4', 'picurl' => 'http://yilunhuang.eicp.net/wechat/4.jpg', 'url' => 'http://www.soso.com'),
            );
            $this->_msgNews($request_xml->FromUserName, $request_xml->ToUserName, $item_list);
        } else {
            $response_content = '输入对应序号或名称获取相应资源' . "\n" . '[1]PHP' . "\n" . '[2]Java' . "\n" . '[3]C++';
            $this->_msgText($request_xml->FromUserName, $request_xml->ToUserName, $response_content);
        }
    }
        /**
     *
     * @param type $to
     * @param type $from
     * @param type $item_list
     */
    private function _msgNews($to, $from, $item_list = array()) {
        //拼凑文章部分
        $item_str = '';
        foreach ($item_list as $item) {
            $item_str .= sprintf($this->_msg_template['news_item'], $item['title'], $item['desc'], $item['picurl'], $item['url']);
        }
        //拼凑整体图文部分
        $response = sprintf($this->_msg_template['news'], $to, $from, time(), count($item_list), $item_str);
//        file_put_contents('./a.txt',$response);
        echo $response;
    }
    /**
     * 用于处理关注事件
     * @param type $request_xml事件信息对象
     */
    private function _doClick($request_xml) {
        M('Goods')->where(array('ishot'=>1))->select();
        
        $item_list = array(
                array('title' => '1', 'desc' => '1', 'picurl' => 'http://img02.3dmgame.com/uploads/allimg/140623/265_140623223334_1_lit.jpg', 'url' => 'http://www.soso.com'),
                array('title' => '2', 'desc' => '2', 'picurl' => 'http://yilunhuang.eicp.net/wechat/2.jpg', 'url' => 'http://www.soso.com'),
                array('title' => '3', 'desc' => '3', 'picurl' => 'http://yilunhuang.eicp.net/wechat/3.jpg', 'url' => 'http://www.soso.com'),
                array('title' => '4', 'desc' => '4', 'picurl' => 'http://yilunhuang.eicp.net/wechat/4.jpg', 'url' => 'http://www.soso.com'),
            );
        $this->_msgNews($request_xml->FromUserName, $request_xml->ToUserName, $item_list);
    }

    private function _msgText($to, $from, $content) {
        $response = sprintf($this->_msg_template['text'], $to, $from, time(), $content);
        die($response);
    }

    /**
     * 用于处理关注事件
     * @param type $request_xml 事件信息对象
     */
    private function _doSubscribe($request_xml) {
        //利用消息的发送，完成向关注用户发送消息
        $text = '<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                </xml>';
        $content = '感谢你的关注，Welcome to wechat world!';
        $response = sprintf($text, $request_xml->FromUserName, $request_xml->ToUserName, time(), $content);
        echo $response;
    }

    public function menusSet($menu) {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $this->_getAccessToken();
        $data = $menu;
        $result = $this->_requestPost($url, $data);
        $result_obj = json_decode($result);
        if ($result_obj->errcode == 0) {
            return true;
        } else {
            echo $result_obj->errmsg . '<br>';
            return false;
        }
    }

    private function _getAccessToken($token_file = './access_token') {
        //考虑过期问题 将获取的access_token存储到某个文件中
        $life_time = 7200;
        if (file_exists($token_file) && time() - filemtime($token_file) < $life_time) {
            //存在有效的access_token
            return file_get_contents($token_file);
        }
        //目标URL
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->_appid}&secret={$this->_appsecret}";
        ;
        //向该目标发送get请求
        $result = $this->_requestGet($url);
        if (!$result) {
            return false;
        }
        //存在返回的结果
        $result_obj = json_decode($result);
        file_put_contents($token_file, $result_obj->access_token);
        return $result_obj->access_token;
    }

    public function _requestPost($url, $data, $ssl = true) {
        //curl完成
        $curl = curl_init();
        //设置curl选项
        curl_setopt($curl, CURLOPT_URL, $url); //URL
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '
Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0';
        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent); //user_agen请求代理信息
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);  //referer 请求来源
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); //设置超时时间
        //SSL相关
        if ($ssl) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //禁用后cURL将终止从服务端进行验证
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //检查服务器SSL证书中是否存在一个公用名（common,name)
        }
        //处理post请求
        curl_setopt($curl, CURLOPT_POST, true); //是否为post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //处理响应结果
        curl_setopt($curl, CURLOPT_HEADER, false); //是否处理响应头
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //curl_exec() 是否返回响应结果
        //发出请求
        $response = curl_exec($curl);
        if (false === $response) {
            echo '<br>' . curl_error($curl) . '<br>';
            return false;
        }
//        echo $response;
        return $response;
    }

    private function _requestGet($url, $ssl = true) {
        //curl完成
        $curl = curl_init();
        //设置curl选项
        curl_setopt($curl, CURLOPT_URL, $url); //URL
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '
Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0';
        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent); //user_agen请求代理信息
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);  //referer 请求来源
        //SSL相关
        if ($ssl) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //禁用后cURL将终止从服务端进行验证
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); //检查服务器SSL证书中是否存在一个公用名（common,name)
        }


        //处理响应结果
        curl_setopt($curl, CURLOPT_HEADER, false); //是否处理响应头
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //curl_exec() 是否返回响应结果
        //发出请求
        $response = curl_exec($curl);
        if (false === $response) {
            echo '<br>' . curl_error($curl) . '<br>';
            return false;
        }
//        echo $response;
        return $response;
    }

}
