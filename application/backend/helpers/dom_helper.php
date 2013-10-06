<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function tree_view($list,$active = 0,$level = 0) {
    if ($level == 0)
        $html ="<ul id='navigation' >";
    else
        $html ="<ul>";

    foreach ($list as $item) {
            $link = base_url()."pages/form/" . $item['id'];

            if ($active == $item['id'])
                $cl = 'class=selected';
            else
                $cl = '';

            $html.= "<li><a $cl alt='" . $item['langs'][1]['title'] . "'  href='$link'  > " . urldecode($item['langs'][1]['title']) . "</a>";

            if ($item['childs'])
                $html .= tree_view($item['childs'], $active, $level + 1);
            
            $html .= "</li>";
    }
    $html.="</ul>";

    return $html;
}

function tree_option($list, $active = 0, $level = 0) {
    $html = $level == 0 ? "<option value='0'>---</option>" : '';
    
    foreach ($list as $item) {
            $symb = str_repeat('&nbsp;|&nbsp;&nbsp;&nbsp;', $level-1).($level?'&nbsp;|- ':'');
            $html.= "<option value='{$item['id']}' ". ($active == $item['id'] ? 'selected' : '') .">" . $symb . " " . urldecode($item['langs'][1]['title']) . "</option>";

            if ($item['childs'])
                $html .= tree_option($item['childs'], $active, $level + 1);
    }
    
    return $html;
}