<?php

namespace App\Enums;

enum TiposAssociados: int
{
    case FILIADO = 1;
    case DESFILIADO = 2;

    public static function canVote(): array
    {
        return [
            self::FILIADO,
        ];
    }

    public static function getName(int $tipo): string
    {
        foreach (self::cases() as $tipos) {
            if( $tipo === $tipos->value ){
                return $tipos->name;
            }
        }
        throw new \ValueError("$tipo is not a valid backing value for enum " . self::class );
    }
}
