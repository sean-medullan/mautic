<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\ConfigBundle\Event;

use Mautic\CoreBundle\Event\CommonEvent;

/**
 * Class ConfigEvent
 *
 * @package Mautic\ConfigBundle\Event
 */
class ConfigBuilderEvent extends CommonEvent
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var array
     */
    private $forms = array();

    /**
     * Consctructor
     * 
     * @param appProdProjectContainer|appDevDebugProjectContainer
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Set new form to the forms array
     *
     * @param array $form
     * 
     * @return void
     */
    public function addForm($form)
    {
        $this->forms[] = $form;
    }

    /**
     * Returns the forms array
     *
     * @return array
     */
    public function getForms()
    {
        return $this->forms;
    }

    /**
     * Returns the container
     *
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Returns the container
     *
     * @param string $path (relative from the root dir)
     * @return array
     */
    public function getParameters($path)
    {
        $paramsFile = $this->getContainer()->getParameter('kernel.root_dir') . $path;

        if (file_exists($paramsFile)) {
            // Import the bundle configuration, $parameters is defined in this file
            include $paramsFile;
        }

        if (!isset($parameters)) {
            $parameters = array();
        }

        return $parameters;
    }
}
