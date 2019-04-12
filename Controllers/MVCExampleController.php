<?php
/**
 * Description of MVCExampleController
 *
 * @author turunent
 */
class MVCExampleController
{
    private $fpars;
    public function GetFpars()
    {
        return $this->fpars;
    }
    public function SetFpars($key,$value)
    {
        $this->fpars[$key]=$value;
    }
    
    private $session;
    public function GetSession()
    {
        return $this->session;
    }
    public function SetSession($key,$value)
    {
        $this->session[$key]=$value;
    }
    private $model;
    public function GetModel()
    {
        return $this->model;
    }
    public function SetModel($key,$value)
    {
        $this->model[$key]=$value;
    }

    public function __construct()
    {
        
        $this->fpars = new FormHandling(); // get form variables
        $this->session = new Session(); // create session object
        $this->model = new MVCExampleDatabase();
        
        // route actions
        switch ($this->fpars->act)
        {
            case "Chat":
                $this->Chat();
                break;
            case "Login":
                $this->Login();
                break;
            case "Logout":
                $this->Logout();
                break;
            case "Register User":
                $this->RegisterUser();
                break;
            case "Register":
                $this->Register();
                break;
            case "Delete log":
                $this->DeleteLog();
                break;
            case "Details":
                $this->Details();
                break;
            case "Update User":
                $this->UpdateUser();
                break;
        }
        $this->fpars->act="";
    }
    public function Chat()
    {
        if(!empty($this->fpars->message)){
            $this->model->insert_chat($this->fpars->message,$this->session->login);
        }
        
        $this->ShowChatMessages();
    }
    public function Login()
    {
        if($this->model->get_user($this->fpars->user,$this->fpars->password)){
            $this->session->login = $this->fpars->user; // logged in
        $this->ShowChatMessages();
        } else {
            echo('User not recognized');
        }
    }
    public function Logout()
    {
        $this->session->login = ""; // logged out
        $this->session->user ="";
        $this->session->password ="";
        return 1;
    }
    public function RegisterUser()
    {
        if(!isset($this->fpars->user) && !isset($this->fpars->passwd)){
            echo 'User details incomplete';
            return 0;
        }
        if ($this->model->insert_user( $this->fpars->fname,  $this->fpars->sname, $this->fpars->user, $this->fpars->password)>0){
            echo 'User inserted';
        } else {
            echo 'User not inserted';
        }
    }
    public function Register()
    {
        include "Views/RegisterView.php";
    }
    public function Details()
    {
        $user = $this->model->get_user($this->session->login);

                if(sizeof($this->model->get_user($this->session->login))==1){
                    
                    include "Views/DetailsView.php";
                }
    }
    public function DeleteLog()
    {
        var_dump(sizeof($this->model->get_user($this->session->login))==1);
        if(sizeof(($this->model->get_user($this->session->login))==1)){
            $this->model->empty_chat_log($this->session->login);
            echo "Messages deleted";
        }
        $this->showChatMessages();
    }
    public function UpdateUser()
    {
        if (!empty($this->fpars->passwd)){
            $this->model->update_user($this->fpars->fname,$this->fpars->sname, $this->fpars->user, $this->fpars->passwd);
            echo "Updated info"; 
        } else {
            echo "Password must not be empty";
        }
    }
    public function ShowChatMessages($chat="")
    {
        $the_chat=$this->model->get_chat_messages(30,$this->session->login);
                $this->fpars->chat="";
                foreach ($the_chat as $c){
                    $this->fpars->chat .= $c->modified.'&#09;'.$c->message.'&#10;';
                };
    }
    
    // public function showChatMessages($chat="")
    // {
        
    //     $the_chat=$this->model->get_chat_messages(30,$session->login);
    //             $fpars->chat="";
    //             foreach ($the_chat as $c){
    //                 $fpars->chat .= $c->modified.'&#09;'.$c->message.'&#10;';
    //             };
    //     //return $the_chat;
    // }
}
