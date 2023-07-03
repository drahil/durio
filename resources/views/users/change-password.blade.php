<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
</head>

<body>
    <div>
        <h3 >Change Password</h3>

        <form  action="{{ route('changePasswordSave') }}" method="POST">
            @csrf
            @method('POST')
            <div >
                <label for="current_password" >Current Password</label>
                <input type="password"  id="current_password" name="current_password">
            </div>
            <div >
                <label for="new_password" >New Password</label>
                <input type="password"  id="new_password" name="new_password">
            </div>
            <div >
                <label for="new_password_confirmation" >Confirm New Password</label>
                <input type="password"  id="new_password_confirmation" name="new_password_confirmation">
            </div>
            <button type="submit" >Submit</button>
        </form>
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
</body>

</html>
