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

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\FoursquareResourceOwner;
use HWI\Bundle\OAuthBundle\OAuth\Response\AbstractUserResponse;

final class FoursquareResourceOwnerTest extends GenericOAuth2ResourceOwnerTest
{
    protected string $resourceOwnerClass = FoursquareResourceOwner::class;
    protected string $userResponse = <<<json
{
    "response": {
        "user": {
            "id": "1",
            "firstName": "bar",
            "lastName": "foo"
        }
    }
}
json;

    protected array $paths = [
        'identifier' => 'response.user.id',
        'firstname' => 'response.user.firstName',
        'lastname' => 'response.user.lastName',
        'nickname' => 'response.user.firstName',
        'realname' => ['response.user.firstName', 'response.user.lastName'],
    ];

    public function testGetUserInformationFirstAndLastName(): void
    {
        $resourceOwner = $this->createResourceOwner(
            [],
            [],
            [
                $this->createMockResponse($this->userResponse, 'application/json; charset=utf-8'),
            ]
        );

        /**
         * @var AbstractUserResponse
         */
        $userResponse = $resourceOwner->getUserInformation(['access_token' => 'token']);

        $this->assertEquals('bar', $userResponse->getFirstName());
        $this->assertEquals('foo', $userResponse->getLastName());
    }
}
