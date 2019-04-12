<html>
    <head>
        <meta charset="UTF-8">
        <title>Update User</title>
        <link rel="stylesheet" type="text/css" href="index.css"/>
    </head>
    <body>
        <h2>Update user</h2>
        <div class="register">
        <?= new Form([
            (new Element("span", "", "", [
                "Username: ", (new Text("user",$user[0]->user))->addAttribute("readonly"),
                "Password: ", new Password("passwd",$user[0]->passwd),
                "First name", new Text("fname",$user[0]->fname),
                "Last name", new Text("sname",$user[0]->sname),
                new Submit("act", "Update User")
                ]))
                ->addAttribute("class","username")
            
            ]
                )
         
        ?>
        </div>
        <div class='data'><?=$this->fpars->rows?></div>
    </body>
</html>