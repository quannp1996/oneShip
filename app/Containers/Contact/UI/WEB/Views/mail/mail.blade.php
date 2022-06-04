@if ($contact)
    <table>
        <tr>
            <td>Tên Shop</td>
            <td>{{ $contact->shop_name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $contact->email }}</td>
        </tr>
        <tr>
            <td>Số điện thoại</td>
            <td>{{ $contact->phone }}</td>
        </tr>
        @foreach ($fields as $field)
            <tr>
                <td>{{ $field->lable }}</td>
                <td>{{ $contact->fields->filter(function($item) use($field) {
                    return $item->field_id == $field->id;
                })->first()->value }}</td>
            </tr>
        @endforeach
    </table>
@endif