<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Cost</th>
            <th>Company</th>
        </tr>
    </thead>
    <tbody>
        @foreach($costs as $cost)
            <tr>
                <td>{{ $cost->name }}</td>
                <td>{{ $cost->cost }}</td>
                <td>{{ $cost->company->name }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Cost</th>
            <th>Company</th>
        </tr>
    </tfoot>
</table>