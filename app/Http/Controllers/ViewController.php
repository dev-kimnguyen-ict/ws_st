<?php

namespace App\Http\Controllers;

class ViewController extends Controller
{
    /**
     * @param string $view
     * @param string $title
     * @param $subTitle
     * @param array|null $message
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function view($view = '', $title = '', $subTitle, array $message = null)
    {
        if ($message != null) {
            return view($view)->with(['title' => $title, MESSAGE => $message, 'subTitle' => $subTitle]);
        } else {
            return view($view)->with(['title' => $title, 'subTitle' => $subTitle]);
        }
    }

    /**
     * @param string $view
     * @param array|null $message
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function redirect($view = '', array $message = null)
    {
        if ($message != null) {
            return redirect($view)->with([MESSAGE => $message]);
        } else {
            return redirect($view);
        }
    }

    /**
     * @param string $message
     * @param string $status
     * @return array
     */
    public static function createMessage($message = '', $status = 'success')
    {
        return [
            'status' => $status,
            'message' => $message,
        ];
    }
}
