<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Simple chat</title>
    </head>
    <body>
        <h1>Simple chat</h1>
        <!-- chat form -->
        <?=
        new Form(
                [(new Textarea("chat"))
                ->addAttribute("readonly")
                ->addAttribute("cols=70 rows=10")
                ->addContent($cont->Getfpars()->chat),
                new Submit("act", "Chat"),
                (new Text("message"))->addAttribute("autocomplete","off")->addAttribute("autofocus"),
                new Submit("act", "Delete log")]
                );
        ?>
        
        <?=
        new Form([(new Text('user',$cont->GetSession()->login))->addAttribute("readonly")->addContent(" user name"),
        (new Submit("act","Details"))
            ]);
        
        ?>
        <br>
        <!-- login form -->
        <?=
        new Form(
                [(new Text("user"))
                    ->addStyle("visibility", $cont->GetSession()->login?"hidden":"visible"),
                (new Password("password"))
                    ->addStyle("visibility", $cont->GetSession()->login?"hidden":"visible"),
                (new Submit("act", "Login"))
                    ->addStyle("visibility", $cont->GetSession()->login?"hidden":"visible"),
                (new Submit("act", "Logout"))
                ->addStyle("visibility", $cont->GetSession()->login?"visible":"hidden"),
                (new Submit("act", "Register"))
                ->addStyle("visibility", $cont->GetSession()->login?"hidden":"visible")]);
        ?>
    </body>
</html>
