@extends('layout.main')
<title>User Detail {{ $users->name }}</title>
@section('container')


    <div class="card">
      <div class="card-header mt-3">
        <h3>Detail User {{ $users->name }}</h3>
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
      <div class="form-group row">
        <div class="col-sm-10">
            <a href="/user_page/index" class="btn btn-warning">Kembali</a>
        </div>
    </div>
    </div>
@endsection