<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\MediaBundle\Tests\Block;

use Sonata\BlockBundle\Test\AbstractBlockServiceTestCase;
use Sonata\MediaBundle\Block\FeatureMediaBlockService;

class FeatureMediaBlockServiceTest extends AbstractBlockServiceTestCase
{
    protected $container;
    private $galleryManager;
    private $blockService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = $this->prophesize('Symfony\Component\DependencyInjection\ContainerInterface');
        $this->galleryManager = $this->prophesize('Sonata\MediaBundle\Model\GalleryManagerInterface');

        $this->blockService = new FeatureMediaBlockService(
            'block.service',
            $this->templating,
            $this->container->reveal(),
            $this->galleryManager->reveal()
        );
    }

    public function testDefaultSettings(): void
    {
        $blockContext = $this->getBlockContext($this->blockService);

        $this->assertSettings([
            'attr' => [],
            'content' => false,
            'context' => false,
            'extra_cache_keys' => [],
            'format' => false,
            'media' => false,
            'mediaId' => null,
            'orientation' => 'left',
            'template' => 'SonataMediaBundle:Block:block_feature_media.html.twig',
            'title' => false,
            'ttl' => 0,
            'use_cache' => true,
        ], $blockContext);
    }
}
