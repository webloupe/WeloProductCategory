<?php

namespace WeloProductCategory;

use Exception;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class WeloProductCategory
 *
 * @author Steven Thorne <shopware@webloupe.de>
 * @copyright Copyright (c) 2018 Web Loupe
 * @package WeloProductCategory
 * @version   1
 */
class WeloProductCategory extends Plugin
{
    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('welo_product_category.plugin_dir', $this->getPath());
        $container->setParameter('welo_product_category.namespace', $this->getName());

        parent::build($container);
    }

    /**
     * @param InstallContext $context
     *
     * @return void
     */
    public function install(InstallContext $context)
    {
        if (false === $context->assertMinimumVersion(5.2)) {
            $context->scheduleMessage("Failed: Plugin required minimal version of Shopware 5.3 !");
            return;
        }

        try {
            $context->scheduleMessage("Plugin successfully installed");
        } catch (Exception $e) {
            $context->scheduleMessage('Error: ' . $e->getMessage());
        }
    }

    /**
     * @param UninstallContext $context
     *
     * @return void
     */
    public function uninstall(UninstallContext $context)
    {
        try {
            $context->scheduleClearCache(UninstallContext::CACHE_LIST_DEFAULT);
            $context->scheduleMessage("Plugin successfully uninstalled");
        } catch (Exception $e) {
            $context->scheduleMessage("Uninstall error: " . $e->getMessage());
        }
    }
}
