<?php
namespace ClevePHP\Extension\pager;

class Config
{

    private static $instance;

    private function __construct()
    {}

    private function __clone()
    {}

    static public function getInstance()
    {
        if (! self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    const LIMIT_PAGE = 0;

    const ID_PAGE = 1;

    public $pageType;

    public $pageCount = 0;

    public $pageKeyValue = [];

    public $dataCount;

    public $listRows = 20;

    public $parameter = [];

    public $request=null;

    private $config = [];

    public function loadConfig($config = [])
    {
        $this->config = $config;
        if (! empty($config["page_key_value"])) {
            $this->pageKeyValue = $config["page_key_value"];
        }
        if (isset($config["data_count"])) {
            $this->dataCount = intval($config["data_count"]);
        }
        if (isset($config['list_rows'])) {
            $this->listRows = intval($config['list_rows']);
        }
        if (! empty($config['parameter'])) {
            $this->parameter = $config['parameter'];
        }
        if (! empty($config['url'])) {
            $this->requestUrl = $config['url'];
        }
        if (! empty($config['page_key_value'])) {
            $this->pageKeyValue = $config['page_key_value'];
        }
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setPageType(int $pageType = self::LIMIT_PAGE)
    {
        $this->pageType = $pageType;
        return $this;
    }

    public function setPageCount(int $count)
    {
        $this->pageCount = $count;
        return $this;
    }
    public function setRequest($request) {
        if ($request) {
            $this->request=$request;
            unset($request);
        }
        return $this;
    }
    
}