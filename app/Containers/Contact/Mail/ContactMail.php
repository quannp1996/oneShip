<?php 
namespace App\Containers\Contact\Mail;

use App\Containers\Contact\Models\Contact;
use App\Containers\Field\Actions\GetAllFieldsAction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable{

    use Queueable, SerializesModels;

    protected $contact;
    protected $fields;
    protected $fieldsData;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
        $this->fields = app(GetAllFieldsAction::class)->run([
            'status' => '1'
        ]);
    }

    public function build()
    {
        return $this->view('contact::mail.mail')
                ->with([
                    'contact' => $this->contact,
                    'fields' => $this->fields,
                ]);
    }

}
?>