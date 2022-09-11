<?php

namespace App\CommonMark;

use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use Torchlight\Commonmark\V2\TorchlightExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\DescriptionList\DescriptionListExtension;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;

class MarxdownConverter extends \League\CommonMark\MarkdownConverter
{
    public static function make()
    {
        return new self([
            'default_attributes' => [
                Image::class => ['loading' => 'lazy'],
                Link::class => [
                    'rel' => function (Link $node) {
                        if (! str_contains($node->getUrl(), url('/')) && ! Str::startsWith($node->getUrl(), '#')) {
                            return 'nofollow noopener noreferrer';
                        }
                    },
                    'target' => function (Link $node) {
                        if (! str_contains($node->getUrl(), url('/')) && ! Str::startsWith($node->getUrl(), '#')) {
                            return '_blank';
                        }
                    },
                ],
            ],
        ]);
    }

    /**
     * @param array<string, mixed> $config
     */
    public function __construct(array $config = [])
    {
        $environment = new Environment($config);
        $environment->addExtension(new AttributesExtension);
        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new DefaultAttributesExtension);
        $environment->addExtension(new DescriptionListExtension);
        $environment->addExtension(new GithubFlavoredMarkdownExtension);
        $environment->addExtension(new SmartPunctExtension);
        $environment->addExtension(new TableExtension);
        $environment->addExtension(new TorchlightExtension);

        parent::__construct($environment);
    }
}
