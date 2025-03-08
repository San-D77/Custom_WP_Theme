<?php
/* Collection of Walker Classes */


class Walker_Primary_Nav extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    { //ul
        $indent = str_repeat("\t", $depth);

        $submenu = ($depth > 0) ? ' sub-menu' : '';

        $output .= "\n$indent<ul class=\"dropdown-list dropdown-hide \">\n";
    }

    function start_el(&$output, $data_object, $depth = 0, $args = [], $current_object_id = 0)
    { //li a span
        if (isset($args->walker)) {
            $output .= ($args->walker && $args->walker->has_children) ? "<li class='nav-link parent'>{$data_object->title} <div class='fa-caret-down'><svg width='30px' height='30px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                <g id='Arrow / Caret_Down_MD'>
                <path id='Vector' d='M16 10L12 14L8 10' stroke='' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                </g>
                </svg></div>" : "<li class='nav-item'><a class='nav-link' href='{$data_object->url}' >{$data_object->title}</a>";
        }
    }
    function end_el(&$output, $data_object, $depth = 0, $args = null)
    { //closing li a span
        $output .= "</li>";
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    { //closing ul
        $output .= "</ul>";
    }
}

class Walker_Sidebar_Nav extends Walker_Nav_Menu{
    function start_lvl(&$output, $depth = 0, $args = null){ //ul
        $indent = str_repeat("\t",$depth);

        $submenu = ($depth > 0)? ' sub-menu' : '';

        $output .= "\n$indent<ul class=\"dropdown-mobile \">\n";
    }

        function start_el(&$output, $data_object, $depth = 0, $args = [], $current_object_id = 0){ //li a span
            $output .= ($args->walker->has_children)? "<li class='nav-item' ><span class='nav-link dropdown-trigger' >{$data_object->title} <div class='fa-caret-down'><svg width='30px' height='30px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                <g id='Arrow / Caret_Down_MD'>
                <path id='Vector' d='M16 10L12 14L8 10' stroke='' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                </g>
                </svg></div></span>" : "<li class='nav-item'><a class='nav-link' href='{$data_object->url}' >{$data_object->title}</a>";
        }
        
        function end_el(&$output, $data_object, $depth = 0, $args = null){ //closing li a span
            $output .= "</li>";
        }

    function end_lvl(&$output, $depth = 0, $args = null){ //closing ul
        $output .= "</ul>";
    }
}


// class Walker_Sidebar_Nav extends Walker_Nav_Menu
// {
//     function start_lvl(&$output, $depth = 0, $args = null)
//     { //ul
//         $indent = str_repeat("\t", $depth);

//         $submenu = ($depth > 0) ? ' sub-menu' : '';

//         $output .= "\n$indent<ul class=\"dropdown-mobile \">\n";
//     }
    

//     function start_el(&$output, $data_object, $depth = 0, $args = [], $current_object_id = 0)
//     {
//         // Check if $args is an array and 'walker' is set, then access 'has_children'
//         $has_children = is_array($args) && isset($args['walker']) && $args['walker']->has_children;

//         // If $args is not an array, use the original object-based access method
//         $has_children = $has_children ?? ($args->walker?->has_children ?? false);
        
//         if ($has_children) {
//             wp_die("hello");
//             $output .= "<li class='nav-item' ><span class='nav-link dropdown-trigger' >{$data_object->title} <div class='fa-caret-down'><svg width='30px' height='30px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
//                             <g id='Arrow / Caret_Down_MD'>
//                             <path id='Vector' d='M16 10L12 14L8 10' stroke='' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
//                             </g>
//                             </svg></div></span>";
//         } else {
//             $output .= "<li class='nav-item'><a class='nav-link' href='{$data_object->url}' >{$data_object->title}</a>";
//         }
//     }


//     function end_el(&$output, $data_object, $depth = 0, $args = null)
//     { //closing li a span
//         $output .= "</li>";
//     }

//     function end_lvl(&$output, $depth = 0, $args = null)
//     { //closing ul
//         $output .= "</ul>";
//     }
// }


class Walker_Footer_Nav extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    { //ul

    }

    function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
    { //li a span
        $output .= "<li class='nav-item'>
                <a href='{$data_object->url}' class='nav-link'>{$data_object->title}</a>";
    }

    function end_el(&$output, $data_object, $depth = 0, $args = null)
    { //closing li a span
        $output .= "</li>";
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    { //closing ul

    }
}
