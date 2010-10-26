<?php

class Controller_Demo_Home extends MoorActionController {

    protected $_view;

    protected function beforeAction()
    {
        $this->_view = SYS_PATH . str_replace('controller', 'view', Moor::getActivePath()). EXT;
    }

    public function index()
    {
        $tmpl = new fTemplating(VIEW_PATH);
        $meetups = Meetup::findCurrent();

        $tmpl->set(array(
            'header'           => 'partial/header'. EXT,
            'right_block'      => 'partial/right_block'. EXT,
            'footer'           => 'partial/footer'. EXT,
        ));

        $rb_name = Helper_Text::limitWords('Joshua Porter another inner star', 2);

        $tmpl->set('meta', array(
            'description' => 'Index Description',
            'keywords'    => 'Index Keywords'
        ));

        $tmpl->add('css', 'css/main.css', TRUE);
        $tmpl->add('js', 'js/main.js', TRUE);
        $tmpl->add('js', 'js/main2.js');
        $tmpl->add('js', 'js/main3.js');

        $tmpl->set('right', array(
            'name' => $rb_name
        ));

        include $this->_view;
    }


    public function rss()
    {
        $meetups = Meetup::findCurrent();
        include $this->_view;
    }


    public function test()
    {
        echo Moor::getActivePath();
    }


    protected function afterAction() {}

}
