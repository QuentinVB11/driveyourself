<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ParcoursCard extends DuskTestCase
{

/*
    public function testMajorOrder(){
        $this->browse(function (Browser $browser) {
            $card = $browser->visit('/path')
                    ->elements('div.card');

            if(count($card) > 0){
                $sortByLevelAndName = true;
                for($i = 0; $i < count($card) - 1; $i++){
                    $cardDivFirst = "div.card:nth-child(".$i.")";
                    $cardDivSecond = "div.card:nth-child(".($i+1).")";
                    $innerTextCardFirst = $browser->element("$cardDivFirst > div.card-title > p")->getText();
                    $innerTextCardSecond = $browser->element("$cardDivSecond > div.card-title > p")->getText();
                    $innerTextCardLevelFirst = $browser->element("$cardDivFirst > div.card-level > p")->getText();
                    $innerTextCardLevelSecond = $browser->element("$cardDivSecond > div.card-level > p")->getText();
                    if(strcasecmp($innerTextCardFirst, $innerTextCardSecond)>0 || strcasecmp($innerTextCardLevelFirst, $innerTextCardLevelSecond)>0){
                        $sortByLevelAndName = false;
                        break;
                    }
                }
                $this->assertTrue($sortByLevelAndName);
            }else{
                $browser->assertPresent('div.card-empty');
            }
        });
    } */

    /**
     * A Dusk test example.
     *
     * @return void
     */
     public function testCheckParcoursView(){
        $this->browse(function (Browser $browser) {

            $card = $browser->visit('/path')
                    ->elements('div.card');
            if(count($card)>0){
                for($key=0; $key < count($card); $key++){
                    $cardDiv = "div.card:nth-child(".$key.")";
                    $browser->assertPresent("div.card-name")
                            ->assertPresent("div.card-duration")
                            ->assertPresent("div.card-distance")
                            ->assertPresent("div.card-level")
                            ->assertPresent("div.card-go > a");
                }
            }else{
                $browser->assertPresent('.card-empty');
            }

           // $browser->assertPresent('.card');
        /*         for($key=0; $key < count($card); $key++){
                    $cardDiv = "div.card:nth-child(".$key.")";
                    $browser->assertPresent("$card > div.card-name")
                            ->assertPresent("$card > div.card-duration")
                            ->assertPresent("$card > div.card-distance")
                            ->assertPresent("$card > div.card-level")
                            ->assertPresent("$card > div.card-location")
                            ->assertPresent("$card > div.card-go > a.btn.btn-primary");
                }
                $browser->click('div.card:nth-child(1) > div.card-go > a')
                        ->assertPathIs('/@'); */

        });
    }
}
