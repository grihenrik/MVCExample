<!-- login form -->
        <?=
        new Form(
                [(new Text("user"))
                    ->addStyle("visibility", $this->session->login?"hidden":"visible"),
                (new Submit("act", "Login"))
                    ->addStyle("visibility", $this->session->login?"hidden":"visible"),
                (new Submit("act", "Logout"))
                    ->addStyle("visibility", $this->session->login?"visible":"hidden")]
                );
        ?>