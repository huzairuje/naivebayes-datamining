<?php

if (! function_exists('action_message')) {
    function action_message($action = null, $title = null)
    {
        $title = (!empty($title)) ? ucfirst(strtolower($title)) : trans('label.data') ;
        switch ($action) {
            case 'activate':
                flash(trans('message.action.activate', ['title' => $title]), 'success');
                break;
            case 'change':
                flash(trans('message.action.change', ['title' => $title]), 'success');
                break;
            case 'create':
                flash(trans('message.action.create', ['title' => $title]), 'success');
                break;
            case 'deactivate':
                flash(trans('message.action.deactivate', ['title' => $title]), 'success');
                break;
            case 'delete':
                flash(trans('message.action.delete', ['title' => $title]), 'success');
                break;
            case 'save':
                flash(trans('message.action.save', ['title' => $title]), 'success');
                break;
            case 'update':
                flash(trans('message.action.update', ['title' => $title]), 'success');
                break;
        }
    }
}

if (! function_exists('numrows')) {
    function numrows($data, $index = 1, $name = 'no')
    {
        if (is_object($data)) {
            foreach ($data as $key => $value) {
                $value->{$name} = $index;
                $index++;
            }
        } else
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key][$name] = $index;
                $index++;
            }
        }
        return $data;
    }
}

if (! function_exists('check_dir')) {
    function check_dir($pathname)
    {
        if (!is_dir($pathname)) {
            mkdir($pathname, 0777, true);
        }
        return $pathname;
    }
}

if (! function_exists('debug')) {
    function debug($data = null, $exit = false)
    {
        echo '<pre>'; print_r($data); echo '</pre>';
        if ($exit) {
            exit();
        }
    }
}
