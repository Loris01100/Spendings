<?php

namespace App\Enum;

enum Frequence: string
{
    case JOURNALIER = 'journalier';
    case HEBDOMADAIRE = 'hebdomadaire';
    case MENSUEL = 'mensuel';
}