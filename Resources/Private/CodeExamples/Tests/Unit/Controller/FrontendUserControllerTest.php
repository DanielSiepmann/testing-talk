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
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;

class FrontendUserControllerTest extends TestCase
{
    /**
     * @var FrontendUserController
     */
    protected $subject;

    /**
     * @var MockObject
     */
    protected $viewMock;

    public function setUp(): void
    {
        $this->subject = new FrontendUserController();
        $this->viewMock = $this->getMockBuilder(ViewInterface::class)->getMock();
        ObjectAccess::setProperty($this->subject, 'view', $this->viewMock, true);
    }

    /**
     * @test
     */
    public function providedFrontendUserIsAssignedToViewInShowAction()
    {
        $frontendUserMock = $this->getMockBuilder(FrontendUser::class)->getMock();

        $this->viewMock->expects($this->once())
            ->method('assign')
            ->with('frontendUser', $frontendUserMock);

        $this->subject->showAction($frontendUserMock);
    }

    /**
     * @test
     */
    public function fetchedFrontendUsersAreAssignedToViewInIndexAction()
    {
        $frontendUserRepositoryMock = $this->getMockBuilder(FrontendUserRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        ObjectAccess::setProperty($this->subject, 'frontendUserRepository', $frontendUserRepositoryMock, true);
        $frontendUserRepositoryMock->expects($this->any())
            ->method('findAll')
            ->willReturn(['user1' => 'test']);

        $this->viewMock->expects($this->once())
            ->method('assign')
            ->with('frontendUsers', ['user1' => 'test']);

        $this->subject->indexAction();
    }
}
