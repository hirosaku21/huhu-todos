<?php

namespace Tests\Browser\Frontend\Applicant;

use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    #[Test]
    #[TestDox('削除ボタンをクリック後に非活性になること')]
    public function test_OK_削除ボタンをクリック後に非活性(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            // ボタンの非活性状態を確認するために、formが送信されないように制御
            $browser->script("document.querySelector('form').action = 'javascript:void(0)';");

            $browser->assertButtonEnabled('button')
                ->click('button[type="submit"]:contains(削除)')
                ->assertButtonDisabled('button[type="submit"]:contains(削除)')
                ->screenshot('disabled-submit-button');
        });
    }
}
