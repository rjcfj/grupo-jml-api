<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CnpjValido implements Rule
{
    public function passes($attribute, $value)
    {
        $cnpj = preg_replace('/\D/', '', $value); // remove tudo que não for número

        if (strlen($cnpj) != 14) {
            return false;
        }

        // Validação básica de sequência inválida
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Validação do dígito verificador
        $t = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $t2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += $cnpj[$i] * $t[$i];
        }
        $d1 = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);

        $sum = 0;
        for ($i = 0; $i < 13; $i++) {
            $sum += $cnpj[$i] * $t2[$i];
        }
        $d2 = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);

        return $cnpj[12] == $d1 && $cnpj[13] == $d2;
    }

    public function message()
    {
        return 'O campo CNPJ não é válido.';
    }
}
