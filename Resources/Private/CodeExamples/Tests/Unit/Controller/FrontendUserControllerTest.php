<?php
namespace Codappix\TestingTalkTests\Unit\Controller;

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
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;

class FrontendUserControllerTest extends TestCase
{
    /**
     * @var FrontendUserController
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new FrontendUserController();
    }

    /**
     * @test
     */
    public function providedFrontendUserIsAssignedToView()
    {
        $frontendUserMock = $this->getMockBuilder(FrontendUser::class)->getMock();
        $viewMock = $this->getMockBuilder(ViewInterface::class)->getMock();
        ObjectAccess::setProperty($this->subject, 'view', $viewMock, true);

        $viewMock->expects($this->once())
            ->method('assign')
            ->with('frontendUser', $frontendUserMock);

        $this->subject->showAction($frontendUserMock);
    }
}
