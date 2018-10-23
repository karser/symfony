<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\PropertyAccess\Tests\Fixtures;

/**
 * Notice we don't have getter/setter for emails
 * because we count on adder/remover.
 */
class TestSingularAndPluralProps
{
    /** @var string|null */
    private $email;

    /** @var array */
    private $emails = array();

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * @param string $email
     */
    public function addEmail(string $email): void
    {
        $this->emails[] = $email;
    }

    /**
     * @param string $email
     */
    public function removeEmail(string $email): void
    {
        $this->emails = array_diff($this->emails, array($email));
    }
}