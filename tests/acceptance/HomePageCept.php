<?php

$I = new AcceptanceTester($scenario);

$I->wantTo('visit the homepage');
$I->amOnPage('/');

$I->seeResponseCodeIs(200);

$I->seeLink('Slim Template', '/');
$I->seeLink('Home', '/');
$I->seeLink('Repo', 'https://github.com/HaKIMus/slim-template');
$I->seeLink('Doc Slim', 'http://www.slimframework.com/docs/');

$I->see('
        Slim Template
        Version: 2.0.0');