<?php
namespace App;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    //メール送信で使うビュー、タイトル、ビューに渡す認証用URLを設定
    public function build()
    {
        return $this->view('mail.tmpRegist')
            ->subject('【Pair Code】仮登録が完了しました！')
            ->with(['url' => $this->url]);
    }
}
