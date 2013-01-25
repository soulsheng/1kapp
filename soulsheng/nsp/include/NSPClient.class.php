<?php

/**
 *  NSP-PHPRPC
 *  版本: 2.6
 */
require_once dirname(__FILE__).'/Snoopy.class.php';

if (!class_exists('NSPException')) {
    class NSPException extends Exception {}
}

class NSPObject{
    public $obj;
    public $srvname;
    public $context;

    function __construct($obj, $srvname) {
        $this->obj = $obj;
        $this->srvname = $srvname;
    }

    function __call($name, $arguments) {
        $service = $this->srvname .'.' .$name;
        return $this->obj->callMethod($this, $service, $arguments);
    }

}

class NSPClient{

    public $app_id;
    public $app_secret;
    public $srv_prefix;
    public $nspUrl = "http://api.dbank.com/rest.php";
    public $nspHost;

    public $throwException = true;
    public $lastErrorCode;
    public $lastErrorMessage;
    public $timeout = 0;

    public $usesid = false;

    function __construct($app_id, $app_secret, $prefix='nsp' ) {
        if(strlen($app_id) > 40)
            $this->usesid = true;
        $this->app_id = $app_id;
        $this->app_secret = $app_secret;
        $this->srv_prefix = $prefix;
    }

    function service($srvname, $filter=array()) {
        $svc = new NSPObject($this, $srvname);
        if(!empty($filter) && is_array($filter)){
            $svc->context = $filter;
        }
        return $svc;
    }

    function callMethod($caller, $method, $param=array()) {
        // 合并全局context/方法context 
        $form = array(
            'nsp_fmt' => 'php-rpc',
            'nsp_svc' => $method,
            'nsp_app' => $this->app_id,
            'nsp_ts' => time(),
            'nsp_params' => serialize($param)
        );

        if(!empty($caller->context)){
            $form['nsp_ctx'] = serialize($caller->context);
        }

        if($this->usesid){
            unset($form['nsp_app']);
            $form['nsp_sid'] = $this->app_id;
        }

        $form['nsp_key'] = $this->signRequest($form);

        $proxy = new Snoopy();
        if($this->timeout>0)
            $proxy->read_timeout = $this->timeout;
        
        # 在超时的情况下，长连接可能引发BUG，先注释掉
        #if(property_exists($proxy,'_iskeepalive'))
        #    $proxy->_httpversion = "HTTP/1.1";

        if (isset($this->nspHost))
            $proxy->rawheaders['Host'] = $this->nspHost;

        $proxy->submit($this->nspUrl,$form);

        $headers = array();
        $status = NULL;
        if(isset($proxy->headers)){
            foreach ($proxy->headers as $v) {
                if (($idx = strpos($v, ":")) === false) {
                    if (strncmp($v, "HTTP/", 5) == 0) {
                        $status = explode(" ", $v);
                        $status = $status[1];
                    }
                } else {
                    $headers[trim(substr($v, 0, $idx))] = trim(substr($v, $idx+1));
                }
            }
        }

        unset($this->lastErrorCode);
        unset($this->lastErrorMessage);

        if($proxy->timed_out){
            $this->lastErrorCode = 504;
            $this->lastErrorMessage = "read timeout";
            if ($this->throwException)
                throw new Exception($this->lastErrorMessage, $this->lastErrorCode);
        }else if ($status == '200') {
            // 设置context
            $data = unserialize($proxy->results);
            if($data === FALSE && $proxy->results !== "b:0;" && $proxy->results !== ""){
                $this->lastErrorCode = 10619;
                $this->lastErrorMessage = 'unserialize result failed';
            }else{
                // 封装返回结果
                if(!isset($headers['NSP_STATUS']))
                    return $data;
                $this->lastErrorCode = $headers['NSP_STATUS'];
                $this->lastErrorMessage = $data['error'];
            }
            if ($this->throwException)
                throw new Exception($this->lastErrorMessage, $this->lastErrorCode);
        } elseif ($status == '406' && isset($headers['NSP_STATUS'])) {
            $error = unserialize($proxy->results);
            $this->lastErrorCode = $headers['NSP_STATUS'];
            $this->lastErrorMessage = $error['error'];
            if ($this->throwException)
                throw new NSPException($this->lastErrorMessage, $this->lastErrorCode);
        } else {
            $this->lastErrorCode = -1;
            $this->lastErrorMessage = 'Unknown error';

            if ($this->throwException)
                throw new Exception('Unknown error');
            return false;
        }
        return false;
    }

    function signRequest($param) {
        $str = $this->app_secret;
        ksort($param);
        foreach ($param as $k=>$v) {
            $str .= $k .$v;
        }
        return strtoupper(md5($str));
    }

}

