<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\WordDelimiterTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractWordDelimiterTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class WordDelimiterTokenFilterTest extends TestCase
{
    public function test_word_delimiter_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new WordDelimiterTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_WORD_DELIMITER,
                'generate_word_parts' => true,
                'generate_number_parts' => true,
                'catenate_words' => false,
                'catenate_numbers' => false,
                'catenate_all' => false,
                'split_on_case_change' => true,
                'preserve_original' => false,
                'split_on_numerics' => true,
                'stem_english_possessive' => true
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_word_delimiter_token_filter_with_protected_words_path_can_be_converted_to_array(): void
    {
        $tokenFilter = (new WordDelimiterTokenFilter('foo'))
            ->setGenerateWordParts(false)
            ->setGenerateNumberParts(false)
            ->setCatenateWords(true)
            ->setCatenateNumbers(true)
            ->setCatenateAll(true)
            ->setSplitOnCaseChange(false)
            ->setPreserveOriginal(true)
            ->setSplitOnNumerics(false)
            ->setStemEnglishPossessive(false)
            ->setProtectedWordsPath('/protected_words.txt');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_WORD_DELIMITER,
                'generate_word_parts' => false,
                'generate_number_parts' => false,
                'catenate_words' => true,
                'catenate_numbers' => true,
                'catenate_all' => true,
                'split_on_case_change' => false,
                'preserve_original' => true,
                'split_on_numerics' => false,
                'stem_english_possessive' => false,
                'protected_words_path' => '/protected_words.txt'
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_word_delimiter_token_filter_with_protected_words_can_be_converted_to_array(): void
    {
        $tokenFilter = (new WordDelimiterTokenFilter('foo'))
            ->setGenerateWordParts(false)
            ->setGenerateNumberParts(false)
            ->setCatenateWords(true)
            ->setCatenateNumbers(true)
            ->setCatenateAll(true)
            ->setSplitOnCaseChange(false)
            ->setPreserveOriginal(true)
            ->setSplitOnNumerics(false)
            ->setStemEnglishPossessive(false)
            ->protectWord('protectedWord1')
            ->protectWord('protectedWord2');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_WORD_DELIMITER,
                'generate_word_parts' => false,
                'generate_number_parts' => false,
                'catenate_words' => true,
                'catenate_numbers' => true,
                'catenate_all' => true,
                'split_on_case_change' => false,
                'preserve_original' => true,
                'split_on_numerics' => false,
                'stem_english_possessive' => false,
                'protected_words' => [
                    'protectedWord1',
                    'protectedWord2'
                ]
            ],
            $tokenFilter->toArray()
        );
    }
}
