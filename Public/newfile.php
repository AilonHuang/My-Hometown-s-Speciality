 /**
     * 收货地址
     */
    public function address() {    	
        $user_address_mod = M('user_address');
        //获取get参数      
        $id = $this->_get('id', 'intval');        
        $type = $this->_get('type', 'trim', 'edit'); 
        //如果有id参数，那么只可能是删除单条收货地址或者查询单条收货地址信息       
        if ($id) {        
            if ($type == 'del') {	//删除单条收货地址信息
                $user_address_mod->where(array('id'=>$id, 'uid'=>$this->visitor->info['id']))->delete();
                $msg = array('status'=>1, 'info'=>L('delete_success'));
                $this->assign('msg', $msg);
            } else {//查询单条收货地址信息
                $info = $user_address_mod->find($id);
                $this->assign('info', $info);
            }
        }
        
        //是post请求，所以是编辑收货地址
        if (IS_POST) {
        	//获取psot参数
            $consignee = $this->_post('consignee', 'trim');
            $address = $this->_post('address', 'trim');
           $zip = $this->_post('zip', 'trim');
         $mobile = $this->_post('phone_mob', 'trim');
         $sheng = $this->_post('sheng', 'trim');
         $shi = $this->_post('shi', 'trim');
         $qu = $this->_post('qu', 'trim');
            $id = $this->_post('id', 'intval');            
            if ($id) {//如果psot参数中存在id参数，那么可以判断是修改单条收货地址
            	     $result = $user_address_mod->where(array('id'=>$id, 'uid'=>$this->visitor->info['id']))->save(array(
                    'consignee' => $consignee,
                    'address' => $address,
                   // 'zip' => $zip,
                    'mobile' => $mobile,
                     'sheng' => $sheng,
                      'shi' => $shi,
                       'qu' => $qu,
                ));
                if ($result) {
                    $msg = array('status'=>1, 'info'=>L('edit_success'));
                } else {
                    $msg = array('status'=>0, 'info'=>L('edit_failed'));
                }
            } else {//如果post请求中没有id参数，我们认为是新增一条收货地址信息
            	  $result = $user_address_mod->add(array(
                    'uid' => $this->visitor->info['id'],
                    'consignee' => $consignee,
                    'address' => $address,
                    'zip' => $zip,
                    'mobile' => $mobile,
                ));
                if ($result) {
                    $msg = array('status'=>1, 'info'=>L('add_address_success'));
                } else {
                    $msg = array('status'=>0, 'info'=>L('add_address_failed'));
                }
            }
            
            $this->assign('msg', $msg);
        }
        
        //如果没有id参数，也不是post请求，那么就是查询所有收货地址
        $address_list = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->select();
        $this->assign('address_list', $address_list);
        $this->_config_seo();
        $this->display();
    }
   