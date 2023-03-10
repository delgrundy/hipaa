namespace App;

use Illuminate\Support\Facades\Mail;

class MyEmailSender
{
    public function sendEmail($to, $subject, $content)
    {
        Mail::to($to)->send(new MyTestEmail($subject, $content));
    }
}
