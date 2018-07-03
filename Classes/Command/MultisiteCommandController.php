<?php
namespace Flownative\Neos\MultisiteHelper\Command;

/*
 * This file is part of the Flownative.Neos.MultisiteHelper package.
 *
 * (c) Karsten Dambekalns, Flownative GmbH - www.flownative.com
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Flownative\Neos\MultisiteHelper\Service\MultisiteSetupService;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Neos\Neos\Domain\Model\Site;

/**
 * Command controller for site setup
 */
class MultisiteCommandController extends CommandController
{
    /**
     * @Flow\Inject
     * @var MultisiteSetupService
     */
    protected $multisiteSetupService;

    /**
     * Set up multi-site requirements, e.g. the needed asset collection.
     *
     * Call this (at least) once after a site has been installed.
     *
     * @param string $siteNodeName
     * @return void
     */
    public function setupCommand($siteNodeName)
    {
        $this->multisiteSetupService->setup($siteNodeName);
        $this->outputLine('Site has been set up.');
    }
}
