<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\View;

use \Magento\Framework\App\State;

class LayoutTestWithExceptions extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Framework\View\Layout
     */
    protected $layout;

    public function setUp()
    {
        $objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        $layoutFactory = $objectManager->get('Magento\Framework\View\LayoutFactory');
        $this->layout = $layoutFactory->create();
        $layoutElement = new \Magento\Framework\View\Layout\Element(
            __DIR__ . '/_files/layout_with_exceptions/layout.xml',
            0,
            true
        );

        $this->layout->setXml($layoutElement);
        $objectManager->get('Magento\Framework\App\Cache\Type\Layout')->clean();
    }

    /**
     * @expectedException \Magento\Framework\Exception\LocalizedException
     * @expectedExceptionMessage Construction problem.
     */
    public function testProcessWithExceptionsDeveloperMode()
    {
        $this->layout->generateElements();
    }

    /**
     * @magentoAppIsolation enabled
     */
    public function testProcessWithExceptions()
    {
        \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->get('Magento\Framework\App\State')
            ->setMode(State::MODE_DEFAULT);

        $this->layout->generateElements();

        $this->layout->addOutputElement('block.with.broken.constructor');
        $this->layout->addOutputElement('block.with.broken.layout');
        $this->layout->addOutputElement('block.with.broken.action');

        $this->assertEmpty($this->layout->getOutput());
    }
}
