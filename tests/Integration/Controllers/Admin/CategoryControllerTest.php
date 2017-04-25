<?php
/**
 * Created by PhpStorm.
 * User: kimnh
 * Date: 24/04/2017
 * Time: 20:01
 */

namespace Tests\Integration\Controllers\Admin;

use App\Models\Category;
use App\Models\Seo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @var  Category $root */
    protected $root;
    /** @var  Category $root */
    protected $rootNotDelete;
    /** @var  Category $root */
    protected $lv1;
    /** @var  Category $root */
    protected $lv2;
    /** @var  Category $root */
    protected $lv3;

    protected function setUp()
    {
        parent::setUp();

        $this->setAuth(User::ADMIN);
        $this->setUpData();
    }

    /** Test can store a category */
    public function test_store_category()
    {
        $categoryData = factory(Category::class)->make()->toArray();
        $seoData = [
            'seo_title' => $title = str_random(10),
            'seo_alias' => $alias = str_slug($categoryData['name']),
        ];

        $rs = $this->post(route('admin.category.store'), array_merge($categoryData, $seoData));

        $rs->assertSessionMissing('errors');
        $rs->assertRedirect(route('admin.category.index'));

        $this->assertDatabaseHas('categories', $categoryData);
        $this->assertDatabaseHas('seos', compact('title', 'alias'));
    }

    /** Test can delete category */
    public function test_destroy_category()
    {
        $rs = $this->delete(route('admin.category.destroy', $this->root->getKey()));

        $rs->assertRedirect(route('admin.category.index'));
        $rs->assertSessionMissing('errors');

        $this->assertSoftDeleted('categories', [$this->lv1->getKeyName() => $this->lv1->getKey()]);
        $this->assertSoftDeleted('categories', [$this->lv2->getKeyName() => $this->lv2->getKey()]);
        $this->assertSoftDeleted('categories', [$this->lv3->getKeyName() => $this->lv3->getKey()]);
        $this->assertSoftDeleted('categories', [$this->root->getKeyName() => $this->root->getKey()]);

        $this->assertSoftDeleted('seos', [$this->root->seo->getKeyName() => $this->root->seo->getKey()]);
        $this->assertSoftDeleted('seos', [$this->lv1->seo->getKeyName() => $this->lv1->seo->getKey()]);
        $this->assertSoftDeleted('seos', [$this->lv2->seo->getKeyName() => $this->lv2->seo->getKey()]);
        $this->assertSoftDeleted('seos', [$this->lv3->seo->getKeyName() => $this->lv3->seo->getKey()]);

        $this->assertDatabaseHas('categories', [$this->rootNotDelete->getKeyName() => $this->rootNotDelete->getKey()]);
    }

    /** Set up database */
    protected function setUpData()
    {
        // Make category:
        /** @var Category $root */
        $this->root = factory(Category::class)->create();
        $this->rootNotDelete = factory(Category::class)->create();
        $this->lv1 = factory(Category::class)->create();
        $this->lv2 = factory(Category::class)->create();
        $this->lv3 = factory(Category::class)->create();

        // Make seo for category:
        $this->root->seo()->save(factory(Seo::class)->make());
        $this->lv1->seo()->save(factory(Seo::class)->make());
        $this->lv2->seo()->save(factory(Seo::class)->make());
        $this->lv3->seo()->save(factory(Seo::class)->make());

        // Eager loading relation seo:
        $this->root->load('seo');
        $this->lv1->load('seo');
        $this->lv2->load('seo');
        $this->lv3->load('seo');

        // Save children for category:
        $this->root->children()->save($this->lv1);
        $this->lv1->children()->save($this->lv2);
        $this->lv2->children()->save($this->lv3);
    }
}
