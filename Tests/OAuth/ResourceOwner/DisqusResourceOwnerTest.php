<?php

/*
 * This file is part of the HWIOAuthBundle package.
 *
 * (c) Hardware Info <opensource@hardware.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HWI\Bundle\OAuthBundle\Tests\OAuth\ResourceOwner;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\DisqusResourceOwner;

final class DisqusResourceOwnerTest extends GenericOAuth2ResourceOwnerTest
{
    protected string $resourceOwnerClass = DisqusResourceOwner::class;
    protected string $userResponse = <<<json
{
    "response": {
        "id": "1",
        "username": "bar",
        "name": "foo"
    }
}
json;

    protected array $paths = [
        'identifier' => 'response.id',
        'nickname' => 'response.username',
        'realname' => 'response.name',
    ];

    protected string $authorizationUrlBasePart = 'http://user.auth/?test=2&response_type=code&client_id=clientid&scope=read';
}
