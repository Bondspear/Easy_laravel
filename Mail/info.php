 
//-------------------------------------Mail--------------------------------------------//
// 
//  ���� ����� ������� � ��������� email ����� laravel ����� �������� ��� �����:
//  1 - routes\web.php - ��� ����������� ��� �������� ������ �� ��������� �� �������
//  ����� ������ ���� � ������ �� ������� ����� ���������� ����   ��� �������� ��� �� ���:
//
//---------------------------------------------------------------------------------//
//  Route::match(['get','post'],'creating','MailController@index')->name('index');
//  Route::post('sending','MailController@send')->name('send');
//----------------------------------------------------------------------------------//
//
//  ������ �� �� ��������� "creating" ������ ����� � ���������� � �� ��������� sending
//  ��� ����� ������,�� �� ������ ������ ��� ������...
//
//------------------------------------------------------------------------------//
//  <form action="{{ route('send') }}" method="post">
//  @csrf
//  <div class="form-group">
//  <label for="exampleInputEmail1"></label>
//  <textarea rows="10" cols="60" name="text" ></textarea>
//  </div>
//  <button type="submit" class="btn btn-primary">Submit</button>
//  </form>
//------------------------------------------------------------------------------//
//
//  2 - ����� ������� ����� mail  - php artisan make:mail YourRandomClassName
//  ����� �� ��������,�� � ����� App ���������� ����� Mail  � � �� ��� �����
//  ��� ��� �� �������� ������ ������� ���!
<?php   
// ��� ������������ ���
  namespace App\Mail;
// ��������� ����� (��������)
use Illuminate\Bus\Queueable;
// ��������� ����� (��������)
use Illuminate\Contracts\Queue\ShouldQueue;
// ��������� ����� (�������� �����)
use Illuminate\Mail\Mailable;
// ��������� ����� (������������ �������)
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // � ��� � ����������� ! ����� ���������� ���� ������ �������� ������ ����
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // ���� ����� �������� ���� ������
    public function build()
    {
        // ����� �� ������ ������� �� ���� ��� ������
        $admin = "198�������arf�orgit@gmail.com";
        return $this->from($admin)
        // ���-�� � ��� ���� ����� �����������:
        //�������� �����
        //�������� ������
                    ->view('mails.test');
        //�������� ����
        // � ������ ��� ������� ������!
    }
}

//  3 - � ������ ����� ������� ������ ,����� ���    view('mails.test') � �� ��� ��� ������ :)
//  �� ������ ����� "������ �����!" � �� ���� ������.
//
//  4 - ����� ������� ���������� � ����� �������� MailController@index � MailController@send
//
//  namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\YourRandomClassName;
use Mail;

class MailController extends Controller
{
    public function index()
    {
        return view('mail_create.index');
    }
    public function send(Request $request)
    {
        //���������� ���������� ���
        $text = $request->text;
        $user = "198�������arf�orgit@gmail.com";
        // ����� ��::  ��������� ����� (���� ���������)  
        Mail::to($user)->send(new YourRandomClassName($text) );
        return redirect()->route('index');
    }
}
//
//  5 - � ��������� ����� ���������� env
//
//
MAIL_DRIVER=smtp    
MAIL_HOST=smtp.gmail.com    
MAIL_PORT=465
MAIL_USERNAME=198�������arf�orgit@gmail.com
MAIL_PASSWORD=**************     ----------  ��� ���� ������� �� ��������,����� ������� ���� �������-���
  ������������ � ��������� ���� �����  (������ ���� ������� �� ������ �� ����� � ������ �����!)
MAIL_ENCRYPTION=ssl
MAIL_LOG_CHANNEL=array
//
//
//