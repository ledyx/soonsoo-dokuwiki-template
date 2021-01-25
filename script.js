/* DOKUWIKI:include assets/js/all.min.js */
/* DOKUWIKI:include conf/test.js */

function _optional(value, then) {
    if (value != null) {
        if (then) {
            then(value);
        }
    }
}

function _optionalIdElement(id, then) {
    const dom = document.getElementById(id);
    if (dom != null) {
        if (then) {
            then(dom);
        }
    }
}

function _optionalWithIterable(dom, then) {
    _optional(dom, values => {
        for (let i = 0; i < values.length; i++) {
            then(values[i], i);
        }
    });
}

function _optionalWithTagNameIterable(dom, tagName, then) {
    _optionalWithIterable(dom.getElementsByTagName(tagName), then);
}

function _optionalWithClassNameIterable(dom, className, then) {
    _optionalWithIterable(dom.getElementsByClassName(className), then);
}

function _optionalWithQuerySelectorAll(dom, selector, then) {
    _optionalWithIterable(dom.querySelectorAll(selector), then);
}

function toggleMobileMenu(id, isShow) {
    const classList = document.getElementById(id).classList;
    const hasHidden = classList.contains('is-hidden');

    if (isShow) {
        if (hasHidden) {
            classList.remove("is-hidden");
        }
    }
    else {
        if (!hasHidden) {
            classList.add("is-hidden");
        }
    }

    const htmlStyle = document.getElementsByTagName('html')[0].style;
    htmlStyle.overflowX = isShow ? "hidden" : "auto";
    htmlStyle.overflowY = isShow ? "hidden" : "auto";
}

function styleCommons(dom) {
    _optionalWithTagNameIterable(dom, 'input',
        (input, _index) => {
            const inputClass = input.type.toLowerCase() == 'checkbox' ? 'checkbox' : 'input';
            input.classList.add(inputClass);
        });

    _optionalWithTagNameIterable(dom, 'button',
        (button, _index) => {
            button.classList.add('button');
        });


    _optionalWithTagNameIterable(dom, 'button',
        (button, _index) => {
            button.classList.add('button');
        });


    _optionalWithTagNameIterable(dom, 'label',
        (label, _index) => {
            label.classList.add('label');
        });
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

function styleEditor(editButtons) {
    editButtons.classList.add("buttons");
    editButtons.classList.add("is-right");

    _optionalWithIterable(editButtons.children,
        button => {
            button.classList.add("button");
            if (button.id == 'edbtn__save') {
                button.classList.add('is-info');
            }
        });
}

function styleReader() {
    _optionalWithClassNameIterable(document, 'btn_secedit',
        (buttonForm, _index) => {
            buttonForm.classList.remove('button');

            const editButton = buttonForm.querySelector('button');
            editButton.classList.add('button');
            editButton.classList.add('is-small');
        });
}

function styleConfigForm() {
    _optionalIdElement("dw__configform",
        dw__configform => {
            const selectWrappers = dw__configform.querySelectorAll("div.input");
            for (let selectWrapper of selectWrappers) {

                selectWrapper.classList.remove('input');

                if (selectWrapper.getElementsByTagName('select')[0]) {
                    selectWrapper.classList.add('select');
                    selectWrapper.classList.add('is-fullwidth');
                }
            }

            _optionalWithTagNameIterable(dw__configform, "textarea",
                (textarea, _index) => textarea.classList.add('textarea'));

            _optionalWithClassNameIterable(dw__configform, "selection",
                selection => selection.classList.remove('selectiondefault'));

            _optionalWithQuerySelectorAll(dw__configform, "td.label",
                (td, _index) => td.className = '');
        });
}

function setMobileStyle() {
    _optionalWithIterable(document.getElementsByClassName("mobile-menu"),
        mobileMenu => {
            _optionalWithIterable(mobileMenu.getElementsByTagName('a'),
                anchor => {
                    anchor.addEventListener('click', _ => {
                        toggleMobileMenu('mobile-toc', false);
                        toggleMobileMenu('mobile-sidebar', false);
                    });
                });
        });
}

window.addEventListener("resize", () => {
    const isBreakAtMobile = window.innerWidth <= 767;
    if (isBreakAtMobile) {
        toggleTOC(false);
    }
});


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

    _optionalIdElement("wiki-content",
        wikiContent => styleCommons(wikiContent));

    styleSearchForm();
    _optional(document.getElementsByClassName("editButtons")[0],
        editButtons => styleEditor(editButtons));
    styleReader();
    styleConfigForm();
    setMobileStyle();
});