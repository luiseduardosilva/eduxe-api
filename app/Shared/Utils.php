<?php


namespace App\Shared;


class Utils
{

    public function onlyNumbers($value): string {
       return preg_replace('/[^0-9]/', '', (string) $value);
    }

    //https://gist.github.com/leonirlopes/5a4a1f796c776d4a695b2d8ca78ab108
    private function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }

    public function maskPhone($telefone){
        if(strlen($telefone) == 10){
            return $this->mask($telefone, "(##)####-####");
        }
        return $this->mask($telefone, "(##) # ####-####");
    }

    public function maskCnpj($cnpj){
        return $this->mask($cnpj, "##.###.###/####-##");
    }
}
