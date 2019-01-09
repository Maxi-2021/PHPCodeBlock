$x = '31497230840470473074370324734723042.9';

bcscale(100);
var_dump(bcFloor($x));
var_dump(bcCeil($x));
var_dump(bcRound($x));

function bcFloor($x)
{
    $result = bcmul($x, '1', 0);
    if ((bccomp($result, '0', 0) == -1) && bccomp($x, $result, 1))
        $result = bcsub($result, 1, 0);

    return $result;
}

function bcCeil($x)
{
    $floor = bcFloor($x);
    return bcadd($floor, ceil(bcsub($x, $floor)), 0);
}

function bcRound($x)
{
    $floor = bcFloor($x);
    return bcadd($floor, round(bcsub($x, $floor)), 0);
}
