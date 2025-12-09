/**
 * String Matching Service
 * Menggunakan backend API untuk pencarian string matching dengan optimasi
 */
window.StringMatchingService = (function() {
    'use strict';

    const API_URL = '/api/string-match';
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    // Cache untuk request yang sama (mencegah duplicate API calls)
    const requestCache = new Map();
    const CACHE_TTL = 5000; // 5 detik

    /**
     * Memilih algoritma terbaik berdasarkan panjang pattern dan karakteristik text
     */
    function selectBestAlgorithm(pattern, textLength = 0) {
        if (!pattern) return 'bf';
        const len = pattern.length;
        
        // Untuk pattern sangat pendek (1-2 karakter), Brute Force lebih cepat
        if (len <= 2) return 'bf';
        
        // Untuk pattern pendek (3-5 karakter), Brute Force dengan optimasi
        if (len <= 5) return 'bf';
        
        // Untuk pattern sedang (6-15 karakter), KMP lebih efisien
        if (len <= 15) return 'kmp';
        
        // Untuk pattern panjang (>15 karakter), Boyer-Moore lebih efisien
        return 'bm';
    }

    /**
     * Generate cache key untuk request
     */
    function getCacheKey(text, pattern, algorithm) {
        return `${text}:${pattern}:${algorithm}`;
    }

    /**
     * Melakukan pencarian string matching menggunakan backend API dengan caching
     */
    async function searchWithAlgorithm(text, pattern, algorithm = null) {
        if (!text || !pattern) return [];

        // Early return jika pattern lebih panjang dari text
        if (pattern.length > text.length) {
            return [];
        }

        // Jika algorithm tidak diberikan, pilih yang terbaik
        if (!algorithm) {
            algorithm = selectBestAlgorithm(pattern, text.length);
        }

        // Cek cache terlebih dahulu
        const cacheKey = getCacheKey(text, pattern, algorithm);
        const cached = requestCache.get(cacheKey);
        if (cached && Date.now() - cached.timestamp < CACHE_TTL) {
            return cached.positions;
        }

        try {
            const response = await fetch(API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    text: text,
                    pattern: pattern,
                    algorithm: algorithm
                })
            });

            if (!response.ok) {
                throw new Error('API request failed');
            }

            const data = await response.json();
            let positions = [];
            
            if (data.success && data.data.hasMatch) {
                positions = data.data.positions || [];
            }

            // Simpan ke cache
            requestCache.set(cacheKey, {
                positions: positions,
                timestamp: Date.now()
            });

            // Cleanup cache jika terlalu besar (max 100 entries)
            if (requestCache.size > 100) {
                const firstKey = requestCache.keys().next().value;
                requestCache.delete(firstKey);
            }

            return positions;
        } catch (error) {
            console.error('String matching error:', error);
            // Fallback ke pencarian sederhana jika API gagal
            return fallbackSearch(text, pattern);
        }
    }

    /**
     * Optimized fallback search dengan early exit
     */
    function fallbackSearch(text, pattern) {
        if (!text || !pattern) return [];
        if (pattern.length > text.length) return [];
        
        const results = [];
        const lowerText = text.toLowerCase();
        const lowerPattern = pattern.toLowerCase();
        const patternLen = lowerPattern.length;
        let index = lowerText.indexOf(lowerPattern);
        
        while (index !== -1) {
            results.push(index);
            // Optimasi: mulai pencarian dari posisi berikutnya, bukan dari awal
            index = lowerText.indexOf(lowerPattern, index + 1);
        }
        
        return results;
    }

    /**
     * Clear cache (berguna untuk testing atau memory management)
     */
    function clearCache() {
        requestCache.clear();
    }

    return {
        selectBestAlgorithm: selectBestAlgorithm,
        searchWithAlgorithm: searchWithAlgorithm,
        clearCache: clearCache
    };
})();

