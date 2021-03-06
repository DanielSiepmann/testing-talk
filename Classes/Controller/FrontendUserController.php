<?php
namespace Codappix\TestingTalk\Controller;

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

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Lists and enables editing of frontend users.
 */
class FrontendUserController extends ActionController
{
    /**
     * @var FrontendUserRepository
     */
    protected $frontendUserRepository;

    public function indexAction()
    {
        $this->view->assign('frontendUsers', $this->frontendUserRepository->findAll());
    }

    /**
     * @param FrontendUser $frontendUser
     */
    public function showAction(FrontendUser $frontendUser)
    {
        $this->view->assign('frontendUser', $frontendUser);
    }
}
