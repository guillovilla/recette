<?php
class ControllerAbout extends Controller {
    public function index(){
      return Twig::render('about.php');
    }

    public function error($e = null){
        return 'error '.$e;
    }
}
?>