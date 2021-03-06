<?php

    /*
    *   Получить массив цифр числа
    *   (int) @number - число
    *   return array
    */
    function number_to_array($number) {
        if(!is_int($number)) throw new Exception('The number is not integer');
        
        $number = (string) $number;
        $number_len = strlen($number) - 1;
        $arr_digits = array();
        for($i = 0; $i < $number_len; $i++){
            $arr_digits[] = (int) $number{$i};
        }
            
        return $arr_digits;
    }
    

    /*
    *   Получить правильную форму слова
    *   (int) @number - случайное число
    *   (arr) @after - массив слов, 1ый элемент: форма слова при number = 21
    *                               2ой элемент: форма слова при number = 22
    *                               3ий элемент: форма слова при number = 26
    *   return string
    */
    function plural_form($number, $after) {
      $cases = array (2, 0, 1, 1, 1, 2);
      return $after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
    }

    /*
    *   Получить правильное окончание слова
    *   (int) @number - случайное число
    *   (arr) @afterEnds - массив окончаний слов, 1ый элемент: окончание слова при number = 21
    *                                             2ой элемент: окончание слова при number = 22
    *                                             3ий элемент: окончание слова при number = 26
    *   return string
    */
    function plural_form_ending($number, $afterEnds) {
      $cases = array (2, 0, 1, 1, 1, 2);
      return $afterEnds[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
    }
  
    /*
    *   Обрезить нули в конце числа
    *   (int) @number - число
    *   return array
    */
    function cut_zero($number) {
            
        $original_number = $number;
        $i = 0;
        while($number % 10 == 0){
            $i++;
            $number = $number / 10;
        }
        return array('number'=>$number, 'count_zero'=>$i, 'original_number'=>$original_number);    
    }

    /*
    *   Получить массив случайных чисел
    *   (int) @countElements - количество случайных чисел
    *   (int) @min - минимальное значение диапазона
    *   (int) @max - максимальное значение диапазона
    *   return array
    */
    function array_fill_rand($countElements, $min = 1, $max = 99999){

        if($countElements <= 0) throw new Exception('Введите число > 0');
        $arrayRandomValues = array();
        for($i = 0; $i < $countElements; $i++){
            $arrayRandomValues[] = mt_rand($min, $max);
            }  
        return $arrayRandomValues;
        }




    /*
    *   Перемешивает массив, сохраняя ключи
    *   (array) @arr - входящий массив
    *   return array
    */
    function shuffle_with_save_keys($arr){

        $array_temp = array();

        foreach($arr as $key=>$val){
            $random_key = array_rand($arr);
            $array_temp[$random_key] = $arr[$random_key];
            unset($arr[$random_key]);
        }
        return $array_temp;
    }
 


    /*
    *   Получить десятичное число из целого, с определенным количеством знаков после запятой
    *   (int) @number - целое число
    *   (int) @countNumberAfterComma - количество знаков после запятой 
    *   return string
    */
    function int_to_float($number, $countNumberAfterComma){

        $number = (string) $number;
        $numberLen = strlen($number);
        $newNumber = '';

        if($countNumberAfterComma >= $numberLen) {
            $countZero = $countNumberAfterComma - $numberLen;
            $newNumber = '0.'.str_repeat('0', $countZero).$number;
        }
        else {
            for($i = $numberLen - 1, $k = 1; $i >= 0; $i--, $k++){
                $newNumber .= $number{$i};
                if($k == $countNumberAfterComma) $newNumber .= '.';
            }
            
            $newNumber = strrev($newNumber);
        }
        return $newNumber;
    }


    /*
    *   Обрезать нули в десятичном числе
    *   (string) @decimal - десятичное число
    *   return string
    */
    function cut_zero_decimal($decimal) {
        while($decimal{strlen($decimal) -1} == '0') {
            $decimal = substr($decimal, 0, -1);
        }
        if ($decimal{strlen($decimal) -1} == '.') $decimal = substr($decimal, 0, -1);
        return $decimal;
    }


    /*
    *   Получить два числа, удобных для сложения, таких, сумма которых заканчивается на нуль, два нуля или три нуля. 
    *   return array
    */

    function generate_pair_numbers_sum(){
        $num1 = mt_rand(1, 999);
        $num1 = (string) $num1;
        $num2_0 = mt_rand(1, 9);
        $num2_0 = (string) $num2_0;
        
        $num2_mas = array(
            $num2_0 . (10 - substr($num1, strlen($num1) - 1, 1)), 
            $num2_0 . (100 - substr($num1, strlen($num1) - 2, 2)), 
            $num2_0 . (1000 - substr($num1, strlen($num1) - 3, 3))
        );

        $i = mt_rand(0, 2);
        $num2 = $num2_mas[$i];  
        return array($num1, $num2);
    };


    /*
    *   Получить два числа, удобных для вычитания, таких, разность которых заканчивается на нуль, два нуля или три нуля. 
    *   return array
    */
    function generate_pair_numbers_diff(){
        $num1 = mt_rand(1, 999);
        $num1 = (string) $num1;
        $num2_0 = mt_rand(1, 9);
        $num2_0 = (string) $num2_0;
        
        $num2_mas = array(
            $num2_0 . substr($num1, strlen($num1) - 1, 1), 
            $num2_0 . substr($num1, strlen($num1) - 2, 2), 
            $num2_0 . substr($num1, strlen($num1) - 3, 3)
        );

        $i = mt_rand(0, 2);
        $num2 = $num2_mas[$i]; 
        $num_max = max($num1, $num2);
        $num_min = min($num1, $num2);
        return array($num_max, $num_min);
    };





    /*
    *   Получить набор латинских букв от A-Z
    *   (boolean) @lowercase - преобразовать все буквы в нижний регистр
    *   (array)   @exclude - исключающие значения
    *   return array
    */
    function get_en_letters($lowercase = false, $exclude = array()){

        $classes_letters = array();

        foreach (range(chr(0x41), chr(0x5A)) as $letter) {
            if($lowercase) $letter = strtolower($letter);
            if(!in_array($letter, $exclude))
                $classes_letters[] = $letter;
        }
        return $classes_letters;
    }




    /*
    *   Генерирует массив из n случайных букв латинского алфавита.
    *   (int) @n - количество сгенерируемых букв;
    *   (boolean) @register - true - нижний регистр, false - верхний
    *   return array
    */
    function get_some_letters($n, $register){
        $lets = get_en_letters($register);
        for ($i = 0; $i < $n; $i++){
            do{
                $let[$i] = $lets[array_rand($lets)];
            } while ($let[$i] == 'o' || $let[$i] == 'l' || $let[$i] == 'e' || $let[$i] == 'i');
            $lets = array_diff($lets, array($let[$i]));
        }
        return $let;
    }



    /*  
    *   Переводит первую букву строки в верхний регистр
    *   (string) @string - строка
    *   (string) @enc - кодировка
    *   return string
    */
    function mb_ucfirst($string, $enc = 'UTF-8') {
        return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) . mb_substr($string, 1, mb_strlen($string, $enc), $enc);
    }


    /*  
    *   Переводит первую букву строки в нижний регистр
    *   (string) @string - строка
    *   (string) @enc - кодировка
    *   return string
    */
    function mb_lcfirst($string, $enc = 'UTF-8') {
        return mb_strtolower(mb_substr($string, 0, 1, $enc), $enc) . mb_substr($string, 1, mb_strlen($string, $enc), $enc);
    }


    /*
    *   Записывает все делители числа 
    *   (int) @a - число
    *   return array
    */
    function all_dividers($a) {
        $mas = array();
        for ($i=1; $i<=$a; $i++){  
            if ($a % $i==0)      
                $mas[] = $i;
        }
        return $mas;
    }



    /*
    *   Записывает все простые делители числа // 120 = 2, 2, 2, 3, 5
    Если число простое, записывает в массив само число
    *   (int) @a - число
    *   return array
    */
    function factor($n) {
        $ans = array();
        $d = 2;
        while ($d * $d <= $n) {
            if ($n % $d == 0) {
                $ans[] = $d;
                $n = $n / $d;
            } else $d++;
        }
        if ($n > 1) $ans[] = $n;
        return $ans;
    }


    /*
    *   Получить массив одночленов вида a*b*c или a*b или a, где a, b, c - случайные десятичные числа.
    *   (int) @n_monomials - количество одночленов
    *   return array
    */
    function create_monomials_dec_numbers($n_monomials) {
        $mas_monomials = array();
        $mas_index = array();
        $mas_index[0] = 0;
        for ($i = 0; $i < $n_monomials; $i++) {

            $n_numbers = ($mas_index[$i] == 1) ? mt_rand(2, 3) : mt_rand(1, 3) ;
            
            $mas_index[$i+1] = $n_numbers;

            $mas_factors = array(); 

            $dec = array(1, 10, 100);
            for ($j = 0; $j < $n_numbers; $j++){
                $k = mt_rand(0, count($dec)-1);
                $mas_factors[] = mt_rand(1, 99) / $dec[$k];
                if ($dec[$k] == 1) $dec[$k] = 10;
            }
            $monomial = implode(' * ', $mas_factors);
            
            $mas_monomials[] = $monomial;
        }
        return $mas_monomials;
    }



    /*
    *   Вычислить значения выражений массива
    *   (array) @mas_monomials - массив выражений
    *   return array
    */
    function eval_elements_of_array($mas_monomials){
        foreach ($mas_monomials as $monomial) {
            $x = eval('return ' . $monomial . ';');
            $drob = strstr($x, '.');
            $x = round($x, strlen($drob)-1);
            $product_monomials[] = $x;
        }
        return $product_monomials;
    }


    /*
    *   Получить выражение (многочлен) из массива одночленов и случайно выбранных знаков + или -
    *   (array) @mas_monomials - массив одночленов
    *   (array) @product_monomials - массив вычисленных значений одночленов, для проверки, опционально 
    *   return array
    */
    function create_expression_sum_sub($mas_monomials, $product_monomials = array()) {

        if(is_array($product_monomials) && !$product_monomials)
            $product_monomials = $mas_monomials;

        $mas_zn_def = array(' + ', ' - ');

        $condition = $product_monomials[0] > (array_sum(array_slice($product_monomials, 1, count($product_monomials) - 1)));

        for ($i = 0; $i < count($product_monomials) - 1; $i++){
            if (($product_monomials[$i] > $product_monomials[$i + 1]) && $condition){
                    $mas_zn[] = $mas_zn_def[array_rand($mas_zn_def)];
                } else $mas_zn[] = ' + ';
        }

        $expr = '';
        for ($i = 0, $j = 0; $i < count($mas_monomials); $i++, $j++){
            $zn_x = isset($mas_zn[$j]) ? $mas_zn[$j] : '';
            $expr .= $mas_monomials[$i] . $zn_x;
        }
        $result = eval('return ' . $expr . ';');
        $mas_zn = (isset($mas_zn)) ? $mas_zn : '' ;
        return array('expr' => $expr, 'zn' => $mas_zn, 'result' => $result);

    }

    /*
    *   Считает количество символов в строке 
    *   (string) @string - строка
    *   return array
    */
    function u_count_chars($string){
    $result = array();
    $string = (string) $string;
    for($i = 0; $i < strlen($string);$i++){
        if(!isset($result[$string{$i}]))
            $result[$string{$i}] = null;
        $result[$string{$i}]++;
    }
    return $result;
    }


    /*
    *   Вывести умножение в столбик
    *   (int) @a - первый множитель
    *   (int) @b - второй множитель
    *   return string
    */
    function multiply_in_column ($a, $b) {

        $m1 = (string) max($a, $b);
        $m2 = (string) min($a, $b);
        $product = $a * $b;

        $multiply = array();
        $m1_strlen = strlen($m1);
        $m2_strlen = strlen($m2);

        for($j = $m2_strlen - 1; $j >= 0; $j--){
            if($m2{$j} == 0)
                $multiply[] = str_repeat('0', $m1_strlen);
            else
                $multiply[] = $m1 * $m2{$j};
        }
        $str = '';
        $table = '<table width="50px">';
        $table .= "<tr><td align='right'>{$m1}</td></tr>";
        $table .= "<tr><td align='right' style='border-bottom: 1px solid #222;'>{$m2}</td></tr>";
        foreach($multiply as $number){
            $table .= "<tr><td align='right'>{$number}{$str}</td></tr>";
            $str .= ' ';
        }
        if($m2 > 10) {
            $table .= "<tr><td align='right' style='border-bottom: 1px solid #222;'></td></tr>";
            $table .= "<tr><td align='right'>{$product}</td></tr>";
        }
        $table .= '</table>';
        return $table;
    }

    /*
    *   Получить все значения при поэтапном делении в столбик
    *   (int) @divident - делимое
    *   (int) @divider - делитель
    *   return array
    */

    function divide_in_column ($divident, $divider, $accuracy = 4) {

        $divident = (string) $divident;
        $divider = (string) $divider;

        $divident_len = strlen(str_replace('.', '', $divident));
        $n = $divident_len + $accuracy;
    
        $steps = array ();

        $ldivider = $divider;
        $result0 = '';

        if (strpos($divident,'.')) {
            $int_part_divident = substr($divident,0,strpos($divident,'.'));
            $frac_part_divident = substr($divident,strpos($divident,'.')+1,strlen($divident)+1);
        } else {
            $int_part_divident = $divident;
            $frac_part_divident = 0;
        }

        if ($divident < $divider) {
            $result0 .= '0.';  
            $divident = str_replace('.', '', $divident); 
            $ldivident = isset($divident{strlen($int_part_divident)}) ? $int_part_divident . $divident{strlen($int_part_divident)} : $int_part_divident . '0' ; 
            $i_start = strlen($ldivident);  
        } else {
            $i_start = strlen($divider);
            $ldivident = substr($divident, 0, $i_start);
        }
        
        for ($i = $i_start; $i < $n; $i++) {
            $lresult = '';

            $lresult .= floor($ldivident / $ldivider);
            
            if (isset($divident{$i}) && $divident{$i} == '.') {
                $i ++;
                $lresult .= '.';  
            }

            $lsubtr = $lresult * $ldivider;
            $ldifference = $ldivident - $lsubtr;

            if ($i == $divident_len && $frac_part_divident == 0) {
                    $lresult .= '.' ; 
            }

            $steps[] = array ('divident' => $ldivident, 'divider' => $ldivider, 'result' => $lresult, 'subtr' => $lsubtr, 'difference' => $ldifference);
            
            if ($i >= $divident_len && $ldifference == 0) break;

            if (isset($divident{$i})) {    
                $ldivident = ($ldifference != 0) ? $ldifference . $divident{$i} : $divident{$i} ;
            } else $ldivident = $ldifference . '0';
        }

        $steps[0]['result'] = $result0 . $steps[0]['result'];
        $steps[count($steps)-1]['result'] = str_replace('.', '', $steps[count($steps)-1]['result']);
        
        return $steps;
    }

    function divide_in_column_with_remainder ($divident, $divider) {
        $divident = (string) $divident;
        $divider = (string) $divider;
        $div_length = strlen($divider);
        
        $steps = array ();
        $ldivident = substr($divident, 0, $div_length);
        $ldivider = $divider;
        for($i = $div_length; $i < strlen($divident) + 1; $i++) {
            $lresult = floor($ldivident / $ldivider);
            $lsubtr = $lresult * $ldivider;
            $ldifference = $ldivident - $lsubtr;
            
            $steps[] = array ('divident' => $ldivident, 'divider' => $ldivider, 'result' => $lresult, 'subtr' => $lsubtr, 'difference' => $ldifference);
                        
            if ($i < strlen($divident)) {
                $ldivident = ($ldifference != 0) ? $ldifference . $divident{$i} : $divident{$i} ;
            }
        }
        return $steps;
    }


    function print_divide_in_column($divident, $divider, $steps) {
        
        $full_res = '';
        foreach ($steps as $step) {
            $full_res .= $step['result'];
        }
        $result = $full_res;
        
        if ($result{0} == 0 && $result{1} != '.') $result = substr($result, 1, strlen($result));
        
        $remainder = $steps[count($steps) - 1]['difference'];
    
        if ($steps[0]['result'] == 0) array_shift($steps);
    
        for ($i = 0; $i < count($steps); $i++){
            if ($steps[$i]['subtr'] == 0){
                unset($steps[$i]);
            }
        }
        $steps = array_values($steps);

        if ((strlen($divident) <= strlen($divider)) && ($divident < $divider)) $divident_in_column = $steps[0]['divident']; 
            else $divident_in_column = $divident;

        $str = '';
        $table = '<table>';
        $table .= "<tr><td align='left'>{$divident_in_column}</td>";
        $table .= "<td align='left' style='border-bottom: 1px solid #222; border-left: 1px solid #222;'>{$divider}</td></tr>";
        if (strlen($steps[0]['subtr']) != strlen($steps[0]['divident'])) {
            $steps[0]['subtr'] = 'x' . $steps[0]['subtr'];
        }
        $table .= "<tr><td align='left' style='border-bottom: 1px solid #222;'>{$steps[0]['subtr']}{$str}</td>";
        $table .= "<td align='left'>{$result}</td></tr>";
    
        for ($i = 1; $i < count($steps); $i++){
            $x = (isset($steps[$i-1])) ? strlen($steps[$i-1]['subtr']) - strlen($steps[$i-1]['difference']) : '' ;
            if ($x != 0 || $steps[$i-1]['difference'] == 0) {
                $str .= 'x';
            }
            $table .= "<tr><td width='10px' align='left'>{$str}{$steps[$i]['divident']}</td></tr>";
            if (strlen($steps[$i]['divident']) != strlen($steps[$i]['subtr'])) $str .= 'x';
            $table .= "<tr><td width='10px' align='left' style='border-bottom: 1px solid #222;'>{$str}{$steps[$i]['subtr']}</td></tr>";   
        }
        $table .= "<tr><td width='10px' align='right'>{$remainder}</td></tr></table>";
    
        return $table;
    }

    /*
    *   Получить сумму и массив коэффициентов для запоминания при сложении двух чисел
    *   (int) @a - первое слагаемое
    *   (int) @b - второе слагаемое
    *   return array
    */
    function addition_in_column ($a, $b) {

    $s1 = (string) max($a, $b);
    $s2 = (string) min($a, $b);

    $s1_len = strlen($s1);
    $s2_len = strlen($s2);

    $sum = $k_mas = array();
    $k_mas[$s1_len - 1] = 0;

        for($i = $s1_len - 1, $j = $s2_len - 1; $i >= 0; $i--, $j--){

            if($j < 0)
                $x = $s1{$i} + 0 + $k_mas[$i];
            else
                $x = $s1{$i} + $s2{$j} + $k_mas[$i];

            if($x >= 10){
                if($i == 0) $sum[$i] = $x;
                else {
                    $sum[$i] = $x % 10;
                    $k_mas[$i-1] = floor($x / 10);
                }
            } 
            else {
                $sum[$i] = $x;
                $k_mas[$i-1] = 0;
            }
        };
        ksort($sum);
        ksort($k_mas);
        $sum = implode("", $sum);

        return array('sum' => $sum, 'k_mas' => $k_mas);
    };

    /*
    *   Получить вывод самого столбика сложения двух чисел
    *   (int) @a - первое слагаемое
    *   (int) @b - второе слагаемое
    *   (string) @sum - сумма a и b
    *   (array) @k_mas - массив коэффициентов
    *   return string
    */
    function print_addition_in_column ($a, $b, $sum, $k_mas) {

        $s1 = (string) max($a, $b);
        $s2 = (string) min($a, $b);
        $s1_len = strlen($s1);
        $k_num = implode("", $k_mas);
        $str = '';
        $table = '<table width="90px">';
        $table .= "<tr><td align='right'>{$k_num}</td></tr>";
        $table .= "<tr><td align='right'>{$s1}</td></tr>";
        $table .= "<tr><td align='right' style='border-bottom: 1px solid #222;'>{$s2}</td></tr>"; 
        $table .= "<tr><td align='right'>{$sum}</td></tr>";
        $table .= '</table>';

        return $table;
    };

    /*
    *   Получить числа, с замененными случайным образом звездочками цифрами, и массив решения
    *   (int) @a - первое слагаемое
    *   (int) @b - второе слагаемое
    *   (int) @sum - сумма
    *   (array) @k_mas - массив коэффициентов дл язапоминания
    *   return array
    */
    function addition_in_column_with_asterisks ($a, $b, $sum, $k_mas) {

    $s1 = (string) max($a, $b);
    $s2 = (string) min($a, $b);

    $s1_len = strlen($s1);
    $s2_len = strlen($s2);
    $sum_len = strlen($sum);

    $s1_len = strlen($s1);
    $elements = $solutions = array();

        for($i = $s1_len - 1, $j = $s2_len - 1, $k = $sum_len - 1; $j >= 0; $i--, $j--, $k--){
            $lelements = array();
            $lelements = array($s1{$i}, $s2{$j}, $sum{$k});
            if ($i == 0) $n = mt_rand(0, 1);
                else $n = mt_rand(0, 2); 
            /* в этих местах делать поля, для ввода цифры, со звездочкой на фоне */
            $lelements[$n] = '*';
            $elements[] = $lelements;

            $stars = $s2_len - $j;

            if ($n == 2) {
                
                $lsum = $s1{$i} + $s2{$j} + $k_mas[$i]; 
                if ($k_mas[$i] == 0) {      
                    $interim_solution = "{$stars} звездочка: {$s1{$i}} + {$s2{$j}} = $lsum";    
                } else {
                    $interim_solution = "{$stars} звездочка: {$s1{$i}} + {$s2{$j}} + $k_mas[$i] = $lsum" . " (добавляем единицу с предыдущего шага)";
                }
                if ($lsum >= 10) {
                    $solutions[$j] =  $interim_solution . " - записываем в сумму количество единиц {$sum{$k}} и запоминаем единицу для следующего старшего разряда";
                } else  $solutions[$j] = $interim_solution;

            } else {

                if ($sum{$k} >= $lelements[(1 + $n)%2] + $k_mas[$i]) {
                    $ls12 = $sum{$k} - $lelements[(1 + $n)%2] - $k_mas[$i];
                    if ($k_mas[$i] == 0) {
                        $interim_solution = "{$stars} звездочка: {$sum{$k}} - {$lelements[(1 + $n)%2]} = $ls12";    
                    } else {
                        $interim_solution = "{$stars} звездочка: {$sum{$k}} - {$lelements[(1 + $n)%2]} - $k_mas[$i] = $ls12" . " (отнимаем единицу, которую запоминали на предыдущем шаге)";
                    }

                } else {
                    $lsum = '1' . $sum{$k};
                    $interim_solution = "{$stars} звездочка: ";       
                    $ls12 = $lsum - $lelements[(1 + $n)%2] - $k_mas[$i];        
                    if ($k_mas[$i] == 0) {
                        $interim_solution = $interim_solution . "Так как {$sum{$k}} меньше {$lelements[(1 + $n)%2]}, берем {$lsum} (запоминаем при этом единицу для следующего старшего разряда) и отнимаем известное слагаемое: {$lsum} - {$lelements[(1 + $n)%2]} = {$ls12}";
                    } else {
                        if ($sum{$k} == 0) {
                            $interim_solution = $interim_solution . "Так как {$sum{$k}} меньше {$lelements[(1 + $n)%2]}, берем {$lsum} (запоминаем при этом единицу для следующего старшего разряда) отнимаем известное слагаемое и единицу, которую запоминали на предыдущем шаге: {$lsum} - {$lelements[(1 + $n)%2]} - $k_mas[$i] = {$ls12}";
                        } else {
                            $interim_solution = $interim_solution . "Так как {$sum{$k}} - {$k_mas[$i]} (отнимаем единицу, которую запоминали на предыдущем шаге) меньше {$lelements[(1 + $n)%2]}, берем {$lsum} (запоминаем при этом единицу для следующего старшего разряда) отнимаем известное слагаемое и единицу: {$lsum} - {$lelements[(1 + $n)%2]} - $k_mas[$i] = {$ls12}";
                        }
                    }
                }
                $solutions[$j] = $interim_solution;
            }
        }

        $reversed_elements = array_reverse($elements);

        $s1_star = $s2_star = $sum_star = '';

        foreach ($reversed_elements as $lelements) {
            $s1_star = $s1_star . $lelements[0];
        }
        foreach ($reversed_elements as $lelements) {
            $s2_star = $s2_star . $lelements[1];
        }
        foreach ($reversed_elements as $lelements) {
            $sum_star = $sum_star . $lelements[2];
        }
        if ($s1_len > $s2_len) {
            $s1_star = substr($s1, 0, - $s2_len) . $s1_star;
        } 
        if ($sum_len > $s2_len) {
            $sum_star = substr($sum, 0, - $s2_len) . $sum_star;
        }
        return array('a' => $s1_star, 'b' => $s2_star,'sum' => $sum_star, 'solutions' => $solutions);
    }

    /*
    *   Получить вывод самого столбика сложения двух чисел со звездочками
    *   (int) @a - первое слагаемое
    *   (int) @b - второе слагаемое
    *   (string) @sum - сумма a и b
    *   return string
    */
    function print_addition_in_column_with_asterisks ($a, $b, $sum) {

        $str = '';
        $table = '<table width="50px">';
        $table .= "<tr><td align='right'>{$a}</td></tr>";
        $table .= "<tr><td align='right' style='border-bottom: 1px solid #222;'>{$b}</td></tr>"; 
        $table .= "<tr><td align='right'>{$sum}</td></tr>";  
        $table .= '</table>';
        return $table;
    };


    /*
    *   Получить разность и массив коэффициентов для запоминания при вычитании двух чисел
    *   (int) @a - уменьшаемое
    *   (int) @b - вычитаемое
    *   return array
    */

    function subtraction_in_column ($a, $b) {
        $s1 = (string) max($a, $b);
        $s2 = (string) min($a, $b);
        $s1_len = strlen($s1);
        $s2_len = strlen($s2);
        $sub = $k_mas = array();
        $k_mas[$s1_len - 1] = 0;
        for($i = $s1_len - 1, $j = $s2_len - 1; $i >= 0; $i--, $j--){

            if($j < 0){
                if ($s1{$i} == 0 && $k_mas[$i] == 1) {
                    $sub[$i] = 9 ;
                    $k_mas[$i-1] = 1;
                } else {
                    $sub[$i] = $s1{$i} - $k_mas[$i];
                    $k_mas[$i-1] = 0;
                }
            }
            else {
                if($s1{$i} - $k_mas[$i] < $s2{$j}){
                    $ls1 = '1' . $s1{$i};
                    $sub[$i] = $ls1 - $k_mas[$i] - $s2{$j};
                    $k_mas[$i-1] = 1;
                } 
                else {
                    $sub[$i] = $s1{$i} - $k_mas[$i] - $s2{$j};
                    $k_mas[$i-1] = 0;
                }
            }
            if ($i == 0 && $sub[$i] == 0) $sub[$i] = '';
        };
        ksort($sub);
        ksort($k_mas);
        $sub = implode("", $sub);
        return array('sub' => $sub, 'k_mas' => $k_mas);
    };

    /*
    *   Получить вывод самого столбика сложения двух чисел
    *   (int) @a - первое слагаемое
    *   (int) @b - второе слагаемое
    *   (string) @sum - сумма a и b
    *   (array) @k_mas - массив коэффициентов
    *   return string
    */
    function print_subtraction_in_column ($a, $b, $sub, $k_mas) {

        $s1 = (string) max($a, $b);
        $s2 = (string) min($a, $b);
        $s1_len = strlen($s1);
        $k_num = implode("", $k_mas);
        $str = '';
        $table = '<table width="90px">';
        $table .= "<tr><td align='right'>{$k_num}</td></tr>";
        $table .= "<tr><td align='right'>{$s1}</td></tr>";
        $table .= "<tr><td align='right' style='border-bottom: 1px solid #222;'>{$s2}</td></tr>"; 
        $table .= "<tr><td align='right'>{$sub}</td></tr>";     
        $table .= '</table>';
        return $table;
    };


        /*  Получить случайное число с исключение
    *   (int)   @min - минимальное значение
    *   (int)   @max - максимальное значение
    *   (array) @exclude - исключаемые значения
    *   return number
    */
    function mt_rand_exclude($min, $max, $exclude = array()){

        $number = mt_rand($min, $max);
        if(in_array($number, $exclude))
            $number = mt_rand_exclude($min,$max,$exclude);

        return $number;

    }

        /*  Автор: Kobryn Aliaksandr
    *   Вычислить строку
    *   (string) @string
    *   return mixed
    */
    function calc_string ($string) {

        return eval("return {$string};");

    }


    /*  Автор: Kobryn Aliaksandr
    *   Нахождение НОД (наибольшего общего делителя)
    *   (int) @a - число
    *   (int) @b - число
    *   return int
    */
    function NOD($a, $b){

        $a = (int) $a;
        $b = (int) $b;

        if(!is_int($a) || !is_int($b)) throw new Exception('Передайте целые числа');

        $gcd = gmp_gcd($a, $b);
        return (int) gmp_strval($gcd);

    }


    function simplify_fraction($a,$b) {
        
        $x = NOD($a,$b);
        $a = $a/$x;
        $b = $b/$x;
        $res = array();
        if ($a < $b) {
            $res[0] = 0;
            $res[1] = $a;
            $res[2] = $b;
        } elseif ($a == $b) {
            $res[0] = 1;
            $res[1] = 0;
            $res[2] = 0;
        } elseif ($a > $b){
            $res[0] = floor($a/$b);
            $res[1] = $a - $b*$res[0];
            $res[2] = $b;
        }
        return $res;
    }


    function length_frac_part ($a){
        if (strpos($a,'.')) {
            $int_part = substr($a,0,strpos($a,'.'));
            $frac_part = substr($a,strpos($a,'.')+1, strlen($a)+1);
        } else {
            $int_part = $a;
            $frac_part = 0;
        }
    $frac_part_len = ($frac_part == 0) ? 0 : strlen($frac_part) ;
    return $frac_part_len;
    }


    function simplify_fraction_show($a){
        if (($a[0] != 0) && ($a[1] != 0)) $x = "$a[0] $a[1]/$a[2]";
        if ($a[0] == 0){
            if ($a[1] == 0) $x = "0";
            else $x = "$a[1]/$a[2]";
        }
        if ($a[1] == 0) $x = "$a[0]";
    return $x;
    }


    function NOK ($a,$b){
        $m = max($a,$b);
        $n = min($a,$b);
        
        if ($m%$n == 0) return $m;
        
        $m_f = factor($m);
        $n_f = factor($n);
        
        $diff = array();
    
        array_map(function($elem) use (&$m_f, &$diff){
            $find_index = array_search($elem, $m_f);
            if($find_index !== false)
                unset($m_f[$find_index]);
            else
                $diff[] = $elem;
        }, $n_f);
        
    
        $x = array_product($diff);
        return $m * $x;
    }   