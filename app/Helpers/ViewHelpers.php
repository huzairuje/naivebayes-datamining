<?php

if (! function_exists('print_icon')) {
    function print_icon($icon)
    {
        if (strpos($icon, 'fa ') !== false) {
            return '<i class="' . $icon . '"></i>';
        } elseif (strpos($icon, 'fa-') !== false) {
            return '<i class="fa ' . $icon . '"></i>';
        }
    }
}

if (! function_exists('print_yes_no')) {
    function print_yes_no($number, $yes = 1, $no = 0)
    {
        if ($number == $yes) {
            return '<span class="label label-success">'.trans('label.yes').'</span>';
        } elseif ($number == $no) {
            return '<span class="label label-danger">'.trans('label.no').'</span>';
        }
    }
}

if (! function_exists('print_show_hide')) {
    function print_show_hide($number, $show = 1, $hide = 0)
    {
        if ($number == $show) {
            return '<span class="label label-success"><i class="fa fa-eye"></i> '.trans('label.show').'</span>';
        } elseif ($number == $hide) {
            return '<span class="label label-danger"><i class="fa fa-eye-slash"></i> '.trans('label.hide').'</span>';
        }
    }
}
