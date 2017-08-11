<?php
/*
 * MainPageClass file
 */
 
class MainPage {
    
    private $active_page;
    
    public function __construct($ACTIVE_PAGE) {
        
        $this->active_page = $ACTIVE_PAGE;
        
        switch($this->active_page) {
            //w zaleznosci od parametru $ACTIVE_PAGE ustawiam strone
            case 'home':
            require_once $this->active_page.".library.php";
            break;  
        
            case 'ranking':
            require_once $this->active_page.".library.php";
            break; 
        
            case 'kontakt':
            require_once $this->active_page.".library.php";
            break; 
        
            case 'test':
            require_once $this->active_page.".library.php";
            break; 
            
        }
        
    }
    
}