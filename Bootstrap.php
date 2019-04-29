<?php

/**
 * Class Shopware_Plugins_Backend_WeloProductCategory_Bootstrap
 *
 * @author    Cyprien Nkeneng <cyprien.nkeneng@wizmo.de>
 * @copyright Copyright (c) 2005-2018 WIZMO GmbH
 * @version   1
 */
class Shopware_Plugins_Backend_WeloProductCategory_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    /**
     * @return array
     */
    public function getCapabilities() {
        return [
            'install' => true,
            'update' => true,
            'enable' => true
        ];
    }
    
    /**
     * Returns all necessary information about the plugin.
     *
     * @return array
     */
    public function getInfo(){
        return array(
            'version' => $this->getVersion(),
            'label' => $this->getLabel(),
            'supplier' => 'Steven Thorne',
            'author'   => 'Web Loupe',
            'description' => 'Artikel direkt aus der Kategorie listing öffnen',
            'support' => 'Shopware Forum',
            'link' => 'http://www.webloupe.de'
        );
    }
		
    /**
     * @return string
     */
    public function getLabel(){
        return 'Artikelvorschau aus Kategorie';
    }
    
    /**
     * Returns the current version of the plugin
     * @return string
     */
    public function getVersion(){
        return '1.0.0';
    }
    
    /**
     * install plugin method
     *
     * @return bool
     */
    public function install()
    {
        $this->subscribeEvents();
        return true;
    }
    
    /**
     * subscribe events
     *
     * @return void
     */
    public function subscribeEvents()
    {
        $this->subscribeEvent(
            'Enlight_Controller_Action_PostDispatch_Backend_Category',
            'onCategoryPostDispatch'
        );
    }
    
    /**
     * @param Enlight_Event_EventArgs $args
     */
    public function onCategoryPostDispatch(Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Backend_Category $controller */
        $controller = $args->getSubject();
        $view = $controller->View();
        $request = $controller->Request();
        
        /* Add our plugin template directory */
        $view->addTemplateDir($this->Path() . 'Views/');
        
        $templates = [
            'backend/welo_product_category/view/category/tabs/article_mapping.js',
            'backend/welo_product_category/controller/article_mapping.js',
        ];
        
        if ($request->getActionName() === 'load') {
            foreach ($templates as $template) {
                $view->extendsTemplate($template);
            }
        }
    }
}