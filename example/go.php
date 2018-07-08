<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/7/8
 * Time: 上午11:39
 */

echo __LINE__, "\n";
go(function () {
    $ret = await(function () {
        return 'hello';
    });

    var_dump($ret);
});
echo __LINE__, "\n";

function await(Closure $fn) {
    $ch = new chan(1);

    go(function () use($fn, $ch) {
        $ret = $fn();
        $ch->push($ret);
    });

    var_dump(\Co::getuid());

    return $ch->pop();
}

function await_multi(Closure ...$fns) {
    $len = count($fns);
    $ch = new chan($len);

    foreach ($fns as $fn) {
        go(function () use($fn, $ch) {
            $ret = $fn();
            $ch->push($ret);
        });
    }

    $results = [];

    for ($i = 0; $i < $len; $i++) {
        $results[] = $ch->pop();
    }

    return $results;
}