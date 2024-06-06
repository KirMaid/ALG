<?php

class Algorithms
{
    /**
     * Функция для генерации массива со случайными числами
     * @param $size
     * @param $min
     * @param $max
     * @return array
     */
    public function generateRandomArray($size, $min, $max):array
    {
        $array = [];
        for ($i = 0; $i < $size; $i++) {
            $array[] = rand($min, $max);
        }
        return $array;
    }

    /**
     * Алгоритм сортировки вставкой
     *
     * @param array $arr
     * @return array
     */
    public function insertionSort(array $arr): array
    {
        $n = count($arr);
        $sortedArr = $arr; // Создаем копию исходного массива
        for ($i = 1; $i < $n; $i++) {
            $key = $sortedArr[$i];
            $j = $i - 1;

            while ($j >= 0 && $sortedArr[$j] > $key) {
                $sortedArr[$j + 1] = $sortedArr[$j];
                $j--;
            }

            $sortedArr[$j + 1] = $key;
        }
        return $sortedArr; // Возвращаем отсортированный массив
    }

    /**
     * Алгоритм сортировки слиянием
     *
     * @param array $array
     * @return array
     */
    public function mergeSort(array $array): array
    {
        if (count($array) <= 1) {
            return $array;
        }

        $middle = floor(count($array) / 2);
        $left = array_slice($array, 0, $middle);
        $right = array_slice($array, $middle);

        $left = $this->mergeSort($left);
        $right = $this->mergeSort($right);

        return $this->merge($left, $right);
    }

    public function merge(array $left, array $right): array
    {
        $result = [];
        $leftIndex = 0;
        $rightIndex = 0;

        while ($leftIndex < count($left) && $rightIndex < count($right)) {
            if ($left[$leftIndex] < $right[$rightIndex]) {
                $result[] = $left[$leftIndex];
                $leftIndex++;
            } else {
                $result[] = $right[$rightIndex];
                $rightIndex++;
            }
        }

        while ($leftIndex < count($left)) {
            $result[] = $left[$leftIndex];
            $leftIndex++;
        }

        while ($rightIndex < count($right)) {
            $result[] = $right[$rightIndex];
            $rightIndex++;
        }

        return $result;
    }

    /**
     * Алгоритм сортировки подсчётом
     *
     * @param array $array
     * @param int $min
     * @param int $max
     * @return array
     */
    public function countingSort(array $array, int $min, int $max): array
    {
        $count = array_fill($min, $max - $min + 1, 0);
        foreach ($array as $value) {
            $count[$value]++;
        }

        $sorted = array();
        $index = 0;

        for ($i = $min; $i <= $max; $i++) {
            while ($count[$i] > 0) {
                $sorted[$index++] = $i;
                $count[$i]--;
            }
        }

        return $sorted;
    }

    /**
     * Алгорим сортировки пузырьком
     *
     * @param array $array
     * @return array
     */
    public function bubbleSort(array $array): array
    {
        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }
        return $array;
    }

    /**
     * Алгоритм шейкерной сортировки
     *
     * @param array $array
     * @return array
     */
    public function shakerSort(array $array): array {
        $sortedArray = $array;
        $left = 0;
        $right = count($sortedArray) - 1;

        while ($left < $right) {
            for ($i = $left; $i < $right; $i++) {
                if ($sortedArray[$i] > $sortedArray[$i + 1]) {
                    $temp = $sortedArray[$i];
                    $sortedArray[$i] = $sortedArray[$i + 1];
                    $sortedArray[$i + 1] = $temp;
                }
            }
            $right--;
            for ($i = $right; $i > $left; $i--) {
                if ($sortedArray[$i] > $sortedArray[$i - 1]) {
                    $temp = $sortedArray[$i];
                    $sortedArray[$i] = $sortedArray[$i - 1];
                    $sortedArray[$i - 1] = $temp;
                }
            }
            $left++;
        }

        return $sortedArray;
    }

    /**
     * Алгорим пирамидальной сортировки
     *
     * @param array $array
     * @return array
     */
    public function heapSort(array $array): array {
        $n = count($array);
        $outputArray = [];

        for ($i = floor($n / 2) - 1; $i >= 0; $i--) {
            $this->heapify($array, $n, $i);
        }

        for ($i = $n - 1; $i >= 0; $i--) {
            $outputArray[] = $array[0];
            $inputArray[0] = $array[$i];
            $this->heapify($inputArray, --$n, 0);
        }

        return $outputArray;
    }

    public function heapify(&$arr, $n, $i) {
        $largest = $i;
        $left = 2 * $i + 1;
        $right = 2 * $i + 2;

        if ($left < $n && $arr[$left] > $arr[$largest]) {
            $largest = $left;
        }

        if ($right < $n && $arr[$right] > $arr[$largest]) {
            $largest = $right;
        }

        if ($largest!= $i) {
            [$arr[$i], $arr[$largest]] = [$arr[$largest], $arr[$i]];
            $this->heapify($arr, $n, $largest);
        }
    }
}

class Matrix{

    /**
     * Стандартный алгоритм перемножения матриц
     *
     * @param array $A
     * @param array $B
     * @return array
     */
    public function multiplyMatrices(array $A, array $B):array
    {
        $m = count($A);
        $n = count($A[0]);
        $p = count($B[0]);

        $C = array_fill(0, $m, array_fill(0, $p, 0));

        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $p; $j++) {
                for ($k = 0; $k < $n; $k++) {
                    $C[$i][$j] += $A[$i][$k] * $B[$k][$j];
                }
            }
        }

        return $C;
    }

    /**
     * Алгоритм перемножения матриц Штрассена
     *
     * @param array $A
     * @param array $B
     * @return array|float[][]|int[][]
     */
    function strassenMultiply(array $A, array $B):array
    {
        $n = count($A);
        $halfN = floor($n / 2);

        if ($n == 1) {
            return [[ $A[0][0] * $B[0][0] ]];
        }

        $a11 = array_map(function($row) use ($halfN) {return array_slice($row, 0, $halfN);},$A);
        $a12 = array_map(function($row) use ($halfN) { return array_slice($row, -$halfN); }, $A);
        $a21 = array_map(function($row) use ($halfN) { return array_slice($row, 0, $halfN); }, array_map('array_reverse', $A));
        $a22 = array_map(function($row) use ($halfN) { return array_slice($row, -$halfN); }, array_map('array_reverse', $A));

        $b11 = array_map(function($row) use ($halfN) { return array_slice($row, 0, $halfN); }, $B);
        $b12 = array_map(function($row) use ($halfN) { return array_slice($row, -$halfN); }, $B);
        $b21 = array_map(function($row) use ($halfN) { return array_slice($row, 0, $halfN); }, array_map('array_reverse', $B));
        $b22 = array_map(function($row) use ($halfN) { return array_slice($row, -$halfN); }, array_map('array_reverse', $B));

        $m1 = $this->strassenMultiply($a11, array_map(function($el) use ($b22) { return $el - $b22[0]; }, $b12));
        $m2 = $this->strassenMultiply($a11, $a12, array_map(function($el) { return $el; }, $b22));
        $m3 = $this->strassenMultiply($a21, $a22, array_map(function($el) { return $el; }, $b11));
        $m4 = $this->strassenMultiply($a22, array_map(function($el) use ($b11) { return $el - $b11[0]; }, $b21));
        $m5 = $this->strassenMultiply($a11, $a22, array_map(function($el) { return $el; }, $b11, $b22));
        $m6 = $this->strassenMultiply($a12, $a22, array_map(function($el) { return $el; }, $b21, $b22));
        $m7 = $this->strassenMultiply($a11, $a21, array_map(function($el) { return $el; }, $b11, $b12));

        $c11 = array_map(function($_, $m5, $m4, $m2, $m6) {
            return array_sum([$m5[0][0] + $m4[0][0] - $m2[0][0] + $m6[0][0]]);
        }, null, $m5, $m4, $m2, $m6);

        $c12 = array_map(function($_, $m1, $m2) {
            return array_sum([$m1[0][0] + $m2[0][0]]);
        }, null, $m1, $m2);

        $c21 = array_map(function($_, $m3, $m4) {
            return array_sum([$m3[0][0] + $m4[0][0]]);
        }, null, $m3, $m4);

        $c22 = array_map(function($_, $m5, $m1, $m3, $m7) {
            return array_sum([$m5[0][0] + $m1[0][0] - $m3[0][0] - $m7[0][0]]);
        }, null, $m5, $m1, $m3, $m7);

        $C = [];
        foreach ($c11 as $key => $row) {
            $C[$key][] = array_sum(array_map(function($x) use ($key) { return $x[$key]; }, [$c11, $c12, $c21, $c22]));
        }

        return $C;
    }

    /**
     * Генерация матриц определённых размеров
     *
     * @param $size
     * @return array
     */
    public function generateRandomMatrix($size):array
    {
        $matrix = [];
        for ($i = 0; $i < $size; $i++) {
            $row = [];
            for ($j = 0; $j < $size; $j++) {
                $row[] = rand(-100, 100);
            }
            $matrix[] = $row;
        }
        return $matrix;
    }

}

function extendedGCD($a, $b) {
    if ($b == 0) {
        return ['gcd' => $a, 'x' => 1, 'y' => 0];
    } else {
        $res = extendedGCD($b, $a % $b);
        return ['gcd' => $res['gcd'], 'x' => $res['y'], 'y' => $res['x'] - floor(($a / $b) * $res['y'])];
    }
}

//declare(strict_types=1);

function millerRabinTest(int $n, int $iterations = 5): bool
{
    if ($n <= 1 || $n == 4) {
        return false;
    }
    if ($n <= 3) {
        return true;
    }

    $d = $n - 1;
    while ($d % 2 == 0) {
        $d /= 2;
    }

    for ($i = 0; $i < $iterations; $i++) {
        $a = mt_rand(2, $n - 1);
        $x = powMod($a, $d, $n);
        if ($x == 1 || $x == $n - 1) {
            continue;
        }
        for ($r = 1; $r < $d - 1; $r++) {
            $x = ($x * $x) % $n;
            if ($x == $n - 1) {
                break;
            }
        }
        if ($x!= $n - 1) {
            return false;
        }
    }

    return true;
}

function powMod(int $base, int $exponent, int $modulus): int
{
    $result = 1;
    while ($exponent > 0) {
        if ($exponent & 1) {
            $result = ($result * $base) % $modulus;
        }
        $base = ($base * $base) % $modulus;
        $exponent >>= 1;
    }
    return $result;
}

// Пример использования
$n = 2467; // Не простое число
if (millerRabinTest($n)) {
    echo "$n - простое число\n";
} else {
    echo "$n - составное число\n";
}

$n = 54219; // Простое число
if (millerRabinTest($n)) {
    echo "$n - простое число\n";
} else {
    echo "$n - составное число\n";
}


$n = 75361; // Простое число
if (millerRabinTest($n)) {
    echo "$n - простое число\n";
} else {
    echo "$n - составное число\n";
}

// Пример использования
//$a = 14;
//$b = 399;
//
//$result = extendedGCD($a, $b);
//
//echo "Greatest Common Divisor (НОД): ". $result['gcd']. "\n";
//echo "Коэффициент x: ". $result['x']. "\n";
//echo "Коэффициент y: ". $result['y']. "\n";
//
//$a = 311;
//$b = 59771345;
//
//$result = extendedGCD($a, $b);
//
//echo "Greatest Common Divisor (НОД): ". $result['gcd']. "\n";
//echo "Коэффициент x: ". $result['x']. "\n";
//echo "Коэффициент y: ". $result['y']. "\n";


//function measureExecutionTime($algorithm, $size, $min, $max) {
//    $start_time = microtime(true);
//    $algorithms = new Algorithms();
//    $array = $algorithms->generateRandomArray($size, $min, $max);
//    call_user_func_array([$algorithms, $algorithm], [$array, $min, $max]);
//    $end_time = microtime(true);
//    $execution_time = $end_time - $start_time;
//    echo "Функция: {$algorithm}, Размер массива: {$size}, Время выполнения: {$execution_time}\n";
//}
//
//$matrixSizes = [16, 32, 64, 128, 256, 512, 1024, 2048, 4096];
//$matrix = new Matrix();
//foreach ($matrixSizes as $size) {
//    $A = $matrix->generateRandomMatrix($size);
//    $B = $matrix->generateRandomMatrix($size);
//
//    $startTime = microtime(true);
//    $result = $matrix->multiplyMatrices($A, $B);
//    $timeTakenStandard = microtime(true) - $startTime;
//
//    $startTime = microtime(true);
//    $resultStrassen = $matrix->strassenMultiply($A, $B);
//    $timeTakenStrassen = microtime(true) - $startTime;
//
//    echo "Size: {$size}, Standard Time: {$timeTakenStandard} seconds, Strassen Time: {$timeTakenStrassen} seconds\n";
//}
//
//
//$sizes = [
//    100 => range(100, 900, 100),
//    1000 => range(1000, 9000, 1000),
//    10000 => range(10000, 90000, 10000),
//    100000 => range(100000, 900000, 100000),
//];
//
//foreach ($sizes as $size => $values) {
//    foreach ($values as $value) {
//        echo "Размер массива: {$value} \n";
//        measureExecutionTime('insertionSort', $value, 0, 99999);
//        measureExecutionTime('mergeSort', $value, 0, 99999);
//        measureExecutionTime('countingSort', $value, 0, 99999);
//        measureExecutionTime('bubbleSort', $value, 0, 99999);
//        echo "\n";
//    }
//}

