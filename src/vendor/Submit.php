<?php

namespace iLaravel\iLogs\Vendor;


class Submit
{
    public static function Log($request, $response, $is_error = false) {
        $action = isset($request->route()->action['as']) ? $request->route()->action['as'] : null;
        if (!$is_error && in_array($action, ilogs('excepts.actions')))
            return false;
        $log = imodal('Log');
        $log = new $log;
        $log->type = $request->log_type?:'User';
        $log->type_id = $request->log_type_id?:auth()->id();
        $model = $request->log_model ? : ($request->route() && isset($request->route()->controller) ? $request->route()->getController()->model : null);
        $log->model = $model ? class_name($model) : null;
        if ($request->log_model_id)
            $log->model_id = $request->log_model_id;
        elseif ($model) {
            $originalParameters = array_values($request->route()->originalParameters());
            krsort($originalParameters);
            if (method_exists($model, "id") && $originalParameters) {
                foreach ($originalParameters as $originalParameter) {
                    if ($model::id($originalParameter))
                        $log->model_id = $model::id($originalParameter);
                }
            }
        }
        $log->action = $action;
        $log->endpoint = $request->url();
        $log->_ip = _get_user_ip();
        $log->method = $request->method();
        $log->is_error = $is_error;
        $responses = [];
        $responses['request'] = count($request->toArray()) ? $request->toArray() : [];
        $responses['response'] = is_string($response) ? $response : $response->getContent();
        $log->execute_time = microtime(true) - LARAVEL_START;
        $responses['header_request'] = $request->headers->all();
        unset($responses['header_request']['user-agent']);
        $responses['header_response'] = is_string($response) ? [] : $response->headers->all();
        $agent = isset($request->headers->all()['user-agent'][0]) ? $request->headers->all()['user-agent'][0] : '';
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
                if (((is_json($response) || is_string($response)) && strlen($response)) || (is_array($response) && count($response)))
                    $log->responses()->create([
                        'text' => $split,
                        'type' => $index,
                        'order' => $i,
                    ]);
            }
        }
        return $log;
    }
}
