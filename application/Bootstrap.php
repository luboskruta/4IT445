<?php

/**
 * Uvodni nastaveni aplikace
 *
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Automaticke nacitani modulu
     *
     * @return Zend_Application_Module_Autoloader
     */
    protected function _initAutoload()
    {
        Zend_Loader::loadClass("Zend_Loader_Autoloader");
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('My_');
        $loader->setFallbackAutoloader(true);


        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
                    'basePath' => APPLICATION_PATH,
                    'namespace' => '',
                    'resourceTypes' => array(
                        'form' => array(
                            'path' => 'forms/',
                            'namespace' => 'Form',
                        ),
                        'model' => array(
                            'path' => 'models/',
                            'namespace' => 'Model'
                        ),
                        'plugin' => array(
                            'path' => 'plugins/',
                            'namespace' => 'Application_Plugin',
                        ),
                    ),
                ));

        $loader->pushAutoloader($resourceLoader);

        return $loader;
    }

    /**
     * Prida do include path adresar s modely
     */
    protected function _initIncludePath()
    {
        $rootDir = dirname(dirname(__FILE__));

        set_include_path(get_include_path()
                . PATH_SEPARATOR . $rootDir . '/application/models'
                . PATH_SEPARATOR . $rootDir . '/application/forms'
        );
    }

    /**
     * Nastaveni DOCTYPE webu
     *
     */
    protected function _initDoctype()
    {

        $this->bootstrap('view');
        $view = $this->getResource('view');
		    $view->doctype('HTML5');    
    }

    /**
	 * 
	 * Nastaveni helperu
	 * 
	 */
	protected function _initHelpers() {
	    $view = $this->getResource('view');
               
        $prefix = 'My_View_Helper';
        $dir = APPLICATION_PATH . '/../library/My/View/Helper';
        $view->addHelperPath($dir, $prefix);    
	}
	
	
	/**
     * Nastaveni prepisu URL
     *
     * @param array $options
     */
    protected function _initRouter(array $options = array())
    {

        $this->bootstrap('FrontController');
        $frontController = $this->getResource('FrontController');
        $router = $frontController->getRouter();

        
    }

    /**
     * Nastaveni prekladu textu
     *
     */
    protected function _initTranslate()
    {

        // definice pole s preklady hlasek
        $translations = array('isEmpty' => 'Hodnota je povinná a nemůže být prázdná',
            'A record with the supplied identity could not be found.' => 'Neplatné uživatelské jméno',
            'Supplied credential is invalid.' => 'Neplatné heslo',
            'Please fill the login form' => 'Prosím vyplňte jméno a heslo',
            'Access Denied' => 'Přístup odepřen'
        );

        $translate = new Zend_Translate('array', $translations, 'cs');

        // registrace objektu pro preklady hlasek
        Zend_Registry::set('Zend_Translate', $translate);
    }

}

