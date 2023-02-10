<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HelloController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $sort = $request->sort;
        $items = Person::orderBy($sort, 'asc')
            ->simplePaginate(5);
        $param = ['items' => $items, 'sort' => $sort, 'user' => $user];
        return view('hello.index', $param);
    }

    // public function show(Request $request)
    // {
    //     return view('hello.show');
    // }

    public function show(Request $request)
    {
        $items = DB::select('select * from people');
        return view('hello.show', ['items' => $items]);
    }


    public function add(Request $request)
    {
        return view('hello.add');
    }
    public function create(Request $request)
    {
        return redirect('/hello');
    }

    public function edit(Request $request)
    {
        return view('hello.edit');
    }
    public function update(Request $request)
    {
        return redirect('/hello');
    }

    public function del(Request $request)
    {
        return view('hello.del');
    }
    public function remove(Request $request)
    {
        return redirect('/hello');
    }

    public function rest(Request $request)
    {
        return view('hello.rest');
    }

    public function ses_get(Request $request)
    {
        return view('hello.session');
    }
    public function ses_put(Request $request)
    {
        return redirect('hello/session');
    }

    public function getAuth(Request $request)
    {
        $param = ['message' => 'ログインして下さい。'];
        return view('hello.auth', $param);
    }
    public function postAuth(Request $request)
    {
        $name = $request->name;
        $password = $request->password;
        if (Auth::attempt([
            'name' => $name,
            'password' => $password
        ])) {
            $msg = 'ログインしました。（' . Auth::user()->name . '）';
        } else {
            $msg = 'ログインに失敗しました。';
        }
        return view('hello.auth', ['message' => $msg]);
    }
}