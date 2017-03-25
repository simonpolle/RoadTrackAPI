<table>
    <thead>
        <tr>
            <th>
                Admin
            </th>
            <th>
                Name
            </th>
            <th>
                Address
            </th>
            <th>
                VAT Number
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
            <tr>
                <td>{{ $company->user->first_name }} {{ $company->user->last_name }} </td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->street }} {{ $company->number }} {{ $company->postal_code }} {{ $company->country }}</td>
                <td>{{ $company->vat_number }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>User (Admin)</th>
            <th>Name</th>
            <th>Address</th>
            <th>VAT Number</th>
        </tr>
    </tfoot>
</table>