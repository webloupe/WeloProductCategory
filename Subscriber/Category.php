<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 17.11.18
 * Time: 23:03
 */

namespace WeloProductCategory\Subscriber;

use Enlight\Event\SubscriberInterface;
use Enlight_Event_EventArgs;
use Enlight_Controller_ActionEventArgs as EventArgs;

/**
 * Class Category
 *
 * @author    Cyprien Nkeneng <cyprien.nkeneng@webloupe.de> - www.webloupe.de
 * @copyright Copyright (c) 2017-2021 WEB LOUPE
 * @package   WeloProductCategory\Subscriber
 * @link      https://www.webloupe.de
 * @version   1
 */
class Category implements SubscriberInterface
{
    /**
     * @var
     */
    private $pluginPath;

    /**
     * @param $pluginPath
     */
    public function __construct($pluginPath)
    {
        $this->pluginPath = $pluginPath;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Backend' => 'addTemplateDir',
            'Enlight_Controller_Action_PostDispatch_Backend_Category' => 'onCategoryPostDispatch'
        ];
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

    /**
     * @param EventArgs $args
     */
    public function addTemplateDir(EventArgs $args)
    {
        $subject = $args->getSubject();
        $view = $subject->View();

        $view->addTemplateDir($this->pluginPath . '/Resources/views/');
    }
}
