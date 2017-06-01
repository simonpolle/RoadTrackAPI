<table>
    <thead>
        <tr>
            <th>
                User
            </th>
            <th>
                Email
            </th>
            <th>
                Role
            </th>
            <th>
                Company
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                @if($user->company != null)
                    <td>{{ $user->company->name }}</td>
                @else
                    <td>None</td>
                @endif
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>User</th>
            <th>Email</th>
            <th>Role</th>
            <th>Company</th>
        </tr>
    </tfoot>
</table>