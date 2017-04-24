<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ViewController;
use App\Http\Requests\Admin\AccountEditFormRequest;
use App\Http\Requests\Admin\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AccountManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * [GET] Show list of data model, the page manager.
     */
    public function index()
    {
        $accounts = User::paginate(20);
        return ViewController::view('admin.account.index', 'Quản lý tài khoản', 'Trang quản lý tài khoản người dùng')
            ->with(['accounts' => $accounts]);
    }

    /**
     * [GET] Show form create account
     */
    public function create()
    {
        return ViewController::view('admin.account.create', 'Thêm mới tài khoản', 'Thêm mới một tài khoản vào cơ sở dữ liệu');
    }


    /**
     * [POST] Process insert account register to database.
     *
     * @param RegisterFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function store(RegisterFormRequest $request)
    {
        // TODO: Must process if has avatar upload request.
        //       Here is not process.

        $avatar = 'images/user.png';
        $user = new User();

        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->avatar = $avatar;
        $user->actived = $request->has('actived') && $request->input('actived');
        $user->blocked = $request->has('blocked') && $request->input('blocked');
        $user->groupid = $request->has('groupid') ? $request->input('groupid') : 3;
        $user->save();

        $message = ViewController::createMessage('Thêm tài khoản ' . $user->email . ' thành công!');

        return ViewController::redirect(route('admin.account.index'), $message);
    }

    /**
     * [DELETE] Delete account
     *
     * @param  integer      ID record will delete.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function destroy($id)
    {
        if ($id != 1) {
            $account = User::find($id);
            if ($account == null) {
                $message = ViewController::createMessage('Tài khoản này không tồn tại!', 'danger');
            } else {
                $account->delete();
                $message = ViewController::createMessage('Xóa tài khoản ' . $account->email . ' thành công!');
            }
        } else {
            $message = ViewController::createMessage('Bạn không có quyền xóa tài khoản Quản trị viên này!', 'danger');
        }
        return ViewController::redirect(route('admin.account.index'), $message);
    }

    /**
     * [PUT] Process request post and update information of record to database
     *
     * @param $id
     * @param AccountEditFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param Record $integer ID editing.
     */
    function update($id, AccountEditFormRequest $request)
    {
        // TODO: process avatar upload
        $user = User::find($id);
        if ($user != null) {
            $user->password = $request->has('password') ? bcrypt($request->input('password')) : $user->password;
            $user->name = $request->has('name') ? $request->input('name') : $user->name;
            $user->phone = $request->has('phone') ? $request->input('phone') : $user->phone;
            $user->address = $request->has('address') ? $request->input('address') : $user->address;
            // $account->avatar   = $request->has('avatar')     ? $request->input('avatar')  : $account->avatar;
            if ($id != 1) {
                $user->actived = $request->has('actived') && $request->input('actived');
                $user->blocked = $request->has('blocked') && $request->input('blocked');
                $user->groupid = $request->has('groupid') ? $request->input('groupid') : USER;
                $message = ViewController::createMessage('Thay đổi thông tin thành công!');
            } else {
                $message = ViewController::createMessage('Thay đổi thông tin cá nhân thành công! Tự động khôi phục trạng thái kích hoạt, trạng thái khóa của tài khoản này!', 'warning');
            }
            $user->save();
        } else {
            $message = ViewController::createMessage('Không tồn tại tài khoản này!');
        }
        return ViewController::redirect(route('admin.account.index'), $message);
    }

    /**
     * [GET] Show the detail object model.
     *
     * @return Response
     */
    function show($id)
    {
        $account = User::find($id);
        return ViewController::view('admin.account.show', 'Chi tiết tài khoản',
            'Hiển thị tất cả thông tin chi tiết của tài khoản')->with(['account' => $account]);
    }

    /**
     * [GET] Get the edit UI (user interface)
     *
     * @param  integer      ID of record need edit.
     * @return Response
     */
    function edit($id)
    {
        $account = User::find($id);
        return ViewController::view('admin.account.edit', 'Chỉnh sửa tài khoản', 'Thay đổi thông tin tài khoản')
            ->with(['account' => $account]);
    }

    /**
     * [GET] Filte account
     *
     * @param  Request      request
     * @return array        Array object model
     */
    public function filter(Request $request)
    {
        if (!$request->has('id')
            && !$request->has('text')
            && !$request->has('actived')
            && !$request->has('blocked')
            && !$request->has('permiss')
        ) {
            $accounts = User::paginate(15);
        } // Filter if has a id or has text:
        else {
            if ($request->has('id')) {
                $accounts = User::where('id', $request->input('id'));
            } else {
                $text = $request->has('text') ? $request->input('text') : null;
                $actived = $request->has('actived') ? $request->input('actived') : null;
                $blocked = $request->has('blocked') ? $request->input('blocked') : null;
                $groupid = $request->has('permiss') && $request->permiss != 0 ? $request->input('permiss') : null;

                $accounts = new User();
                // If text matches email format:
                if ($text != null) {
                    if ($text != null && preg_match('/[a-z]+@([a-z0-9]+\.[a-z]+)+/', $text)) {
                        $accounts = $accounts->where('email', $text);
                    } else {
                        $accounts = $accounts->where('name', 'like', "%$text%")
                            ->orwhere('email', 'like', "%$text%");
                    }
                }
                if ($actived != null) {
                    $accounts = $accounts->where('actived', $actived);
                }
                if ($blocked != null) {
                    $accounts = $accounts->where('blocked', $blocked);
                }
                if ($groupid != null) {
                    $accounts = $accounts->where('groupid', $groupid);
                }
            }
            $curentUrl = $request->getUri();
            $accounts = $accounts->paginate(15)
                ->setPath($curentUrl);
        }
        return ViewController::view('admin.account.index', 'Quản lý tài khoản', 'Trang quản lý tài khoản người dùng')
            ->with(['accounts' => $accounts]);
    }


}
