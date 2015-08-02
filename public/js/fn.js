function getUniqueTime(){
    var date = new Date();
    var components = [
        date.getYear(),
        date.getMonth(),
        date.getDate(),
        date.getHours(),
        date.getMinutes(),
        date.getSeconds(),
        date.getMilliseconds()
    ];
    return parseInt(components.join("")).toString(16);
}

console.log(getUniqueTime());