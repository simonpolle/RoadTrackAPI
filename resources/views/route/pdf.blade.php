<table>
    <thead>
        <tr>
            <th>
                User
            </th>
            <th>
                Licence plate
            </th>
            <th>
                Distance travelled
            </th>
            <th>
                Total cost
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach($routes as $route)
            <tr>
                <td>{{ $route->user->first_name }} {{ $route->user->last_name }} </td>
                <td>{{ $route->car->licence_plate }}</td>
                <td>{{ $route->distance_travelled }}</td>
                <td>{{ $route->total_cost }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>User</th>
            <th>Licence plate</th>
            <th>Distance travelled</th>
            <th>Total cost</th>
        </tr>
    </tfoot>
</table>