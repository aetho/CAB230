/* Creating a custom change event to be used by input elements that
 * have their value change programmatically
 */
var customChangeEvent;
if (document.createEvent) {
    /* This method is deprecated but has to be used as Internet explorer
     * support is required
     */
    customChangeEvent = document.createEvent("HTMLEvents");
    customChangeEvent.initEvent('customChange', true, true);
} else {
    // Future-proofing for when createEvent is removed
    customChangeEvent = new Event('customChange');
}

/* Recursively find all parent elements with class of parentClass
 * and returns an array with all elements found
 */
function FindAllParentsWithClass(element, parentClass, result) {
    var localResult = result;
    if (!element.parentElement) return result;
    if (element.parentElement.classList.contains(parentClass)) localResult.push(element.parentElement);
    return FindAllParentsWithClass(element.parentElement, parentClass, localResult);
}

/* Returns the first parent that matches parentClass
 * i.e will not return 'grandparents'. Will return undefined
 * if no matches found
 */
function FindParentWithClass(element, parentClass) {
    if (FindAllParentsWithClass(element, parentClass, []).length > 0) {
        return FindAllParentsWithClass(element, parentClass, [])[0];
    } else {
        return undefined;
    }
}

/* Handling normal dropdowns
 * normal dropdowns should have the following inside the dropdown container:
 *      1. a trigger element        (required)
 *      2. a content container      (required)
 */
function HandleNormalDropdown(e) {
    var dropdown = FindParentWithClass(e.target, 'dropdown');
    if (dropdown) {

        // Check if click target is a dropdown trigger or a child of dropdown trigger
        if (e.target.classList.contains('dropdown-trigger') || FindParentWithClass(e.target, 'dropdown-trigger')) {
            var dropdownContent = dropdown.getElementsByClassName('dropdown-content')[0];
            if (dropdownContent) {
                dropdownContent.classList.toggle('dropdown-active');
            }
        }
    }
}

/* Handling select dropdowns
 * select dropdowns should have the following inside the dropdown container:
 *      1. 'dropdown-select' class on the dropdown container    (required)
 *      2. list-items inside content container                  (required)
 *      3. text input as its trigger                            (optional)
 */
function HandleSelectDropDown(e) {
    var dropdown = FindParentWithClass(e.target, 'dropdown');
    if (dropdown) {

        // Check if click target is a list-item or a child of a list-item
        if (e.target.classList.contains('list-item') || FindParentWithClass(e.target, 'list-item')) {
            var parentDropdown = FindParentWithClass(e.target, 'dropdown-select');
            // If dropdown can't be found then return
            if (!parentDropdown) return;

            // If no content container is found in dropdown then return 
            var parentDropdownContent = parentDropdown.getElementsByClassName('dropdown-content')[0];
            if (!parentDropdownContent) return;

            // Hide content after list-item is clicked
            if (parentDropdownContent.classList.contains('dropdown-active')) parentDropdownContent.classList.remove('dropdown-active');

            //
            if (parentDropdown.getElementsByClassName('dropdown-trigger')[0]) {
                var parentDropdownInput = parentDropdown.getElementsByClassName('dropdown-trigger')[0].getElementsByTagName('input')[0];

                // If no text input field is found then return
                if (!parentDropdownInput || parentDropdownInput.type != 'text') return;
                parentDropdownInput.value = e.target.innerHTML;
                /* Fire change event because programmatic changes to input value do not
                 * cause the change event to fire
                 */
                parentDropdownInput.dispatchEvent(customChangeEvent);
            }
        }
    }
}

/* Handling filter dropdowns
 * filter dropdowns should have the following inside the dropdown container:
 *      1. 'dropdown-select' class on the dropdown container    (required)
 *      2. list-items inside content container                  (required)
 *      3. text input as its trigger                            (required)
 */
function HandleFilterDropdown(e) {
    // Try to get the drop that e.target is in
    var dropdown = FindParentWithClass(e.target, 'dropdown');
    // Check if dropdown exists and has class 'dropdown-select-filter' before continuing
    if (dropdown && dropdown.classList.contains('dropdown-select-filter')) {
        var input = e.target;
        if (!input || input.type != 'text') return;

        var strToMatch = input.value.toLowerCase();
        var listItems = dropdown.getElementsByClassName('list-item');
        for (var i = 0; i < listItems.length; i++) {
            // A simple substring search to filter the list items
            if (listItems[i].innerHTML.toLowerCase().indexOf(strToMatch) > -1) {
                listItems[i].style.display = "";
            } else {
                listItems[i].style.display = "none";
            }
        }
    }
}

// Closes dropdowns when they're not the target of a tap or click
function CloseDropDowns(e) {
    // Get all dropdowns
    var dropdowns = document.getElementsByClassName('dropdown');
    // Get the parent(s) of target that has the dropdown class
    var targetParentDropdowns = FindAllParentsWithClass(e.target, 'dropdown', []);

    for (var i = 0; i < dropdowns.length; i++) {
        var result = false;
        // Check if target has atleast one parent that matches dropdown[i]
        for (var j = 0; j < targetParentDropdowns.length; j++) {
            if (dropdowns[i] == targetParentDropdowns[j]) {
                result = true;
                break;
            }
        }

        // If target's parent does not math dropdown[i] then hide dropdown[i]
        if (!result) {
            var dropdownContent = dropdowns[i].getElementsByClassName('dropdown-content')[0];
            if (dropdownContent.classList.contains('dropdown-active')) dropdownContent.classList.remove('dropdown-active');
        }
    }
}

document.addEventListener('click', function (e) {
    // Event delegation to handle dynamically added dropdowns
    // Handle normal dropdowns
    HandleNormalDropdown(e);

    // Event delegation to handle dynamically added dropdowns    
    // Hand select dropdowns
    HandleSelectDropDown(e);

    // Close dropdowns for desktop
    CloseDropDowns(e)
});

document.addEventListener('touchstart', function (e) {
    // Close dropdowns for mobile devices
    CloseDropDowns(e)
});

document.addEventListener('keyup', function (e) {
    // Event delegation to handle dynamically added dropdowns
    // Handle filter dropdowns
    HandleFilterDropdown(e);
});



/* Have to add listener to document because adding it to the
 * search-mode input does not work on IE11
 */
document.addEventListener('customChange', function (e) {
    var searchContent = document.getElementById('search-content');
    // Make sure searchContent is found before continuing
    if (searchContent) {
        var searchModeInput = searchContent.getElementsByTagName('input')[0];
        var searchForm = searchContent.getElementsByTagName('form')[0];
        /* Make sure searchModeInput and searchForm is found and customChange
         * event is from searchModeInput before continuing
         */
        if (searchModeInput && e.target == searchModeInput && searchForm) {
            // Remove previous search field if one exists
            if (document.getElementById('search-field')) searchForm.removeChild(document.getElementById('search-field'));
            // Remove previous search submit if one exists
            if (document.getElementById('search-submit')) searchForm.removeChild(document.getElementById('search-submit'));

            // Create container for field
            var searchField = document.createElement('div');
            searchField.id = 'search-field';
            searchField.style.marginBottom = '16px';

            // Add relevant fields to container
            switch (searchModeInput.value.toLowerCase()) {
                case 'name':
                    // Create label
                    var label = document.createElement('label');
                    label.innerHTML = "Name";

                    // Create input
                    var input = document.createElement('input');
                    input.setAttribute('type', 'text');
                    input.setAttribute('placeholder', 'E.g. 7th Brigade Park, Chermside');
                    input.setAttribute('name', 'searchName');
                    input.id = 'field-input-name';

                    // Append elements
                    searchField.appendChild(label);
                    searchField.appendChild(input);
                    searchForm.appendChild(searchField);
                    break;
                case 'suburb':
                    // Adding relevant classes to the container
                    // Can't add multiple classes at once as it's not supported by IE11
                    searchField.classList.add('dropdown');
                    searchField.classList.add('dropdown-select');
                    // searchField.classList.add('dropdown-select-filter');

                    // Creating the trigger
                    var trigger = document.createElement('div');
                    trigger.classList.add('dropdown-trigger');
                    trigger.id = 'search-field-trigger';

                    // Creating label that will be inside trigger
                    var label = document.createElement('label');
                    label.innerHTML = "Suburb";

                    // Creating input that will be inside trigger
                    var input = document.createElement('input');
                    input.setAttribute('type', 'text');
                    input.setAttribute('placeholder', 'E.g. Annerley, Forestlake, Brisbane...');
                    input.setAttribute('name', 'searchSuburb');
                    input.setAttribute('readonly', '');
                    input.id = 'field-input-suburb';

                    // Append label & input to trigger
                    trigger.appendChild(label);
                    trigger.appendChild(input);

                    // Append trigger to container
                    searchField.appendChild(trigger);

                    // Creating dropdown content container
                    var dropdownContent = document.createElement('div');
                    dropdownContent.classList.add('dropdown-content');
                    dropdownContent.id = "search-field-content";

                    // Creating list container
                    var list = document.createElement('div');
                    list.classList.add('list');

                    // Hardcoded suburbs (Removed postcodes)
                    var suburbs = [
                        'Use my location',
                        'Annerley', 'Ascot', 'Ashgrove',
                        'Banyo', 'Bellbowrie', 'Bracken Ridge',
                        'Brisbane', 'Bulimba', 'Calamvale',
                        'Carina', 'Carindale', 'Chermside',
                        'Clayfield', 'Coopers Plains', 'Corinda',
                        'Everton Park', 'Fairfield', 'Fitzgibbon',
                        'Forest Lake', 'Grange', 'Hamilton',
                        'Holland Park', 'Holland Park West', 'Inala',
                        'Indooroopilly', 'Kenmore', 'MacGregor',
                        'Mitchelton', 'Mt Gravatt', 'Mt Ommaney',
                        'New Farm', 'Nundah', 'Paddington',
                        'Sandgate', 'Seventeen Mile Rocks', 'St Lucia',
                        'Stones Corner', 'Sunnybank Hills', 'Toowong',
                        'Upper Mount Gravatt', 'West End', 'Wynnum',
                        'Zillmere'
                    ]

                    for (var i = 0; i < suburbs.length; i++) {
                        // Creating a list item for each suburb
                        var listItem = document.createElement('a');
                        listItem.classList.add('list-item');
                        listItem.innerHTML = suburbs[i];
                        // Append list item to list
                        list.appendChild(listItem);
                    }

                    // Append list to content container
                    dropdownContent.appendChild(list);
                    // Append content container to field container
                    searchField.appendChild(dropdownContent);

                    // Append field container to search content form
                    searchForm.appendChild(searchField);
                    break;
                case 'rating':
                    // Adding relevant classes to the container
                    // Can't add multiple classes at once as it's not supported by IE11
                    searchField.classList.add('dropdown');
                    searchField.classList.add('dropdown-select');

                    // Creating the trigger
                    var trigger = document.createElement('div');
                    trigger.classList.add('dropdown-trigger');
                    trigger.id = 'search-field-trigger';

                    // Creating label that will be inside trigger
                    var label = document.createElement('label');
                    label.innerHTML = "Rating";

                    // Creating input that will be inside trigger
                    var input = document.createElement('input');
                    input.setAttribute('type', 'text');
                    input.setAttribute('placeholder', 'Select rating');
                    input.setAttribute('name', 'searchRating');
                    input.setAttribute('readonly', '');
                    input.id = 'field-input-rating';

                    // Append label & input to trigger
                    trigger.appendChild(label);
                    trigger.appendChild(input);

                    // Append trigger to container
                    searchField.appendChild(trigger);

                    // Creating dropdown content container
                    var dropdownContent = document.createElement('div');
                    dropdownContent.classList.add('dropdown-content');
                    dropdownContent.id = "search-field-content";

                    // Creating list container
                    var list = document.createElement('div');
                    list.classList.add('list');

                    for (var i = 5; i > 0; i--) {
                        // Creating list item
                        var listItem = document.createElement('a');
                        listItem.classList.add('list-item');
                        listItem.innerHTML = i

                        // Appending list item to list
                        list.appendChild(listItem);
                    }

                    // Append list to content container
                    dropdownContent.appendChild(list);
                    // Append content container to field container
                    searchField.appendChild(dropdownContent);

                    // Append field container to search content form
                    searchForm.appendChild(searchField);
                    break;
            }

            // Create submit container
            var submitContainer = document.createElement('div');
            submitContainer.id = 'search-submit';

            // Create submit button
            var submitBtn = document.createElement('input');
            submitBtn.setAttribute('type', 'submit');
            submitBtn.setAttribute('value', 'Search');

            // Append button to container
            submitContainer.appendChild(submitBtn);

            // Append container to form
            searchForm.appendChild(submitContainer);
        }
    }
});

