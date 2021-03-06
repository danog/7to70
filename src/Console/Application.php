<?php

namespace danog\Php7to70\Console;

use Symfony\Component\Console\Application as ConsoleApplication;

class Application extends ConsoleApplication
{
    public function __construct()
    {
        parent::__construct('php7to70', '1.0.0');

        $this->add(new ConvertCommand());
    }

    public function getLongVersion()
    {
        return parent::getLongVersion().' by <comment>Hannes Van De Vreken & Freek Van der Herten</comment>';
    }
}
