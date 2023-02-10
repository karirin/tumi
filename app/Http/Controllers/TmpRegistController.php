<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Person;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\AuthMail;
use App\TokenService;
use App\Match;
use App\Token;
use App\Models\Message_relation;
//use Config\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use DateTime;

class TmpRegistController extends Controller
{
    public function index(Request $request)
    {
        $url='http://localhost:8000/user/register?token=63d7e3150f76b6.53964488';
        return view('mail.tmpRegist',['url' => $url]);
    }
}