<?php
declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([__DIR__ . '/src', __DIR__ . '/bin'])
    ->name('*.php')
    ->notName('build-info.php')
    ->exclude('vendor');

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12'                       => true,
        '@PHP80Migration'              => true,
        'array_syntax'                 => ['syntax' => 'short'],
        'ordered_imports'              => true,
        'no_unused_imports'            => true,
        'single_quote'                 => true,
        'trailing_comma_in_multiline'  => true,
        'concat_space'                 => ['spacing' => 'one'],
        'blank_line_after_opening_tag' => true,
        'no_blank_lines_after_phpdoc'  => true,
    ])
    ->setFinder($finder);
