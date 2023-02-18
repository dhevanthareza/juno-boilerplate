<?php

namespace Tests\Unit;

use App\Modules\Module\Repository\ModuleRepository;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        ModuleRepository::generateModuleFile(['name' => 'User Pref'], [
            [
                "name" => "tes_string",
                "label" => "Tes String",
                "type" => "string",
                "length" => 255,
                "input_type" => "INPUT"
            ],
            [
                "name" => "tes_double",
                "label" => "Tes Double",
                "type" => "double",
                "length" => 8,
                "input_type" => "INPUT"
            ],
            [
                "name" => "tes_decimal",
                "label" => "Tes Decimal",
                "type" => "decimal",
                "length" => 8,
                "input_type" => "INPUT"
            ],
            [
                "name" => "tes_text",
                "label" => "Tes Text",
                "type" => "text",
                "length" => null,
                "input_type" => "INPUT"
            ],
        ]);
        $this->assertTrue(true);
    }
}
