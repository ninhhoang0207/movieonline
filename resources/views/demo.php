<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
{!! Form::open(['url' => 'films','method'=>'post']) !!}
    <div>
        <input type="text" name="user" value="User" />
        <input type="password" name="password" value="Pass" />
        <input type="submit" name="Login" value="Login">
        <input type="reset" name="cancel" value="Cancel">
    </div>
{!! Form::close() !!}
</form>
</body>
</html>