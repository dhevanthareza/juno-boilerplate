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
        ModuleRepository::generateModuleFile(['name' => 'User Pref']);
        $this->assertTrue(true);
    }
}
