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

function toggleNavbarBurger(navbarBurger) {
    navbarBurger.classList.toggle('is-active');
    const $target = document.getElementById(navbarBurger.dataset.target);
    $target.classList.toggle('is-active');
}

function toggleMobileMenu(id, isShow) {
    const classList = document.getElementById(id).classList;
    const hasHidden = classList.contains('is-hidden');

    if (isShow) {
        if (hasHidden) {
            classList.remove("is-hidden");
            _optionalIdElement("navbar-burger", navbarBurger => toggleNavbarBurger(navbarBurger));
        }
    }
    else {
        if (!hasHidden) {
            classList.add("is-hidden");
        }
    }
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


    for (let i = 1; i <= 5; i++) {
        _optionalWithClassNameIterable(dom, 'level' + i,
            (label, _index) => {
                label.classList.add('content');
            });
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

function setMobileLinkConfig() {
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

function scrollTop() {
    console.log("test!");
    window.scrollTop = '0';
}

document.addEventListener('DOMContentLoaded', () => {
    _optionalIdElement("navbar-burger", navbarBurger =>
        navbarBurger.addEventListener('click',
            () => toggleNavbarBurger(navbarBurger)));


    _optionalIdElement("wiki-content",
        wikiContent => styleCommons(wikiContent));

    styleSearchForm();
    _optional(document.getElementsByClassName("editButtons")[0],
        editButtons => styleEditor(editButtons));
    styleReader();
    styleConfigForm();
    setMobileLinkConfig();

    _optionalWithQuerySelectorAll(document, ".sidebar .level1 .li",
        li => {
            const matched = li.innerHTML.match(/(<a[^>]+>[^<]+<\/a>)(.+)/i);
            if (matched) {
                li.innerHTML = matched[1] + " <div class='change-log'>" + matched[2] + "</div>";
            }
        });

    _optionalIdElement("scroll-top-button", scrollTopButton => {
        scrollTopButton.addEventListener("click", _ => {
            console.log("test");
            document.getElementById("wiki-content").scrollTop = 0;
        });
    });
});