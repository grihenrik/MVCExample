<?php
/**
 * Description of OwnDatabase
 *
 * @author turunent
 */
class MVCExampleDatabase extends PDO
{
    protected $connected;
    public function __construct($user="", $passwd="", $db="")
    {
        date_default_timezone_set('Europe/Helsinki');
        $this->connected = TRUE;
        include "Configurations/Mysql.php";
        try
        {
            parent::__construct("mysql:dbname=$db;host=127.0.0.1", $user, $passwd);
            
        }
        catch (Exception $ex)
        {
            $this->connected = FALSE;
        }
    }
    /**
     * Insert a message to the chat table
     * 
     * @param string $message
     */
    public function insert_chat($message, $user='Anonymous')
    {
        $sql = "insert into Chat values (0,?,?,?,?)";
        $created = $modified = (new DateTime('NOW'))->format(DateTime::ISO8601);
        //var_dump($created);

        $stm = $this->prepare($sql);
        $stm->execute([$user,$message,$created,$modified]);
    }
    /**
     * Get $count number last messages from chat table
     * 
     * @param int $count
     * @return array of strings
     */
    public function get_chat_messages($count=-1,$user)
    {
        $sql = "select * from Chat where user=? order by Chat.modified desc limit 30";
        //$sql = "select * from Chat where Chat.modified >(now() -interval 30 minute) and (next_Chat.modified is null)".
        //"left join Chat next_Chat on Chat.user = next_Chat.user and Chat.modified < next_Chat.modified".
        //"order by Chat.created desc where user=? limit ?";
        //var_dump((int) filter_var($count, FILTER_SANITIZE_NUMBER_INT),$user,$sql);
        $stm = $this->prepare($sql);
        $stm->execute([$user]);
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }

    public function empty_chat_log($user)
    {
        $sql = "delete from Chat where user=?";
        $stm = $this->prepare($sql);
        $stm->execute([$user]);
        return 1;
    }

    public function insert_user($fname,$sname,$user,$passwd)
    {
        $sql = "insert into ChatUsers values (0,?,?,?,?)";
        
        $stm = $this->prepare($sql);
        $stm->execute([$fname,$sname,$user,$passwd]);
    }
    public function update_user($fname,$sname,$user,$passwd)
    {
        $sql = "update ChatUsers set fname=?, sname=?, passwd=? where user=?";
        
        $stm = $this->prepare($sql);
        $stm->execute([$fname,$sname,$passwd,$user]);
    }
    /**
     * Get $count number last messages from chat table
     * 
     * @param int $count
     * @return array of strings
     */
    public function get_user($user)
    {
        $sql = "select * from ChatUsers where user=?";
        
        $stm = $this->prepare($sql);
        //var_dump($stm);
        $stm->execute([ $user]);
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }
    public function validate_user($user, $passwd)
    {
        $sql = "select * from ChatUsers where user=? and passwd=?";
        
        $stm = $this->prepare($sql);
        //var_dump($stm);
        $stm->execute([$user,$passwd]);
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }
}
