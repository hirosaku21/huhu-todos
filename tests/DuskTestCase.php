<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\TestCase as BaseTestCase;

abstract class DuskTestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            // 参考URL https://peter.sh/experiments/chromium-command-line-switches/
            '--disable-gpu',
            '--headless',
            '--no-sandbox',
            '--window-size=1920,1080',
            '--ignore-certificate-errors',
            '--unsafely-treat-insecure-origin-as-secure=http://app:5173',
        ]);

        return RemoteWebDriver::create(
            'http://selenium:4444/wd/hub', DesiredCapabilities::chrome()->setCapability(
            ChromeOptions::CAPABILITY,
            $options
        )
        );
    }
}
