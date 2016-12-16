<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
</head>
<style type="text/css">
    body{
        padding-top: 2em;
    }
    #reg{
        display: inline-block; 
        vertical-align: top;
        border: 2px solid black;
        padding: 3em;
        text-align: left;
    }
    #login{
        display: inline-block; 
        vertical-align: top;
        border: 2px solid black;
        padding: 3em;
        text-align: left;
    }
    h3{
        text-align: left;
    }
    input{
        /*display: inline-block;*/
        /*vertical-align: top;*/
    }
    .button {
        margin-left: 15em;
    }
    p{
        display: inline-block;
        vertical-align: top;
        position: relative;
        top: -15px;
        margin-right: 10px;
    }
</style>
<body>
    <h1>Welcome!</h1>
    <div id="reg">
        <h3>Register</h3>
    	<form action="/Main/register" method="post">
    	    <p>Name:</p>
    	    <input type="text" name="name"><br>
    	    <p>Alias:</p>
    	    <input type="text" name="alias"><br>
    	    <p>Email:</p>
    	    <input type="text" name="email"><br>
    	    <p>Password:</p>
    	    <input type="password" name="password"><br>
    	    <p>Confirm PW:</p>
    	    <input type="password" name="confirmPassword"><br>
    	    <input class="button" type="submit" value="Register">
            <?= $this->session->flashdata('regError'); ?>
    	</form>
    </div>
    <div id="login">
        <h3>Login</h3>
        <form action="/Main/login" method="post">
            <p>Email:</p>
            <input type="text" name="email"><br>
            <p>Password:</p>
            <input type="password" name="password"><br>
            <input class="button" type="submit" value="Login">
            <?= $this->session->flashdata('loginError'); ?>
            <?= $this->session->flashdata('DNEerror'); ?>
        </form>
</body>
</html>