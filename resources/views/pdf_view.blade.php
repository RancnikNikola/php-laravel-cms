<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Demo in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr class="table-danger">
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Last Login</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($users_pdf as $pdf_user)
        <tr>
            <td>
                {{ $pdf_user->name }}
            </td>
            <td>{{ $pdf_user->surname }}</td>
            <td>{{ $pdf_user->email }}</td>
            <td>{{ implode(', ', $pdf_user->roles()->get()->pluck('name')->toArray()) }}</td>
            <td>{{ ($pdf_user->updated_at->diffForHumans()) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>