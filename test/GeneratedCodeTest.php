<?php

declare(strict_types=1);

/**
 * GeneratedCodeTest.
 *
 * @category Class
 *
 * @see     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

use PHPUnit\Framework\TestCase;

/**
 * The Model and Api classes are OpenAPI generator output, and the generator
 * itself does not live in this repository. That makes the (string) casts added
 * for ZES-91 fragile in a way ordinary code is not: regenerating from the spec
 * would drop every one of them, the suite would stay green — the models still
 * work with strings — and the fatal would only reappear once a plugin passed an
 * integer id in production.
 *
 * This test is the tripwire. If it fails after a regeneration, reapply the casts
 * (or, better, fix the Mustache template) rather than deleting the test.
 */
class GeneratedCodeTest extends TestCase
{
    public function testNoLengthCheckCallsAnUncastValue(): void
    {
        $offenders = [];

        foreach ($this->libraryFiles() as $path) {
            $lines = file($path, FILE_IGNORE_NEW_LINES);

            foreach ($lines as $number => $line) {
                foreach ($this->uncastCalls($line) as $call) {
                    $offenders[] = sprintf('%s:%d  %s', $this->relative($path), $number + 1, trim($line));
                    break;
                }
            }
        }

        self::assertSame(
            [],
            $offenders,
            "These calls would throw a TypeError on PHP 8 for a non-string argument:\n" . implode("\n", $offenders)
        );
    }

    /**
     * Reports the string functions on a line whose first argument is not cast.
     * `ucfirst(strtolower((string) $x))` is fine — the cast is on the inner call.
     *
     * @return list<string>
     */
    private function uncastCalls(string $line): array
    {
        $found = [];

        // strlen and strtolower must cast directly.
        foreach (['strlen', 'strtolower'] as $function) {
            if (preg_match_all('/\b' . $function . '\(\s*(?!\(string\))/', $line, $matches) > 0) {
                $found[] = $function;
            }
        }

        // ucfirst may wrap a strtolower that does the casting itself.
        if (preg_match('/\bucfirst\(\s*(?!\(string\)|strtolower\()/', $line) === 1) {
            $found[] = 'ucfirst';
        }

        return $found;
    }

    /**
     * @return list<string>
     */
    private function libraryFiles(): array
    {
        $paths = [];
        $directory = new \RecursiveDirectoryIterator(\dirname(__DIR__) . '/lib');

        foreach (new \RecursiveIteratorIterator($directory) as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $paths[] = $file->getPathname();
            }
        }

        sort($paths);

        return $paths;
    }

    private function relative(string $path): string
    {
        return str_replace(\dirname(__DIR__) . '/', '', $path);
    }
}
