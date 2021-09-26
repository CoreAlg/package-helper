<?php

namespace CoreAlg\Helper\Tests\Unit;

use CoreAlg\Helper\Helper;
use CoreAlg\Helper\Tests\TestCase;

class HelperTest extends TestCase
{
    /**
     * @test
     */
    public function paginationSummary()
    {
        $summary = Helper::paginationSummary(100, 10, 1);
        $this->assertEquals("Showing 1 to 10 of 100 records", $summary);
    }

    /**
     * @test
     */
    public function number2word()
    {
        $response = Helper::number2word(100);
        $this->assertEquals("One Hundred Taka Only.", $response);
    }

    /**
     * @test
     * @dataProvider provideAmountData
     */
    public function formatAmount($amount, $decimals, $decimal_separator, $thousands_separator, $expected)
    {
        $response = Helper::formatAmount($amount, $decimals, $decimal_separator, $thousands_separator);
        $this->assertEquals($expected, $response);
    }

    /**
     * @test
     */
    public function formatAmountBasedOnSessionValue()
    {
        $this->withSession([
            'core_helper' => [
                'amount_format' => [
                    'decimals' => 3,
                    'decimal_separator' => '.',
                    'thousands_separator' => ','
                ]
            ]
        ]);

        $response = Helper::formatAmount("10000");
        $this->assertEquals("10,000.000", $response);
    }

    /**
     * @test
     * @dataProvider provideDateData
     */
    public function formatDate($date, $format = null, $expected)
    {
        $response = Helper::formatDate($date, $format);
        $this->assertEquals($expected, $response);
    }

    /**
     * @test
     */
    public function formatDateBasedOnSessionValue()
    {
        $this->withSession([
            'core_helper' => [
                'date_format' => 'd M, Y @ h:i:s A (P)'
            ]
        ]);

        $response = Helper::formatDate("2021-09-27 15:30:00");
        $this->assertEquals("27 Sep, 2021 @ 03:30:00 PM (+00:00)", $response);
    }

    /**
     * @test
     */
    public function message()
    {
        $response = Helper::message("Operation Succeed!", "success", true);
        $this->assertNotNull($response);
        $this->assertTrue(is_string($response));
        $this->assertStringContainsString('Operation Succeed!', $response);
        $this->assertStringContainsString("<button type='button' class='close'", $response);
        $this->assertStringContainsString("<div class='alert alert-success", $response);
    }

    public function provideAmountData()
    {
        return [
            [100, null, '', '', 100],
            [100, 0, '.', ',', 100],
            [100, 1, '.', ',', 100.0],
            [100, 2, '.', ',', 100.00],
            [100, 2, '', ',', 10000],
            [1000, 2, '.', '.', "1.000.00"],
        ];
    }

    public function provideDateData()
    {
        return [
            ["2021-09-27", null, "2021-09-27"],
            ["2021-09-27", "d M, Y", "27 Sep, 2021"],
            ["2021-09-27 15:30:00", "d M, Y @ h:i:s A (P)", "27 Sep, 2021 @ 03:30:00 PM (+00:00)"],
        ];
    }
}
