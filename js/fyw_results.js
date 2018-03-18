let suburbInput = document.querySelector('.suburb-input');
let suburbDropdownContent = document.querySelector('.suburb-dropdown-content');
let suburbDropdownItems = document.querySelectorAll('.suburb-dropdown-item');

// listen for focusin event
suburbInput.addEventListener('focusin', function (e) {
    // Show suburb dropdown
    suburbDropdownContent.style.display = 'block';
});

for (let i = 0; i < suburbDropdownItems.length; i++) {
    /* IE11 seems to only pass a reference to i instead of the value inside i which causes 
     * suburbDropdownItems[index] to equal suburbDropdownItems[suburbDropdownItems.length]
     * by the time the user clicks on the dropdown item.
     */
    (function (index) {
        // listen for click event on each suburb
        suburbDropdownItems[index].addEventListener('click', function (e) {
            // fill input field with selected suburb
            suburbInput.value = suburbDropdownItems[index].innerHTML;
            // hide dropdown
            suburbDropdownContent.style.display = 'none';
        });
    })(i);
}

// listen for click event on window
window.addEventListener('click', function (e) {
    let suburbDropdownItemMatch;
    let suburbInputMatch = suburbInput == e.target;

    for (let i = 0; i < suburbDropdownItems.length; i++) {
        if (suburbDropdownItems[i] == e.target) {
            suburbDropdownItemMatch = true;
            break;
        } else {
            suburbDropdownItemMatch = false;
        }
    }

    // hide suburb dropdown click when target is not the dropdown or items
    if (!suburbDropdownItemMatch && !suburbInputMatch) {
        suburbDropdownContent.style.display = 'none';
    }
});

let ratingDropdownItems = document.querySelectorAll('.rating-dropdown-item');
for (let i = 0; i < ratingDropdownItems.length; i++) {
    /* IE11 seems to only pass a reference to i instead of the value inside i which causes 
     * ratingDropdownItems[index] to equal ratingDropdownItems[ratingDropdownItems.length]
     * by the time the user clicks on the dropdown item. 
     */
    (function (index) {
        // listen for click event on rating items
        ratingDropdownItems[index].addEventListener('click', function (e) {
            // set rating text to clicked rating
            let ratingDropdown = document.querySelector('.rating-dropdown');
            ratingDropdown.innerHTML = ratingDropdownItems[index].innerHTML;
        });
    })(i);
}