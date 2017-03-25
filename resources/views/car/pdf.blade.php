<table>
    <thead>
        <tr>
            <th>
                User
            </th>
            <th>
                Licence plate
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($cars as $car)
            <tr>
                <td>{{ $car->user->first_name }} {{ $car->user->last_name }} </td>
                <td>{{ $car->licence_plate }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>User</th>
            <th>Licence plate</th>
        </tr>
    </tfoot>
</table>