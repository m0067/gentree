<?php

declare(strict_types=1);

namespace App\Enum;

enum TypeEnum: string
{
    case ITEMS_COMPONENTS = 'Изделия и компоненты';
    case EQUIPMENT_VARIANTS = 'Варианты комплектации';
    case DIRECT_COMPONENTS = 'Прямые компоненты';
}
