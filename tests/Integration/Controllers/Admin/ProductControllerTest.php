<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 27/04/2017
 * Time: 22:20
 */

namespace Tests\Integration\Controllers\Admin;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Set up test
     */
    protected function setUp()
    {
        parent::setUp();

        $this->setAuth(self::ADMIN);
        $this->initData();
    }

    public function test_store_product()
    {
        //
    }

    /** Init database */
    protected function initData()
    {
        //
    }
}
