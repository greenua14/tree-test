var builddata = function (n) {
    var source = [];
    var item = [];
    for (var i = 1, j = 1; i <= n, j <= 5; i++, j++)
    {
        var item = { label: 'node' + i.toString(), id: i,
            children: [
                { label: 'child' + j.toString(), id: ++i }
            ]
        }
        console.log(item);
        source[i] = item[i];
    }
    return source;
}

var data = builddata(15);

$('#tree1').tree({
    data: data,
    autoOpen: true,
    dragAndDrop: true
});
