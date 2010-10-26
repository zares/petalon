<?php

class Controller_Demo_Manage extends MoorActionController {

    protected $_view;
    protected $_manage_url;


    protected function beforeAction()
    {
        fAuthorization::requireLoggedIn();
        $this->_view = SYS_PATH . str_replace('controller', 'view', Moor::getActivePath()). EXT;
        $this->_manage_url = URL_ROOT . Meetup::makeURL('manage');
    }


    public function index()
    {
        $tmpl = new fTemplating(VIEW_PATH);
        $tmpl->set('header', 'partial/header.php');
        $tmpl->set('footer', 'partial/footer.php');
        $tmpl->set('title', 'Manage Meetups');

	    $col = fCRUD::getSortColumn('date', 'location');
	    $dir = fCRUD::getSortDirection('desc');
	    fCRUD::redirectWithLoadedValues();

	    $meetups = Meetup::findAll($col, $dir);

        include $this->_view;
    }


    public function add()
    {
        $tmpl = new fTemplating(VIEW_PATH);
        $tmpl->set('header', 'partial/header.php');
        $tmpl->set('footer', 'partial/footer.php');
        $tmpl->set('title', 'Add a Meetup');

    	$meetup = new Meetup();

    	if (fRequest::isPost()) {

    		try {
    			$meetup->populate();

    			fRequest::validateCSRFToken(fRequest::get('token'));

    			$meetup->store();

    			fMessaging::create('affected', $this->_manage_url, $meetup->getDate()->__toString());
    			fMessaging::create('success', $this->_manage_url, 'The meetup on ' . $meetup->getDate()->format('F j, Y') . ' was successfully created');
    			fURL::redirect($this->_manage_url);

    		} catch (fExpectedException $e) {
    			fMessaging::create('error', fURL::get(), $e->getMessage());
    		}

    	} else {

    		// Get the third thursday of this month, or next month if this month's has passed
    		$date = fDate()->modify('Y-m-01')->adjust('+3 thursdays');
    		if ($date->lt()) {
    			$date = fDate('next month')->modify('Y-m-01')->adjust('+3 thursdays');
    		}

    		$meetup->setDate($date);
    		$meetup->setVenue('The Grog');
    		$meetup->setVenueWebsite('http://thegrog.com');
    		$meetup->setCity('Newburyport');
    		$meetup->setState('MA');
    		$meetup->setStartTime('7:00 pm');
    		$meetup->setEndTime('10:30 pm');

    	}

        include $this->_view;
    }


    public function edit()
    {
        $tmpl = new fTemplating(VIEW_PATH);
        $tmpl->set('header', 'partial/header.php');
        $tmpl->set('footer', 'partial/footer.php');
        $tmpl->set('title', 'Edit Meetup');

        $date     = (isset($_GET['date'])) ? $_GET['date'] : '';
        $old_date = '';

    	try {

    		$meetup = new Meetup($old_date ? $old_date : $date);

    		if (fRequest::isPost()) {

    			$meetup->populate();

    			fRequest::validateCSRFToken(fRequest::get('token'));

    			$meetup->store();

    			fMessaging::create('affected', $this->_manage_url, $meetup->getDate()->__toString());
    			fMessaging::create('success', $this->_manage_url, 'The meetup on ' . $meetup->getDate()->format('F j, Y') . ' was successfully updated');
    			fURL::redirect($this->_manage_url);

    		}

    	} catch (fNotFoundException $e) {
    		fMessaging::create('error', $this->_manage_url, 'The meetup requested, ' . fHTML::encode($date) . ', could not be found');
    		fURL::redirect($this->_manage_url);

    	} catch (fExpectedException $e) {
    		fMessaging::create('error', fURL::get(), $e->getMessage());
    	}

        include $this->_view;
    }


    public function delete()
    {
        $tmpl = new fTemplating(VIEW_PATH);
        $tmpl->set('header', 'partial/header.php');
        $tmpl->set('footer', 'partial/footer.php');
        $tmpl->set('title', 'Delete Meetup');

        $date     = (isset($_GET['date'])) ? $_GET['date'] : '';
        $old_date = '';

    	try {

    		$meetup = new Meetup($date);

    		if (fRequest::isPost()) {

    			fRequest::validateCSRFToken(fRequest::get('token'));

    			$meetup->delete();

    			fMessaging::create('success', $this->_manage_url, 'The meetup on ' . $meetup->getDate()->format('F j, Y') . ' was successfully deleted');
    			fURL::redirect($this->_manage_url);

    		}

    	} catch (fNotFoundException $e) {
    		fMessaging::create('error', $this->_manage_url, 'The meetup requested, ' . fHTML::encode($date) . ', could not be found');
    		fURL::redirect($this->_manage_url);

    	} catch (fExpectedException $e) {
    		fMessaging::create('error', fURL::get(), $e->getMessage());
    	}

        include $this->_view;
    }


    protected function afterAction() {}

}