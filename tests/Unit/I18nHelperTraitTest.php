<?php

namespace Tests\Unit;

use Modules\Common\Traits\I18nHelperTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class I18nHelperTraitTest extends TestCase
{
    use I18nHelperTrait;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);

        $data = [
            'title' => 'Test'
        ];

        $this->setAllLocalesFields($data, ['title']);


        
    }
}
