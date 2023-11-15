<?php


namespace App\Services;



class ProductRecognitionService
{

    public static function extractProductNames($text, $productList)
    {
        $excludeWords = array("is", "a", "an", "not", "and", "want", "i");

        $words = str_word_count(strtolower($text), 1);
        $filteredWords = array_diff($words, $excludeWords);

        // dd($filteredWords);

        $fullyMatchedProducts = [];
        $similarProducts = [];
        $products = [];

        foreach ($filteredWords as $word) {

            foreach ($productList as $product) {

                $matchedWords = [];
                preg_match_all('/\b(?:' . implode('|', explode(' ', preg_quote($product))) . ')\b/i', $word, $matches);
                $matchedWords = array_merge($matchedWords, $matches[0]);

                $similarity = count($matchedWords) / max(str_word_count($product), str_word_count($word));

                if ($similarity == 1 || $similarity >= 0.8) {
                    $fullyMatchedProducts[] = $product;
                } elseif ($similarity > 0) {
                    $similarProducts[] = $product;
                }
            }
            $products['results'] = $fullyMatchedProducts;
            $products['recomenations'] = $similarProducts;
        }

        // dd($products['recomenations']);
        return [
            "results" => array_unique($products['results']),
            "recomenations" => array_unique($products['recomenations']),
        ];
    }
}
