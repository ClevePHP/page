<?php
namespace ClevePHP\Extension\pager;

class Pages
{

    private static $instance;

    private function __construct()
    {}

    private function __clone()
    {}

    private $config = [];

    private $request = null;

    static public function getInstance()
    {
        if (! self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function config(\ClevePHP\Extension\pager\Config $pageConfig)
    {
        $this->config = $pageConfig;
        return $this;
    }

    public function show()
    {
        if ($this->config->pageType == \ClevePHP\Extension\pager\Config::LIMIT_PAGE) {
            $object = (\ClevePHP\Extension\pager\Limiagepage::getInstance());
            $object->setRequest($this->config->request)->_init($this->config->dataCount, $this->config->listRows, $this->config->parameter);
            if ($this->config->pageKeyValue) {
                foreach ($object as $key => $value) {
                    $object->setConfig($key, $value);
                }
            }
            return $object->data();
        }
    }

    public function getPage(int $dataCount, $pageSize = 10)
    {
        if ($dataCount && $this->request) {
            $pageConfig = (\ClevePHP\Extension\pager\Config::getInstance())->setRequest($this->request)->loadConfig($this->config);
            $pageConfig->dataCount = $dataCount;
            $pageConfig->listRows = $pageSize;
            $result = $this->config($pageConfig)->show();
            return $result;
        }
        return [];
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }
}
