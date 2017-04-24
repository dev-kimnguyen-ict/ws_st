<?php
use Illuminate\Support\Facades\Auth;

/**
 * Xác thực thông tin user trong database
 *
 * @return bool
 */
function userInformationExists(){
    $user = Auth::user();
    return $user->name && $user->email && $user->phone && $user->address;
}

/**
 * Check administrator permission of user was logged.
 * Only use for my database.
 *
 * @author huukimit <huukimit@gmail.com>
 * @return boolean
 */
function isAdmin(){
    // TODO: I can check many condition in here
    $user = Auth::user();
    return Auth::check() && $user->groupid == ADMIN && $user->actived && !$user->blocked;
}

function isMember()
{
    $user = Auth::user();
    return Auth::check() && $user->groupid == USER && $user->actived && !$user->blocked;
}

function blocked(){
    $user = Auth::user();
    return Auth::check() && $user->actived && $user->blocked;
}

function actived(){
    $user = Auth::user();
    return Auth::check() && $user->actived;
}

/*
 * Html Helper
 */
if (! function_exists('getOption')) {
    function getOption($cate, $class = 'optgroup', $selectedID = null)
    {
        if($selectedID && $cate->id == $selectedID){
            return "<option class='$class' selected='true' value='$cate->id'>$cate->name</option>";
        }
        return "<option class='$class' value='$cate->id'>$cate->name</option>";
    }
}

if (! function_exists('getOptionParent')) {
    function getOptionParent($categories, $parentid = null, $level = 1, $selectedID)
    {
        if($categories->get($parentid)){
            foreach ($categories->get($parentid) as $firstChild) {
                if($categories->get($firstChild->id)){
                    echo getOption($firstChild, 'optgroup opt-level-' . $level, $selectedID);
                    echo getOptionParent($categories, $firstChild->id, ++$level, $selectedID);
                } else {
                    echo getOption($firstChild, 'optchild opt-level-' . $level, $selectedID);
                }
            }
        }
    }
}

if (! function_exists('getCategory')) {
    function getCategory($categories = null, $selectedID = null)
    {
        if($categories->count() > 0){
            $categories = $categories->sortBy('parentid')->groupBy('parentid');
            foreach ($categories->get(null) as $parent) {
                echo getOption($parent, 'optgroup', $selectedID);
                echo getOptionParent($categories, $parent->id, 1, $selectedID);
            }
        }
    }
}

if(! function_exists('submenu')){
    function submenu($categories){
        echo '<ul class="sub-menu dropdown-menu">';
        foreach($categories as $pos => $category){
            echo '<li><a href="'.route('app.product.category', $category->seo->alias).SUBFIX.'"">' .$category->name. '</a>';
            if($category->categories->count() > 0)
                submenu($category->categories);
            echo "</li>";
        }
        echo '</ul>';
    }
}

function webname($title)
{
    return $title . ' | ' . WEB_NAME;
}