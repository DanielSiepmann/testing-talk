<?php
namespace Codappix\TestingTalk\Tests\Unit\Domain\Model;

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

use Codappix\TestingTalk\Domain\Model\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    /**
     * @test
     */
    public function streetIsTrimmed()
    {
        $subject = new Address(' Street ', '');

        $this->assertSame(
            'Street',
            $subject->getStreet(),
            'Street was not trimmed.'
        );
    }

    /**
     * @test
     */
    public function houseNumberIsTrimmed()
    {
        $subject = new Address('', ' 12 a ');

        $this->assertSame(
            '12 a',
            $subject->getHouseNumber(),
            'House number was not trimmed.'
        );
    }
}
