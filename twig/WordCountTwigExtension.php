<?php

namespace Grav\Theme\Editorial;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * WordCountTwigExtension Extension
 *
 * Provides word counting functionality for Twig templates
 * with support for multiple languages and improved accuracy
 *
 * @category Extensions
 * @package Grav\Theme
 * @author Pedro Moreno <https://github.com/pmoreno-rodriguez>
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @link https://github.com/pmoreno-rodriguez/grav-theme-editorial
 */

class WordCountTwigExtension extends AbstractExtension
{
    /**
     * Returns a list of filters to add to the existing list
     *
     * @return array An array of filters
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('wordcount', [$this, 'wordCountFilter']),
        ];
    }

    /**
     * Returns a list of functions to add to the existing list
     *
     * @return array An array of functions
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('word_count', [$this, 'wordCountFilter']),
        ];
    }

    /**
     * Count words in text with improved accuracy for multiple languages
     *
     * @param string $text The text to count words from
     * @param string $locale Optional locale for language-specific counting (default: 'en')
     * @return int Number of words
     */
    public function wordCountFilter($text, string $locale = 'en'): int
    {
        if (empty($text)) {
            return 0;
        }

        // Strip HTML tags and decode entities
        $cleanText = html_entity_decode(strip_tags($text), ENT_QUOTES, 'UTF-8');
        
        // Remove extra whitespace and normalize
        $cleanText = trim(preg_replace('/\s+/', ' ', $cleanText));
        
        if (empty($cleanText)) {
            return 0;
        }

        // Handle different languages
        switch (strtolower($locale)) {
            case 'zh':
            case 'zh-cn':
            case 'zh-tw':
            case 'chinese':
                // Chinese: count characters (excluding spaces and punctuation)
                return mb_strlen(preg_replace('/[\s\p{P}]/u', '', $cleanText), 'UTF-8');
                
            case 'ja':
            case 'japanese':
                // Japanese: count characters (excluding spaces)
                return mb_strlen(preg_replace('/\s/', '', $cleanText), 'UTF-8');
                
            case 'ko':
            case 'korean':
                // Korean: count characters (excluding spaces)
                return mb_strlen(preg_replace('/\s/', '', $cleanText), 'UTF-8');
                
            default:
                // Western languages: use improved word counting
                // Handle contractions, hyphenated words, and numbers better
                $words = preg_split('/\s+/', $cleanText, -1, PREG_SPLIT_NO_EMPTY);
                
                // Filter out pure punctuation
                $words = array_filter($words, function($word) {
                    return preg_match('/\w/', $word);
                });
                
                return count($words);
        }
    }



    /**
     * Returns the name of the extension
     *
     * @return string The extension name
     */
    public function getName(): string
    {
        return 'wordcount';
    }
}