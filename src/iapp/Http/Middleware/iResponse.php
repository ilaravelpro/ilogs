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
        $log->_ip = $request->ip();
        $log->method = $request->method();
        $log->request = count($request->toArray()) ? $request->toArray() : [];
        $log->response = $response->getContent();
        $log->execute_time = microtime(true) - LARAVEL_START;
        $header_request = $request->headers->all();
        unset($header_request['user-agent']);
        $log->header_request = $header_request;
        $log->header_response = $response->headers->all();
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
    }
}
