<?php
/**
 * Created by PhpStorm.
 * User: tsybykov
 * Date: 19.02.19
 * Time: 17:14
 */


class Trim
{
    public $parts;
    public $query;

    public function __construct(string $url)
    {
        $this->parts = parse_url($url);
        parse_str($this->parts['query'], $this->query);
    }

    public function trim_by_params(array $params)
    {
        if($params){
            foreach ($this->query as $key=>$param){
                if(in_array($param,$params)){
                    unset($this->query[$key]);
                }
            }
        }
        $this->parts['query'] = http_build_query($this->query);
        return $this;
    }
    public function sort(string $type = null)
    {
        if($type == 'asc'){
            arsort($this->query);
            $this->parts['query'] = http_build_query($this->query);
        }elseif($type == 'desc'){
            asort($this->query);
            $this->parts['query'] = http_build_query($this->query);
        }
        else{
            $this->parts['query'] = http_build_query($this->query);
        }
        return $this;

    }
    public function addParametersByUrl(string $params)
    {
        if(array_key_exists($params,$this->parts)){
            $this->query[$params] = $this->parts[$params];
            unset($this->parts[$params]);
            $this->parts['query'] = http_build_query($this->query);
        }
        return $this;

    }
    public function getUrl()
    {
        return $this->build_url($this->parts);
    }
    function build_url(array $parts)
    {
        $scheme   = isset($parts['scheme']) ? ($parts['scheme'] . '://') : '';

        $host     = isset($parts['host']) ? ($parts['host'].'/') : '';
        $port     = isset($parts['port']) ? (':' . $parts['port']) : '';

        $user     = ($parts['user'] ?? '');

        $pass     = isset($parts['pass']) ? (':' . $parts['pass'])  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';

        $path     = ($parts['path'] ?? '');
        $query    = isset($parts['query']) ? ('?' . $parts['query']) : '';
        $fragment = isset($parts['fragment']) ? ('#' . $parts['fragment']) : '';

        return implode('', [$scheme, $user, $pass, $host, $port, $path, $query, $fragment]);
    }
}

$url = 'https://www.mydomain.com/controller/test.php?a=45&b=38&c=0&d=12&e=309&f=38&g=zed456&h=test2';

$urls = new Trim($url);
/*var_dump($url);
var_dump($urls->trim_by_params([38])->sort('desc')->addParametersByUrl('path')->getUrl());*/

/*a*/var_dump($urls->trim_by_params([38])->getUrl());
/*б*/var_dump($urls->trim_by_params([38])->sort('desc')->getUrl());
/*в*/var_dump($urls->trim_by_params([38])->sort('desc')->addParametersByUrl('path')->getUrl());
var_dump('https://www.mydomain.com/?c=0&d=12&a=45&e=309&h=test2&g=zed456&path=%2Fcontroller%2Ftest.php');
