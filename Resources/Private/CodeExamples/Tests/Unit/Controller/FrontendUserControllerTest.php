<?php

namespace Codappix\TestingTalk\Tests\Unit\Controller;

/*
 * Copyright (C) 2018  Daniel Siepmann <coding@daniel-siepmann.de>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301, USA.
 */

use Codappix\TestingTalk\Controller\FrontendUserController;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;

class FrontendUserControllerTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var FrontendUserController
     */
    protected $subject;

    /**
     * @var ObjectProphecy
     */
    protected $view;

    public function setUp(): void
    {
        $this->subject = new FrontendUserController();
        $this->view = $this->prophesize(ViewInterface::class);
        $this->setProperty($this->subject, 'view', $this->view->reveal());
    }

    /**
     * @test
     */
    public function providedFrontendUserIsAssignedToViewInShowAction()
    {
        $frontendUser = $this->prophesize(FrontendUser::class);

        $this->view
            ->assign('frontendUser', $frontendUser->reveal())
            ->shouldBeCalled();

        $this->subject->showAction($frontendUser->reveal());
    }

    /**
     * @test
     */
    public function fetchedFrontendUsersAreAssignedToViewInIndexAction()
    {
        $frontendUserRepository = $this->prophesize(FrontendUserRepository::class);
        $this->setProperty($this->subject, 'frontendUserRepository', $frontendUserRepository->reveal());
        $frontendUserRepository
            ->findAll()
            ->willReturn(['user1' => 'test'])
            ->shouldBeCalled();

        $this->view
            ->assign('frontendUsers', ['user1' => 'test'])
            ->shouldBeCalled();

        $this->subject->indexAction();
    }

    private function setProperty($object, string $propertyName, $value): void
    {
        $reflectionClass = new \ReflectionClass(get_class($object));

        $reflectionProperty = $reflectionClass->getProperty($propertyName);
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($object, $value);
    }
}
