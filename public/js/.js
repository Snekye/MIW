let keys = [];
let test = ['ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight','ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown','b', 'a', 'Enter'];
document.addEventListener('keydown', function(e) {
    keys.push(e.key);
    if (JSON.stringify(keys) === JSON.stringify(test)) {

            console.log("success");
            window.location = "/72b5c5eae7c155bb64db1e72e0aea98b";
        }
});