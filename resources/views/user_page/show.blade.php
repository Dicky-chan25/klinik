@extends('layout.main')
<title>User Detail {{ $users->name }}</title>
@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center ml-2 pt-3 pb-2 mb-3">
        <h1 class="h2">Detail User {{ $users->name }}</h1>
    </div>

    <table class="table col-lg-8">
        <tbody>
          <tr>
            <td>User ID</td>
            <td>: {{ $users->id }}</td>
          </tr>
          <tr>
            <td>Nama User</td>
            <td>: {{ $users->name }}</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>: {{ $users->email }}</td>
          </tr>
          <tr>
            <td>Role Id</td>
            <td>: {{ $users->role_id }}</td>
          </tr>
          <tr>
            <td>Password</td>
            <td>: {{ $users->password }}</td>
          </tr>
          <tr>
            <td>Akun Dibuat</td>
            <td>: {{ $users->created_at }}</td>
          </tr>
          <tr>
            <td>Akun Diupdate</td>
            <td>: {{ $users->updated_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
@endsection