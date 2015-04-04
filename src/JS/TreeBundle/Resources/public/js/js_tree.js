var data = [];

//var data = [
//    {
//        label: 'node1', id: 1,
//        children: [
//            { label: 'child1', id: 2 },
//            { label: 'child2', id: 3 }
//        ]
//    },
//    {
//        label: 'node2', id: 4,
//        children: [
//            { label: 'child3', id: 5 }
//        ]
//    }
//];

var builddata = function (n) {
    var source = [];

//    var labels_id = [];
//    var nodes_labels = [];
    var child_labels = [];
    for(var i = 0; i < n * 3; i++)
    {
//        labels_id = i;

        for(var j = 0; j < n; j++)
        {
//            nodes_labels = 'node' + j.toString();

            for(var k = 0; k < 3; k++)
            {
//                child_labels = 'child' + k.toString();
                source[j] = { label: 'node' + j.toString(), id: i,
                    children: {
                        label: 'child' + k.toString(), id: i+1
                    }
                }
            }
        }
    }

    return source;
}

data = builddata(10);

$('#tree1').tree({
    data: data,
    autoOpen: true,
    dragAndDrop: true
});
