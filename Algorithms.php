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
}

function measureExecutionTime($algorithm, $size, $min, $max) {
    $start_time = microtime(true);
    $algorithms = new Algorithms();
    $array = $algorithms->generateRandomArray($size, $min, $max);
    call_user_func_array([$algorithms, $algorithm], [$array, $min, $max]);
    $end_time = microtime(true);
    $execution_time = $end_time - $start_time;
    echo "Функция: {$algorithm}, Размер массива: {$size}, Время выполнения: {$execution_time}\n";
}


$sizes = [
    100 => range(100, 900, 100),
    1000 => range(1000, 9000, 1000),
    10000 => range(10000, 90000, 10000),
    100000 => range(100000, 900000, 100000),
];

foreach ($sizes as $size => $values) {
    foreach ($values as $value) {
        echo "Размер массива: {$value} \n";
        measureExecutionTime('insertionSort', $value, 0, 99999);
        measureExecutionTime('mergeSort', $value, 0, 99999);
        measureExecutionTime('countingSort', $value, 0, 99999);
        measureExecutionTime('bubbleSort', $value, 0, 99999);
        echo "\n";
    }
}

