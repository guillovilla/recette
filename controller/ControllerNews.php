<?php
class ControllerNews extends Controller {
    public function index(){
      return Twig::render('news.php');
    }

    public function error($e = null){
        return 'error '.$e;
    }
}
?>