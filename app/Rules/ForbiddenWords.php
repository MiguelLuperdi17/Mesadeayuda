<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ForbiddenWords implements Rule
{
    // Lista de palabras prohibidas
    protected $forbiddenWords = ['Laredo', 'laredo', 'L4r3d0',
        'LAREDO', 'password', '123456', '123456789', 'qwerty',
        'password1', '12345678', '111111', '123123', 'admin',
        'welcome', 'letmein', 'monkey', 'login', '12345',
        'password123', '1234567', 'qwertyuiop', '123321',
        'qwerty123', 'admin123', 'password01', 'passw0rd',
        'letmein1', 'sunshine', 'iloveyou', 'admin1', '1234',
        'root', 'welcome1', '1q2w3e4r', 'qazwsx', 'zxcvbnm',
        'qwerty1', '123qwe', '1q2w3e', '123abc', 'password!',
        'pass123', 'qwe123', 'abc123', '1q2w3e4r5t', '1q2w3e4r',
        'qwertyui', 'password12', '112233', 'abcdef', 'hello',
        'iloveyou1', 'qwertyuiop1', 'password1234', '1234567890',
        '123456a', 'password2021', 'welcome123', 'letmein123',
        '12345qwert', 'adminadmin', 'admin1234', 'rootroot',
        'letmein!', 'welcome!', 'qwerty!', '123456!', 'password!',
        'password2022', 'letmein2022', '123456q', 'qwerty1234',
        '123456abc', 'password2020', 'welcome2020', 'letmein2020',
        'sunshine1', 'iloveyou2', 'abc123456', '1q2w3e4r5t6y7u',
        '123456a!', 'admin2021', 'welcome2021', 'root2021',
        'letmein2021', 'sunshine2021', 'password2022', '12345678901',
        'password12345', 'letmein12345', 'welcome12345', 'qwerty12345',
        '1234abcd', 'password2023', 'admin2022', 'root2022',
        'letmein2023', 'sunshine2023', 'welcome2023', 'password123456',
        '1234567a', '1234567!', 'password1234567', 'letmein123456',
        'welcome123456', 'qwerty123456', '123456abc!', 'password123!',
        'letmein123!', 'admin123!', 'welcome1!', 'qwerty1!','abc123',
        'password1!', 'admin12345', '123456789a', 'letmein1234',
        'welcome1234', 'password2024', 'admin2023', 'root2023',
        'letmein2024', 'sunshine2024', 'welcome2024', '123456abcd',
        'password1234!', 'letmein123456!', 'welcome123456!', 'qwerty123456!',
        '1234567a!', '123456a!', 'admin2024', 'root2024', '1234567abc'
    ];

    // Verifica si la contraseña contiene alguna palabra prohibida
    public function passes($attribute, $value)
    {
        foreach ($this->forbiddenWords as $word) {
            if (stripos($value, $word) !== false) {
                return false; // La contraseña contiene una palabra prohibida
            }
        }
        return true; // La contraseña no contiene palabras prohibidas
    }

    // Mensaje de error para la validación
    public function message()
    {
        return 'La contraseña no debe contener ninguna de las palabras prohibidas.';
    }
}
