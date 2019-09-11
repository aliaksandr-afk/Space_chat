function fn() {
    var sum = 0;

    for(var i=0; i < arguments.length; i++) {
        sum += arguments[i];
    }
    return sum;
}

var result = fn(4,10,12);
console.log(result);