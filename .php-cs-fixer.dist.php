<?php

declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in('config')
    ->in('src')
    ->append([
        '.php-cs-fixer.dist.php',
        'web/index.php',
    ])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'no_superfluous_phpdoc_tags' => true,
        'void_return' => true,
        'method_chaining_indentation' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
        'class_definition' => [
            'single_item_single_line' => true,
        ],
        'static_lambda' => true,
        'use_arrow_functions' => true,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'new_line_for_chained_calls',
        ],
        'phpdoc_to_comment' => false,
        'declare_strict_types' => true,
        'strict_param' => true,
        'final_class' => true,
    ])
    ->setFinder($finder);
