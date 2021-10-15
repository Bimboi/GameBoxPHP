<?php  
 
 abstract Class Game{  
    public $game_name;
       
    abstract protected function initGameVariables();

    abstract protected function unsetGameVariables();
} 

?>