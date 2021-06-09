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
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Permissions</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($roles_pdf as $role_pdf)
        <tr>
            <td>
                {{ $role_pdf->id }}
            </td>
            <td>{{ $role_pdf->page_id }}</td>
            <td>{{ $role_pdf->name }}</td>
            <td>
                @foreach($role_pdf->permissions as $key => $value)
                {{ $key }},
                @endforeach
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>