<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\UtilsBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends Command
{
    protected BridgeInterface $bridge;

    /**
     * {@inheritdoc}
     */
    public function __construct(BridgeInterface $bridge)
    {
        $this->bridge = $bridge;
        parent::__construct(static::$defaultName);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName(static::$defaultName)
            ->setDescription(static::$defaultDescription)
            ->setDefinition($this->bridge->argumentDefinition())
            ->setHelp($this->bridge->helpMessage());
    }

    /**
     * {@inheritdoc}
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->bridge->argumentQuestioners($input) as $name => $question) {
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument($name, $answer);
        }
        foreach ($this->bridge->optionQuestioners($input) as $name => $question) {
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setOption($name, $answer);
        }
    }
}
