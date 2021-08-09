<?php  



class BankEnums
{


    public static function isValidSHABA($shaba)
    {
        //string lenght must be 26
        if(strlen($shaba) == 26){
            $character_map = [
                'A'=> 10, 'B'=> 11, 'C'=> 12, 'D'=> 13, 'E'=> 14, 'F'=> 15, 'G'=> 16, 'H'=> 17, 'I'=> 18, 'J'=> 19,
                'K'=> 20, 'L'=> 21, 'M'=> 22, 'N'=> 23, 'O'=> 24, 'P'=> 25, 'Q'=> 26, 'R'=> 27, 'S'=> 28, 'T'=> 29,
                'U'=> 30, 'V'=> 31, 'W'=> 32, 'X'=> 33, 'Y'=> 34, 'Z'=> 35,
            ];

            //first 4 characters
            $shaba_part_1 = str_split(str_split($shaba,4)[0],1);
            $first_character = $character_map[$shaba_part_1[0]];
            $second_character = $character_map[$shaba_part_1[1]];

            $shaba_part_2 = str_split($shaba,1);
            $part2 = '';
            for($i=4;$i<=25;$i++){
                $part2 .= $shaba_part_2[$i];
            }

            $new_string =  $part2.$first_character.$second_character.$shaba_part_1[2].$shaba_part_1[3];
            $a = str_split($new_string);
            $r = 0;

            foreach($a as $v)
            {
                $r = ((($r * 10) + intval($v)) % 97);
            }
            if($r == 1)
            {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public static function hesabToShaba($hesab,$bank_id)
    {

        $bban_part1 = $bank_id;
        $zeros = '';
        $hesab_length = strlen($hesab);
        $number_of_zeros = 19-$hesab_length;

        if($hesab_length <19){
            for($i=1;$i<=$number_of_zeros;$i++){
                $zeros .= '0';
            }
        }

        $bban = $bban_part1.$zeros.$hesab.'182700'; //'182700' => IR00
        $a = str_split($bban);
        $r = 0;

        foreach($a as $v)
        {
            $r = ((($r * 10) + intval($v)) % 97);
        }
        $cc = 98-$r;

        $shaba =  'IR'.$cc.$bban_part1.$zeros.$hesab;

        return $shaba;
    }

}
