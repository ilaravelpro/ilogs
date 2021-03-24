<?php


/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 1/27/21, 1:00 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

namespace iLaravel\iLogs\iApp\Http\Middleware;

use Closure;

class iResponse
{
    public function handle($request, Closure $next)
    {

        $response = $next($request);
        return $response;
    }

    public function terminate($request, $response)
    {
        $log = imodal('Log');
        $log = new $log;
        $log->type = 'User';
        $log->type_id = auth()->id();
        $log->model = isset($request->route()->controller) ? class_name($request->route()->getController()->model) : null;
        $log->action = isset($request->route()->action['as']) ? $request->route()->action['as'] : null;
        $log->endpoint = $request->url();
        $log->_ip = $this->getUserIpAddr();
        $log->method = $request->method();
        $responses = [];
        $responses['request'] = count($request->toArray()) ? $request->toArray() : [];
        $responses['response'] = $response->getContent();
        $log->execute_time = microtime(true) - LARAVEL_START;
        $responses['header_request'] = $request->headers->all();
        unset($responses['header_request']['user-agent']);
        $responses['header_response'] = $response->headers->all();
        $agent = $request->headers->all()['user-agent'][0];
        $log->_agent = imodal('LogAgent');
        if ($i_agent = $log->_agent::findByAgent($agent)) {
            $log->_agent = $i_agent;
        }else{
            $parser = \UAParser\Parser::create();
            $log->_agent = new $log->_agent();
            $log->_agent->title = $agent;
            $result = $parser->parse($agent);
            $log->_agent->_browser = $result->ua;
            $log->_agent->_device = $result->device;
            $log->_agent->_platform = $result->os;
            $log->_agent->save();
        }
        $log->save();
        foreach ($responses as $index => $response) {
            $split_response = str_split(is_string($response) ? $response : json_encode($response), 129496);
            foreach ($split_response as $i => $split) {
                if ((is_json($response) && strlen($response)) || (is_array($response) && count($response)))
                    $log->responses()->create([
                        'text' => $split,
                        'type' => $index,
                        'order' => $i,
                    ]);
            }
        }
    }
    public function getUserIpAddr(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
