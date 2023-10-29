<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhacMan\Yaml\Exception;

use const JSON_UNESCAPED_SLASHES;
use const JSON_UNESCAPED_UNICODE;
use Throwable;

/**
 * Exception class thrown when an error occurs during parsing.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ParseException extends RuntimeException
{
    private ?string $parsedFile;
    private int $parsedLine;
    private ?string $snippet;
    private string $rawMessage;

    /**
     * @param string      $message    The error message
     * @param int         $parsedLine The line where the error occurred
     * @param string|null $snippet    The snippet of code near the problem
     * @param string|null $parsedFile The file name where the error occurred
     */
    public function __construct(string $message, int $parsedLine = -1, string $snippet = null, string $parsedFile = null, Throwable $previous = null)
    {
        $this->parsedFile = $parsedFile;
        $this->parsedLine = $parsedLine;
        $this->snippet = $snippet;
        $this->rawMessage = $message;

        $this->updateRepr();

        parent::__construct($this->message, 0, $previous);
    }

    /**
     * Gets the snippet of code near the error.
     */
    public function getSnippet() : string
    {
        return $this->snippet;
    }

    /**
     * Sets the snippet of code near the error.
     */
    public function setSnippet(string $snippet) : void
    {
        $this->snippet = $snippet;

        $this->updateRepr();
    }

    /**
     * Sets the line where the error occurred.
     */
    public function setParsedLine(int $parsedLine) : void
    {
        $this->parsedLine = $parsedLine;

        $this->updateRepr();
    }

    private function updateRepr() : void
    {
        $this->message = $this->rawMessage;

        $dot = false;
        if (str_ends_with($this->message, '.')) {
            $this->message = substr($this->message, 0, -1);
            $dot = true;
        }

        if (null !== $this->parsedFile) {
            $this->message .= sprintf(' in %s', json_encode($this->parsedFile, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }

        if ($this->parsedLine >= 0) {
            $this->message .= sprintf(' at line %d', $this->parsedLine);
        }

        if ($this->snippet) {
            $this->message .= sprintf(' (near "%s")', $this->snippet);
        }

        if ($dot) {
            $this->message .= '.';
        }
    }
}
