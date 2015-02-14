<!DOCTYPE html>
<html>
<head><?php include 'header.php'; ?></head>
<body>
<div class="container">
    <div class="page-header">
        <h1>Register to the app</h1>
    </div>
    <div class="col-xs-3">
    <form method="post" action="/register">
        <label for="user">Username</label>
        <input type="text" class="form-control" placeholder="Username"name="user">
        <br/>
        <label for="password">Password</label>
        <input type="password" class="form-control" placeholder="Password"name="password">
        <br/>
        <input type="submit" class='btn btn-default' value="Register !">
    </form>
    <a href="/">Go back to statuses list -></a>
    </div>
</div>
</body>
</html>
