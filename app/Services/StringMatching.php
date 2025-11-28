<?php

namespace App\Services;

class StringMatching
{
    public static function matchPositions(string $text, string $pattern, string $algo = 'bm', bool $caseInsensitive = false): array
    {
        if ($pattern === '') {
            return [];
        }
        if ($caseInsensitive) {
            $text = strtolower($text);
            $pattern = strtolower($pattern);
        }
        return match ($algo) {
            'bf' => self::bruteForce($text, $pattern),
            'kmp' => self::kmp($text, $pattern),
            'bm' => self::boyerMoore($text, $pattern),
            default => self::boyerMoore($text, $pattern),
        };
    }

    private static function bruteForce(string $text, string $pattern): array
    {
        $n = strlen($text);
        $m = strlen($pattern);
        $res = [];
        if ($m > $n) {
            return $res;
        }
        for ($i = 0; $i <= $n - $m; $i++) {
            $j = 0;
            while ($j < $m && $text[$i + $j] === $pattern[$j]) {
                $j++;
            }
            if ($j === $m) {
                $res[] = $i;
            }
        }
        return $res;
    }

    private static function kmp(string $text, string $pattern): array
    {
        $n = strlen($text);
        $m = strlen($pattern);
        $res = [];
        if ($m === 0 || $m > $n) {
            return $res;
        }
        $lps = self::kmpLps($pattern);
        $i = 0;
        $j = 0;
        while ($i < $n) {
            if ($text[$i] === $pattern[$j]) {
                $i++;
                $j++;
                if ($j === $m) {
                    $res[] = $i - $j;
                    $j = $lps[$j - 1];
                }
            } else {
                if ($j !== 0) {
                    $j = $lps[$j - 1];
                } else {
                    $i++;
                }
            }
        }
        return $res;
    }

    private static function kmpLps(string $pattern): array
    {
        $m = strlen($pattern);
        $lps = array_fill(0, $m, 0);
        $len = 0;
        $i = 1;
        while ($i < $m) {
            if ($pattern[$i] === $pattern[$len]) {
                $len++;
                $lps[$i] = $len;
                $i++;
            } else {
                if ($len !== 0) {
                    $len = $lps[$len - 1];
                } else {
                    $lps[$i] = 0;
                    $i++;
                }
            }
        }
        return $lps;
    }

    private static function boyerMoore(string $text, string $pattern): array
    {
        $n = strlen($text);
        $m = strlen($pattern);
        $res = [];
        if ($m === 0 || $m > $n) {
            return $res;
        }
        $bad = array_fill(0, 256, -1);
        for ($i = 0; $i < $m; $i++) {
            $bad[ord($pattern[$i])] = $i;
        }
        $shift = 0;
        while ($shift <= $n - $m) {
            $j = $m - 1;
            while ($j >= 0 && $pattern[$j] === $text[$shift + $j]) {
                $j--;
            }
            if ($j < 0) {
                $res[] = $shift;
                $shift += ($shift + $m < $n) ? $m - $bad[ord($text[$shift + $m])] : 1;
            } else {
                $bc = $bad[ord($text[$shift + $j])];
                $shift += max(1, $j - $bc);
            }
        }
        return $res;
    }
}

