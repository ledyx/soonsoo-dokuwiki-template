/* DOKUWIKI:include assets/js/all.min.js */
/* DOKUWIKI:include conf/test.js */

function styleCommons() {
    const wikiContent = document.getElementById("wiki-content");
    const inputs = wikiContent.getElementsByTagName("input");
    if (inputs) {
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].classList.add('input');
        }
    }

    const buttons = wikiContent.getElementsByTagName("button");
    if (buttons) {
        for (let i = 0; i < buttons.length; i++) {
            buttons[i].classList.add('button');
        }
    }

    const labels = wikiContent.getElementsByTagName("label");
    if (labels) {
        for (let i = 0; i < labels.length; i++) {
            // labels[i].classList.remove('block');
            labels[i].classList.add('label');
        }
    }
}

function styleSearchForm() {
    const searchFormContainer = document.querySelector("form#dw__search").getElementsByClassName("no")[0];
    searchFormContainer.classList.add("field");
    searchFormContainer.classList.add("has-addons");

    const searchInput = searchFormContainer.children[0];
    searchInput.classList.add('input');

    const searchButton = searchFormContainer.children[1];
    searchButton.classList.add('button');
    searchButton.classList.add('is-white');
    searchButton.innerHTML = '<i class="fas fa-search"></i>';
}

function styleEditor() {
    const editorButtons = document.getElementsByClassName("editButtons")[0];
    if (!editorButtons)
        return;

    editorButtons.classList.add("buttons");
    editorButtons.classList.add("is-right");
    
    if (editorButtons) {
        for (let i = 0; i < editorButtons.children.length; i++) {
            const button = editorButtons.children[i];
            button.classList.add("button");

            if (button.id == 'edbtn__save') {
                button.classList.add('is-info');
            }
        }
    }
}

function styleReader() {
    const buttonForms = document.getElementsByClassName('btn_secedit');
    if (!buttonForms)
        return;

    for (let i = 0; i < buttonForms.length; i++) {
        const buttonForm = buttonForms[i];
        buttonForm.classList.remove('button');

        const editButton = buttonForm.querySelector('button');
        editButton.classList.add('button');
        editButton.classList.add('is-small');
    }
}

function styleConfigForm() {
    const configForm = document.getElementById("dw__configform");
    if (configForm) {
        const configFormButtons = configForm.getElementsByTagName('p')[0];
        configFormButtons.classList.add('buttons');
        configFormButtons.classList.add('is-right');
    }
}

document.addEventListener('DOMContentLoaded', () => {

    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

        // Add a click event on each of them
        $navbarBurgers.forEach(el => {
            el.addEventListener('click', () => {

                // Get the target from the "data-target" attribute
                const target = el.dataset.target;
                const $target = document.getElementById(target);

                // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

            });
        });
    }

    styleCommons();
    styleSearchForm();
    styleEditor();
    styleReader();
    styleConfigForm();
});
