 
//-------------------------------------Mail--------------------------------------------//
// 
//  Итак чтобы создать и отправить email через laravel нужно изменить эти файлы:
//  1 - routes\web.php - нам понадобятся два маршрута Первый на страничку на которой
//  будем писать мейл и второй на котором будем отправлять мейл   это выглядит как то так:
//
//---------------------------------------------------------------------------------//
//  Route::match(['get','post'],'creating','MailController@index')->name('index');
//  Route::post('sending','MailController@send')->name('send');
//----------------------------------------------------------------------------------//
//
//  тоесть мы на страничке "creating" рисуем форму и отправляем её на страничку sending
//  это очень просто,но на всякий случай вот пример...
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
//  2 - Нужно создать класс mail  - php artisan make:mail YourRandomClassName
//  когда он создаётся,то в папке App появляется папка Mail  а в неё ваш класс
//  вот как он выглядит внутри разберём его!
<?php   
// имя пространства имён
  namespace App\Mail;
// спользуем трейт (очередей)
use Illuminate\Bus\Queueable;
// спользуем трейт (очередей)
use Illuminate\Contracts\Queue\ShouldQueue;
// спользуем трейт (сервисов почты)
use Illuminate\Mail\Mailable;
// спользуем трейт (сериализации модэлей)
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // а вот и конструктор ! чтобы передавать свои модэли допустим модэль юзер
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // этот метод собирает наше письмо
    public function build()
    {
        // здесь мы должны указать ОТ КОГО это письмо
        $admin = "198авввмвмarfыorgit@gmail.com";
        return $this->from($admin)
        // так-же у нас есть такие возможности:
        //передать текст
        //передать вьюшку
                    ->view('mails.test');
        //передать файл
        // я выбрал для примера вьюшку!
    }
}

//  3 - А значит нужно создать вьюшку ,уменя это    view('mails.test') а вы как вам удобно :)
//  на вьюшке пишем "привет емейл!" и на этом хватит.
//
//  4 - Нужно создать контроллер с двумя методами MailController@index и MailController@send
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
        //интересное происходит тут
        $text = $request->text;
        $user = "198авввмвмarfыorgit@gmail.com";
        // метод ТО::  принимает емейл (КОМУ отправить)  
        Mail::to($user)->send(new YourRandomClassName($text) );
        return redirect()->route('index');
    }
}
//
//  5 - и последние нужно подправить env
//
//
MAIL_DRIVER=smtp    
MAIL_HOST=smtp.gmail.com    
MAIL_PORT=465
MAIL_USERNAME=198авввмвмarfыorgit@gmail.com
MAIL_PASSWORD=**************     ----------  вот этот паролик вы получите,когда пройдёте двух КАКУЕТО-ТАМ
  аунтификацию и создадите свой ключь  (тоесть сюда вводить не пароль от почты а именно ключь!)
MAIL_ENCRYPTION=ssl
MAIL_LOG_CHANNEL=array
//
//
//