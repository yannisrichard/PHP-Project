<!DOCTYPE html>
<html>
<head><?php include 'header.php'; ?></head>
<body>
<div class="container">
    <div class="page-header">
        <h1>Connect to the app</h1>
    </div>
    <div class="col-xs-3">
        <form method="post" action="/login">
            <label for="user">Username</label>
            <input type="text" class="form-control" rows="1" placeholder="Your username"name="user">
            <br/>
            <label for="password">Password</label>
            <input type="password" class="form-control" rows="1" placeholder="Your password" name="password">
            <br/>
            <input type="submit" class='btn btn-default' value="Login !">
        </form>
    <h4>You have no account ? <a href="/register">Register</a></h4>
    <a href="/">Go back to statuses list -></a>
    </div>
</div>
</body>
</html>
