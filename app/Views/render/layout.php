<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <title>TODO App</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <style type="text/css">
        #todoList li {cursor: pointer;}
    </style>
    <script src="/js/custom.js"></script>
</head>
<body>

<div class="container">
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <li>
                <?php if(auth()->isLoggedIn()): ?>
                    <a href="/logout">Logout</a>
                <?php else: ?>
                    <a href="/auth">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>

    <div><br>
    <?=$content; ?>
    </div>
</div>
</body>
</html>