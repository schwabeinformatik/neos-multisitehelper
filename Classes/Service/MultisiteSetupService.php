<?php
namespace Flownative\Neos\MultisiteHelper\Service;

/*
 * This file is part of the Flownative.Neos.MultisiteHelper package.
 *
 * (c) Schwabe AG
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Media\Domain\Model\AssetCollection;
use Neos\Media\Domain\Repository\AssetCollectionRepository;
use Neos\Neos\Domain\Model\Site;
use Neos\Neos\Domain\Repository\SiteRepository;

/**
 * Service to generate site packages
 */
class MultisiteSetupService
{
    /**
     * @Flow\Inject
     * @var AssetCollectionRepository
     */
    protected $assetCollectionRepository;

    /**
     * @Flow\Inject
     * @var SiteRepository
     */
    protected $siteRepository;

    /**
     * Set up multi-site requirements, e.g. the needed asset collection.
     *
     * Call this (at least) once after a site has been installed.
     *
     * @param string $siteNodeName
     * @return void
     */
    public function setup($siteNodeName)
    {
        $assetCollectionTitle = ucfirst($siteNodeName);
        $assetCollection      = $this->assetCollectionRepository->findOneByTitle($assetCollectionTitle);

        if ($assetCollection === null) {
            $assetCollection = new AssetCollection($assetCollectionTitle);
            $this->assetCollectionRepository->add($assetCollection);
        }

        /** @var Site $site */
        $site = $this->siteRepository->findOneByNodeName($siteNodeName);
        $site->setAssetCollection($assetCollection);
        $this->siteRepository->update($site);
    }

}
