<?php

class Controller_Demo_User extends MoorActionController {

    protected $_view;


    protected function beforeAction()
    {
        $this->_view = SYS_PATH . str_replace('controller', 'view', Moor::getActivePath()). EXT;
    }


    public function log_in()
    {
        $tmpl = new fTemplating(VIEW_PATH);
        $tmpl->set('header', 'partial/header.php');
        $tmpl->set('footer', 'partial/footer.php');

        if (fRequest::isPost()) {
    		try {
    			$valid_login = fRequest::get('username') == 'admin';
    			$valid_pass  = fCryptography::checkPasswordHash(
    				fRequest::get('password'),
    				'fCryptography::password_hash#B8CnJMDK29#acdec016d3e6608703f1684139dcfa40e424eb55'
    			);

    			if (!$valid_login || !$valid_pass) {
    				throw new fValidationException('The login or password entered is invalid');
    			}

    			// We don't have any fancy users, so this is something to indicate the user is logged in
    			fAuthorization::setUserToken('1');

    			fURL::redirect(
    				fAuthorization::getRequestedURL(TRUE, URL_ROOT . 'manage')
    			);

    		} catch (fExpectedException $e) {
    			fMessaging::create('error', fURL::get(), $e->getMessage());
    		}
	    }

	    include $this->_view;
    }


    public function log_out()
    {
        fAuthorization::destroyUserInfo();
	    fMessaging::create('success', URL_ROOT . 'log_in', 'You were successfully logged out');
	    fURL::redirect(URL_ROOT . 'user/log_in');
    }


    protected function afterAction() {}

}