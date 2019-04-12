<html>
    <head>
        <meta charset="UTF-8">
        <title>Register New User</title>
        <link rel="stylesheet" type="text/css" href="index.css"/>
    </head>
    <body>
        <div class="register">
        <?= new Form([
            (new Element("span", "", "", [
                "Username: ", new Text("user"),
                "Password: ", new Password("passwd"),
                "First name", new Text("fname"),
                "Last name", new Text("sname"),
                new Submit("act", "Register User")
                ]))
                ->addAttribute("class","username")
            
            ]
                )
         
        ?>
        </div>
        <div class='data'><?=$this->fpars->rows?></div>
    </body>
</html>