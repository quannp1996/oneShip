<?php 
namespace App\Containers\Contact\Excel;

use App\Containers\Contact\Models\Contact;
use App\Containers\Field\Actions\GetAllFieldsAction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactExport implements FromCollection, WithHeadings, WithMapping
{
    protected $fields;
    public function __construct()
    {
        $this->fields = app(GetAllFieldsAction::class)->run();
    }
    public function collection()
    {  
        return Contact::with(['fields'])->get();
    }
    /**
     * Set header columns
     *
     * @return array
     */
    public function headings(): array
    {
        $baseHeader =  [
            'Tên Shop',
            'Email',
            'Số điện thoại'
        ];
        $this->fields->map(function($item) use(&$baseHeader){
            $baseHeader[] = $item->lable;
        });
        return $baseHeader;
    }
     /**
     * Mapping data
     *
     * @return array
     */
    public function map($contact): array
    {
        $baseContent = [
            $contact->shop_name,
            $contact->email,
            $contact->phone,
        ];
        $this->fields->map(function($item) use(&$baseContent, $contact){
            $baseContent[] = $contact->valueById($item->id);
        });
        return $baseContent;
    }
}
?>