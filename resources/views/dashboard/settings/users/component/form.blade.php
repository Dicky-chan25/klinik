<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua User</h6>
    </div>
    <div class="card-body">

        <form method="POST" action="{{route('users-create')}}">
            @csrf
            <div class="form-group">
                <label for="fname">First Name</label>
                <input @error('fname') style="border:1px solid #ff0000;" @enderror name="fname" type="text"
                    value="{{ old('fname') }}" class="form-control" id="fname" placeholder="fname">
                @error('fname')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input @error('lname') style="border:1px solid red;" @enderror name="lname" type="text"
                    value="{{ old('lname') }}" class="form-control" id="lname" placeholder="lname">
                @error('lname')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input @error('username') style="border:1px solid red;" @enderror name="username" type="text"
                    value="{{ old('username') }}" class="form-control" id="username" placeholder="username">
                @error('username')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input @error('email') style="border:1px solid red;" @enderror name="email" type="email"
                    value="{{ old('email') }}" class="form-control" id="email" placeholder="email">
                @error('email')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input @error('password') style="border:1px solid red;" @enderror name="password" type="password"
                    class="form-control" id="password" placeholder="password">
                @error('password')
                <span class=" text-danger" style="font-size: 12px">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="userlevel">User Level</label>
                <select @error('userlevel') style="border:1px solid red;" @enderror class="form-control" id="userlevel"
                    name="userlevel">
                    <option selected disabled>Choose</option>
                    @foreach ($dataUserLevel as $level)
                    <option value="{{$level->id}}">{{$level->levelname}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Data</button>
        </form>
    </div>
</div>